<?php

$hostname="localhost";
$database="mvlc_taskmgr";
$username="mvlc_taskmgr";
$password="Stipjes123";

//DO NOT EDIT BELOW THIS LINE
$link = mysql_connect($hostname, $username, $password);
if (!$link) {
die('Connection failed: ' . mysql_error());
}


$db_selected = mysql_select_db($database, $link);
if (!$db_selected) {
    die ('Can\'t select database: ' . mysql_error());
}


mysql_close($link);

?>