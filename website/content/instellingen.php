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
    <div class="col-md-9 col-xs-12">
    <div class="content">
        <h1 style="margin-top:0px;">Instellingen</h1>
        <hr>
        <form role="form" method="post" action="">
                        <div class="row">
                            <div class="col-md-10">
                                <label>Naam</label>
                                <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam">
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-10">
								<label>Code</label>
								<input type="text" class="form-control" name="code" id="code" placeholder="Code">
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Omschrijving</label>
								<input type="text" class="form-control" name="omschrijving" id="omschrijving" placeholder="Omschrijving">
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-10">
                                <label>Categorie</label><br>
                                <!-- Hier moet een foreach loop komen met de categorieën die later beheerbaar gemaakt zullen worden, tot die tijd handmatig invullen -->
                                <select name="categorie" class="categorieselect" style="width:250px;">
                                    <option id="" value="Primair proces">Primair proces</option>
                                    <option id="" value="Secundair proces">Secundair proces</option>
                                    <option id="" value="Promotie">Promotie</option>
                                    <option id="" value="Misc">Misc</option>
                                </select>
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-5">
								<label>Klokuren</label>
								<input type="number" class="form-control" name="klokuren" id="klokuren" placeholder="Klokuren">
							</div>
							<div class="col-md-5">
								<label>Lesuren</label>
								<input type="number" class="form-control" name="lesuren" id="lesuren" placeholder="Lesuren">
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