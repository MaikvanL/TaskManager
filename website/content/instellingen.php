<?
define("PAGINA_TITEL"		,	"Instellingen");
define("PAGINA_NAAM"		,	"instellingen");
define("PAGINA_CATEGORIE"	, 	"instellingen");
define("USER_LEVEL", 4);

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
    <div class="content">
        <h1 style="margin-top:0px;">Instellingen</h1>
        <hr>
        <form role="form" method="post" action="">
          <div class="form-group">
            <label for="naam">Urent</label>


          </div>

        </form>

    </div>

</div>