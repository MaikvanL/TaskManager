<?

define("PAGINA_TITEL"		,	"Instellingen");
define("PAGINA_NAAM"		,	"instellingen");
define("PAGINA_CATEGORIE"	, 	"instellingen");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Instellingen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();



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
            <label for="urennorm">Urennorm</label>
            <div class="col-md-2" style="padding-right:5px;">
                <input type="text" class="form-control" name="jaartaak" id="jaartaak" placeholder="Jaartaak uren">
            </div>
            <div class="col-md-2" style="padding-left:5px; padding-right:5px;">
                <input type="text" class="form-control" name="weken" id="weken" placeholder="Weken">
            </div>
            <div class="col-md-3" style="padding-left:5px; padding-right:5px;">
                <input type="text" class="form-control" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel">
            </div>
            <div class="col-md-3" style="padding-left:5px;">
                <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam">
            </div>
          </div>
            <div class="form-group">
                <label for="adresgegevens">Adresgegevens</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-9" style="padding-right:5px;">
                                <input type="text" class="form-control" name="straat" id="straat" placeholder="Straatnaam">
                            </div>
                            <div class="col-md-3" style="padding-left:5px;">
                                <input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnr.">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8" style="padding-right:5px;">
                                <input type="text" class="form-control" name="woonplaats" id="woonplaats" placeholder="Woonplaats">
                            </div>
                            <div class="col-md-4" style="padding-left:5px;">
                                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>