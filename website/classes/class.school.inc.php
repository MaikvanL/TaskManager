<?php
/**
 * School Class
 * User: Maik van Lieshout
 * Date: 09-06-15
 * Time: 15:50
 */

class School
{

    private $curYear = ""; // Huidig schooljaar
    private $holidays = array();


    public function addYear($data)
    {
        $db = new Database();

        $start          =   $db->escapeString($data['start']);
        $end            =   $db->escapeString($data['end']);
        $urennorm       =   $db->escapeString($data['urennorm']);
        $naam           =   $db->escapeString($data['naam']);


        $document = new document();
        $convertedStartDate = $document->convertToSQLdate($start);
        $convertedEndDate = $document->convertToSQLdate($end);

        $schooldagen = $this->getWorkingDays($convertedStartDate, $convertedEndDate, $holidays);

        $werkweken = ($schooldagen/5);

        $db->connect();
        $tabelinfo = ['start'=>$convertedStartDate,'end'=>$convertedEndDate,'urennorm'=>$urennorm,'naam'=>$naam,'schooldagen'=>$schooldagen, 'werkweken'=>$werkweken];
        $db->insert('schooljaar',$tabelinfo);
        return true;

    }

    public function getCurYear(){
        $db = new Database();
        $db->select('schooljaar','*',null,'actief=1');
        $result = $db->getResult();
        foreach($result as $r){
            $schooljaar_id = $r['schooljaar_id'];
        }

        return $schooljaar_id;
    }

    public function editYear($data)
    {
        $db = new Database();

        $id             =   $db->escapeString($data['schooljaar_id']);
        $start          =   $db->escapeString($data['start']);
        $end            =   $db->escapeString($data['end']);
        $urennorm       =   $db->escapeString($data['urennorm']);
        $naam           =   $db->escapeString($data['naam']);


        $document = new document();
        $convertedStartDate = $document->convertToSQLdate($start);
        $convertedEndDate = $document->convertToSQLdate($end);

        $vakanties = $this->getYearHolidays($data['schooljaar_id']);
        foreach ($vakanties as $vakantie) {
            $this->createDateRangeArray($vakantie['start'],$vakantie['end']);
        }
        $holiday = $this->flatten_array($this->holidays);

        $schooldagen = $this->getWorkingDays($convertedStartDate, $convertedEndDate, $holiday);
        $werkweken = ($schooldagen/5);
        $db->connect();
        $tabelinfo = ['start'=>$convertedStartDate,'end'=>$convertedEndDate,'urennorm'=>$urennorm,'naam'=>$naam,'schooldagen'=>$schooldagen, 'werkweken'=>$werkweken];
        $db->update('schooljaar',$tabelinfo,'schooljaar_id = '.$id);
        return true;
    }

    public function getYear($year){
        $db = new Database();
        $db->connect();
        $db->select('schooljaar', '*', null, '`schooljaar_id` ='.$year);
        return $db->getResult();
    }
    public function getYearHolidays($year){
        $db = new Database();

        $db->select('vakantie','*', null, 'schooljaar_id ='.$year);
        $result = $db->getResult();
        return $result;
    }
    public function allYears(){
        $db = new Database();
        $db->connect();
        $db->select('schooljaar','*');
        return $db->getResult();
    }
    public function addHoliday($data)
    {
        $db = new Database();

        $start          =   $db->escapeString($data['start']);
        $end            =   $db->escapeString($data['end']);
        $schooljaar     =   $db->escapeString($data['schooljaar']);
        $naam           =   $db->escapeString($data['naam']);


        $document = new document();
        $convertedStartDate = $document->convertToSQLdate($start);
        $convertedEndDate = $document->convertToSQLdate($end);

        $vakanties = $this->getYearHolidays($data['schooljaar']);
        foreach ($vakanties as $vakantie) {
            $this->createDateRangeArray($vakantie['start'],$vakantie['end']);
        }
        $holiday = $this->flatten_array($this->holidays);

        $schooldagen = $this->getWorkingDays($convertedStartDate, $convertedEndDate, $holiday);
        $werkweken = ($schooldagen/5);
        $db->connect();
        $tabelinfo = ['start'=>$convertedStartDate,'end'=>$convertedEndDate,'urennorm'=>$urennorm,'naam'=>$naam,'schooldagen'=>$schooldagen, 'werkweken'=>$werkweken];
        $db->update('schooljaar',$tabelinfo,'schooljaar_id = '.$id);

        $db->connect();
        $tabelinfo = ['start'=>$convertedStartDate,'end'=>$convertedEndDate,'naam'=>$naam,'schooljaar_id'=>$schooljaar];
        $db->insert('vakanties',$tabelinfo);
        return true;

    }

    public function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return array_push($this->holidays,$aryRange);

    }
    public function flatten_array(array $array) {
        $flattened_array = array();
        array_walk_recursive($array, function($a) use (&$flattened_array) { $flattened_array[] = $a; });
        return $flattened_array;
    }

    // Haal het aantal werkdagen op, exclusief vakanties
    public function getWorkingDays($startDate, $endDate, $holidays)
    {
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);



        $days = ($endDate - $startDate) / 86400 + 1;

        $no_full_weeks = floor($days / 7);
        $no_remaining_days = fmod($days, 7);

        // 1 = maandag, 7 = zondag
        $the_first_day_of_week = date("N", $startDate);
        $the_last_day_of_week = date("N", $endDate);

        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
        } else {
            // (edit by Tokes to fix an edge case where the start day was a Sunday
            // and the end day was NOT a Saturday)

            // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
                $no_remaining_days--;

                if ($the_last_day_of_week == 6) {
                    // if the end date is a Saturday, then we subtract another day
                    $no_remaining_days--;
                }
            } else {
                // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
            }
        }

        //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
        //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
        $workingDays = $no_full_weeks * 5;
        if ($no_remaining_days > 0) {
            $workingDays += $no_remaining_days;
        }

        //We subtract the holidays
        foreach ($holidays as $holiday) {
            $time_stamp = strtotime($holiday);
            //If the holiday doesn't fall in weekend
            if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
                $workingDays--;
        }

        return $workingDays;

    }

}
/**
 * Example:
 *
 * $holidays=array("2008-12-25","2008-12-26","2009-01-01");
 *
 * echo getWorkingDays("2008-12-22","2009-01-02",$holidays)
 *
 * => will return 7
 *
 * */