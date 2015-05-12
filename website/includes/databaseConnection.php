<?php
$username = "mvlc_taskmgr";
$password = "Stipjes123";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("mvlc_taskmgr",$dbhandle) 
or die("Failed to connect: ".mysql_error());

?>