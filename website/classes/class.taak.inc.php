<?php

class Taak extends Database {
    public function add($data){
        $subteam        =   mysql_real_escape_string($data['']);
        $code           =   mysql_real_escape_string($data['']);
        $soort          =   mysql_real_escape_string($data['']);
        $naam           =   mysql_real_escape_string($data['']);
        $beschrijving   =   mysql_real_escape_string($data['']);
        $klokuren       =   mysql_real_escape_string($data['']);
        $lesuren        =   mysql_real_escape_string($data['']);

        $query = "INSERT INTO `taken` (`subteam`, `code`, `soort`, `naam`, `beschrijving`, `klokuren`, `lesuren`)
                              VALUES ($subteam, $code, $soort, $naam, $beschrijving, $klokuren, $lesuren);";
        $this->query($query);


    }
}