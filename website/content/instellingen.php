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
    <div class="col-md-9">
    <div class="content">
        <div class="row">
            <div class="col-md-7">
            <legend>Jaartaak opgeven</legend>
                <form method="post">
                    <div class="row">
                        <div class="col-md-10">
                            <label>Urennorm</label>
                            <input type="text" class="form-control" name="urennorm" id="urennorm" placeholder="Urennorm"
                        </div>
                    </div>
                    <div>
                    <div class="row">
                        <label></label>


                    </div>
                    </div>

            </div>
            <div class="col-md-5">
                <legend>Subteam</legend>
                <select name="subteam" class="subteamselect" style="width:250px;">
                    <option id="" value=" ">Algemene taak</option>

                    <?  foreach ($subteams as $row){?>
                        <option id="<?=$row['id']?>" value="<?=$row['id']?>"><?=$row['subteamnaam']?></option>
                    <?}?>
                </select>
                <div style = "margin-top:20px">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Opslaan</button>
                </div>
            </div>

          <div class="form-group">
            <label for="urennorm">Urennorm</label>
            <div class="col-md-2" style="padding-right:5px;">
                <input type="text" class="form-control" name="jaartaak" id="jaartaak" placeholder="Jaartaak uren">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="weken" id="weken" placeholder="Weken">
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

                    </div>
                </div>
            </div>
        </form>


    </div>
    </div>
</div>
    <script>
        $(function(){ $("#datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                maxDate: 0
            }
        );  });
    </script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>