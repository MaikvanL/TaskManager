<?php

class Taak {
    public function add($data){
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

    }
    public function edit($data){
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
        $db->update('taken',array('subteam'=>$subteam,'code'=>$code,'soort'=>$soort,'naam'=>$naam, 'beschrijving'=>$beschrijving,'klokuren'=>$klokuren,'lesuren'=>$lesuren),'id = '.$id);

    }
    public function delete($taskid){
        $db = new Database();
        $db->connect();
        $db->delete('taken','`id` = '.$taskid);
    }
}