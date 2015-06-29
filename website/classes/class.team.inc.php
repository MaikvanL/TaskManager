<?php

/**
* Class voor Team.
 * Revision: Maik van Lieshout
*/
class Team
{



    public function maakTeam($data){
        $db = new Database();
        $naam   = $db->escapeString($data['teamnaam']);
        $olv    = $db->escapeString($data['teamleider']);

        $db->connect();

        $execute = $db->insert('team',['t_id'=>null,'teamnaam'=>$naam,'tl_id'=>$olv]);
        if ($execute) {
            return true;
        } else {
            return false;
        }

    }

    public function wijzigTeam($data)
    {
        $db = new Database();
        $id     = $db->escapeString($data['id']);
        $naam   = $db->escapeString($data['teamnaam']);
        $olv    = $db->escapeString($data['idteamleider']);
        $db->connect();

        $execute = $db->update('team',['teamnaam'=>$naam,'tl_id'=>$olv],'`t_id`='.$id);
        if ($execute) {
            return true;
        } else {
            return false;
        }
    }

    public function archiveerTeam($teamid)
    {
        $db = new Database();
        $db->connect();

        $result = $db->select('team',null,'`t_id`='.$teamid);
        foreach ($result as $result)
            $result = $result->actief;


        if ($result == 1) {
            $db->update('team',['actief'=>0],'`t_id` = '.$teamid);
            $melding = "Ik ben naar niet actief gezet";
        }

        if ($result == 0) {
            $db->update('team',['actief'=>1],'`t_id` = '.$teamid);
            $melding = "Ik ben actief gezet";

        }

        return $melding;
    }



    public function alleTeams(){
        $db = new Database();
        $db->connect();
        $db->select('team');
        $alleteams = $db->getResult();
        return $alleteams;
    }

    public function getSubTeamByLeader($userId){
        $db = new Database();
        $db->connect();
        $teamId = $db->select('team','t_id',null,'`tl_id` = '.$userId);

        foreach ($teamId as $row) {
            $subteams = $this->getSubteams($row->id);
        }

        return $subteams;
    }

    public function getSubteams($teamid){
        $db = new Database();
        $db->connect();
        $db->select('subteam','*',null,'`t_id` = '.$teamid);

        return $db->getResult();
    }

    public function getTeam($teamid)
    {
        $db = new Database();
        $db->connect();
        $db->select('team','*',null,'`t_id` = '.$teamid);
        return $db->getResult();

    }

    public function toggleActive($teamid)
    {
        $db = new Database();
        $db->connect();
        $db->select('team', 'actief', null, 't_id = '.$teamid);
        $result = $db->getResult();
        foreach ($result as $results) ;
        $result = $results['actief'];


        if ($result == 1) {
            $db->update('team', ['actief' => 0], '`t_id` = '.$teamid);
            $melding = "inactief";
        }

        if ($result == 0) {
            $db->update('team', ['actief' => 1], '`t_id` = '.$teamid);
            $melding = "actief";

        }

        return $melding;
    }

}

?>

