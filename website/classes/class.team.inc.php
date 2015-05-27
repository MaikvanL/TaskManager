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

        $execute = $db->insert('team',['id'=>null,'teamnaam'=>$naam,'idteamleider'=>$olv]);
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

        $execute = $db->update('team',['teamnaam'=>$naam,'idteamleider'=>$olv],'`id`='.$id);
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

        $result = $db->select('team',null,'`id`='.$teamid);
        foreach ($result as $result)
            $result = $result->actief;


        if ($result == 1) {
            $db->update('team',['actief'=>0],'`id` = '.$teamid);
            $melding = "Ik ben naar niet actief gezet";
        }

        if ($result == 0) {
            $db->update('team',['actief'=>1],'`id` = '.$teamid);
            $melding = "Ik ben actief gezet";

        }

        return $melding;
    }



    public function alleTeams(){
        $db = new Database();
        $db->connect();
        $alleteams = $db->select('team','*');
        return $alleteams;
    }

    public function getSubTeamByLeader($userId){
        $db = new Database();
        $db->connect();
        $teamId = $db->select('team','id',null,'`idteamleider` = '.$userId);

        foreach ($teamId as $row) {
            $subteams = $this->getSubteams($row->id);
        }
        return $subteams;
    }

    public function getSubteams($teamid){
        $db = new Database();
        $db->connect();
        $subteams = $db->select('subteam','*',null,'`idteam` = '.$teamid);
        return $subteams;
    }

    public function getTeam($teamid)
    {
        $db = new Database();
        $db->connect();
        return $db->select('team','*',null,'`id` = '.$teamid);
    }

    public function toggleActive($teamid)
    {
        $db = new Database();
        $db->connect();
        $result = $db->select('team', 'actief', null, 'id = '.$teamid);
        foreach ($result as $results) ;
        $result = $results->actief;


        if ($result == 1) {
            $db->update('team', ['actief' => 0], '`id` = '.$teamid);
            $melding = "inactief";
        }

        if ($result == 0) {
            $db->update('team', ['actief' = 1], '`id` = '.$teamid);
            $melding = "actief";

        }

        return $melding;
    }

}

?>

