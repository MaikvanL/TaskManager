<?
// Configuratiebestand
// Maik van Lieshout


// Standaard site instellingen
define("SITE_TITEL"	,	"Task Manager");
define("DB_HOSTNAME",	"localhost");
define("DB_USERNAME",	"mvlc_taskmgr");
define("DB_PASSWORD",	"Stipjes123");
define("DB_DATABASE",	"mvlc_taskmgr");
// LOCATIE SERVER
define("HTTP_SERVER",	"http://taskmgr.mvlcreatie.nl/");
define("ROOT_SERVER",	$_SERVER["DOCUMENT_ROOT"]."/");
// LOCATIE WEBSITE
define('HTTP_WEBSITE', HTTP_SERVER.'website/');
define('ROOT_WEBSITE',  ROOT_SERVER.'website/');

// Plugins inladen

// Bootstrap
?>