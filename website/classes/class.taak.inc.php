<?php

class Taak {
    public function addTask($data){
        $db = new Database();

        $subteam        =   $db->escapeString($data['subteam']);
        $code           =   $db->escapeString($data['code']);
        $soort          =   $db->escapeString($data['categorie']);
        $naam           =   $db->escapeString($data['naam']);
        $beschrijving   =   $db->escapeString($data['omschrijving']);
        $klokuren       =   $db->escapeString($data['klokuren']);
        $lesuren        =   $db->escapeString($data['lesuren']);

        $db->connect();
        $tabelinfo = ['subteam'=>$subteam,'code'=>$code,'soort'=>$soort,'naam'=>$naam, 'beschrijving'=>$beschrijving,'klokuren'=>$klokuren,'lesuren'=>$lesuren];
        $db->insert('taken',$tabelinfo);
        return true;
    }
    public function editTask($data){
        $db = new Database();

        $id             =   $db->escapeString($data['id']);
        $subteam        =   $db->escapeString($data['subteam']);
        $code           =   $db->escapeString($data['code']);
        $soort          =   $db->escapeString($data['categorie']);
        $naam           =   $db->escapeString($data['naam']);
        $beschrijving   =   $db->escapeString($data['omschrijving']);
        $klokuren       =   $db->escapeString($data['klokuren']);
        $lesuren        =   $db->escapeString($data['lesuren']);

        $db->connect();
        $db->update('taken',array('subteam'=>$subteam,'code'=>$code,'soort'=>$soort,'naam'=>$naam, 'beschrijving'=>$beschrijving,'klokuren'=>$klokuren,'lesuren'=>$lesuren),'tk_id = '.$id);
        return true;
    }
    public function deleteTask($taskid){
        $db = new Database();
        $db->connect();
        $db->delete('taken','`tk_id` = '.$taskid);
    }

    public function getTask($taskid){
        $db = new Database();
        $db->connect();
        $db->select('taken','*',null,'`tk_id` = '.$taskid);
        return $db->getResult();
    }

    public function allTasks(){
        $db = new Database();
        $db->connect();
        $db->select('taken','*');
        return $db->getResult();
    }
    public function subteamTasks($subteam){
        $db = new Database();
        $db->connect();
        $db->select('taken','*',null,'subteam = '.$subteam);
        return $db->getResult();
    }

    public function getUserTaak($taakid,$userid){
        $db = new Database();
        $db->connect();
        $db->select('taak_user','*',null,'tk_id = '.$taakid.' AND wn_id = '.$userid);
        return $db->getResult();
    }

    public function getTotalAssigned($subteam,$user){
        $sum = 0;
        $db = new Database();
        $db->connect();
        $db->select('taak_user','*',null,'wn_id = '.$user.' AND st_id = '.$subteam);
        $result = $db->getResult();
        foreach ($result as $r){
            $sum += $r['tu_taken'];
        }
        return $sum;
    }
}