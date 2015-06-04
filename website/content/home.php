<?
define("PAGINA_TITEL"		,	"Home");
define("PAGINA_NAAM"		,	"home");
define("PAGINA_CATEGORIE"	, 	"home");
define("USER_LEVEL", 4);
if (empty($_SESSION)){ ?>
    <script>location.href = 'http://taskmgr.mvlcreatie.nl/home'</script>
<? }


$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Home','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();




include(ROOT_WEBSITE."includes/header.php");

?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Home</h1>
			<hr>
            <p>
                Welkom bij Scalda Task Manager. Het nieuwe interactieve platform voor de Urennorm Taakverdeling.
            </p>
            <h4>Changelog v0.2:</h4>
            <ul>
                <li>Databaseconnectie is geoptimaliseerd voor een betere snelheid en effectievere resultaten</li>
                <li>Taakbeheer is functioneel</li>
                <li>Verbeterde controles op invoer</li>
                <li>Stabiliteit verbeterd</li>
                <li>Loginportaal vernieuwd</li>
                <li>Quickmenu is gepersonaliseerd</li>
            </ul>
            <h4>Changelog v0.1:</h4>
            <ul>
                <li>Databaseverbinding is functioneel</li>
                <li>Werknemersbeheer is functioneel</li>
                <li>Responsive ondersteuning toegevoegd</li>
                <li>Quickmenu toegevoegd</li>
                <li>Loginportaal is functioneel</li>
            </ul>
		</div>
	</div>
</div>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>