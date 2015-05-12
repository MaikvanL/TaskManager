<?
define("PAGINA_TITEL"		,	"Test");
define("PAGINA_NAAM"		,	"test");
define("PAGINA_CATEGORIE"	, 	"test");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");	
$session = $_SESSION['userlevel'];
$userId  = $_SESSION['id'];
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Home','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();



$werknemer = new werknemer();
$test=$werknemer->toggleActive(4);
echo $test;

$document->open_body();
$document->checkUserlevel($session, USER_LEVEL);
$document->close_body();
$document->close_html();
?>
