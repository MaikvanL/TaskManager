<?php
include(ROOT_WEBSITE.'includes/databaseConnection.php');

session_start();
$array=$_SESSION['info'];
$user=$_SESSION['login'];
$currentuserid=$_SESSION['id'];

if (!isset($user)){
	echo "je bent niet ingelogd";
	header('location: login');
}


/*
$sql = "SELECT id FROM werknemer where email='$user";
echo $sql;
$result = mysql_query($sql);
$value = mysql_fetch_array($result);
*/

?>





