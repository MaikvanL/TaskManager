<?
// 	NIET WIJZIGEN
// 	STANDAARD INITIEERBESTAND
//  Maik van Lieshout


define('HTTP_CURRENT', HTTP_WEBSITE);
define('ROOT_CURRENT', ROOT_WEBSITE);
define('HTTP', HTTP_SERVER);
define('ROOT', ROOT_SERVER);

include(ROOT_WEBSITE.'autoload.php');
$document = new document();

if (isset($_GET['var1'])) {
	if($_GET['var1']!="login") { require(ROOT_WEBSITE.'includes/checklogin.php'); }
}
if (isset($_GET['var1'])) {
	if($_GET['var1']=='') { $_GET['var1']='home'; }
}

if (isset($_GET['var1'])) {
 if (file_exists(ROOT_WEBSITE.'content/'.$_GET['var1'].'.php')==true) {
	include(ROOT_WEBSITE.'content/'.$_GET['var1'].'.php');
} } 
else {
	include(ROOT_WEBSITE.'content/home.php');
}
?>
