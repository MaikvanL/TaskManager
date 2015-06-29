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

    public function allTasks($subteam = null){
        $db = new Database();
        $db->connect();
        $db->select('taken','*',null,$subteam);
        return $db->getResult();
    }

}