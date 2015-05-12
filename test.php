<?php
include("website/includes/start.php");
include("index.php");

$test = new werknemer();

$alles = $test->alleGebruikers();

print_r($alles);

echo "string";

?>