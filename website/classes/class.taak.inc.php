<?php

class Taak extends Database {
    public function add($data){
        $db = new dbNew();

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
        $db = new dbNew();

        $id             =   $db->escapeString($data['id']);
        $subteam        =   $db->escapeString($data['subteam']);
        $code           =   $db->escapeString($data['code']);
        $soort          =   $db->escapeString($data['categorie']);
        $naam           =   $db->escapeString($data['naam']);
        $beschrijving   =   $db->escapeString($data['omschrijving']);
        $klokuren       =   $db->escapeString($data['klokuren']);
        $lesuren        =   $db->escapeString($data['lesuren']);

        $db->connect();
        $db->update('taken',array('subteam'=>$subteam,'code'=>$code,'soort'=>$soort,'naam'=>$naam, 'beschrijving'=>$beschrijving,'klokuren'=>$klokuren,'lesuren'=>$lesuren),'id = $id');
        $db->disconnect();

    }
    public function delete($taskid){
        $db = new dbNew();
        $query = "DELETE * FROM `taken` WHERE `id`= $taskid";
        $this->query($query);
    }
}