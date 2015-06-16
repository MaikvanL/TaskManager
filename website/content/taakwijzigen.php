<?
define("PAGINA_TITEL"		,	"Taaktoevoegen");
define("PAGINA_NAAM"		,	"taaktoevoegen");
define("PAGINA_CATEGORIE"	, 	"taak");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$session = $_SESSION['userlevel'];
$userId  = $_SESSION['id'];
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Taak wijzigen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$document->checkUserlevel($session, USER_LEVEL);

$taak = new Taak();
$subteam = new subteam();
$subteams = $subteam->overzicht();
if (isset($_POST['id'])){
    $wijzigTaak = $taak->editTask($_POST);
    echo($wijzigTaak);
    if (!$wijzigTaak){
        $document->failed('Taak', 'gewijzigd');
    }
    else {
        $document->success('Taak', 'gewijzigd');
    }
}

if (isset($_GET['var2'])){
    $taak = new Taak();
    $task=$taak->getTask($_GET['var2']);
}
foreach($task as $taskrow){
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9">
		<div class="content">
			<div class="row">
				<div class="col-md-7">
					<legend>Taak wijzigen</legend>
					<form method="post">
					    <input name="id" type="hidden" value="<?=$taskrow['id']?>">
						<div class="row">
							<div class="col-md-10">
								<label>Code</label>
								<input type="text" class="form-control" name="code" id="code" value="<?=$taskrow['code']?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Naam</label>
								<input type="text" class="form-control" name="naam" id="naam" value="<?=$taskrow['naam']?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Omschrijving</label>
								<input type="text" class="form-control" name="omschrijving" id="omschrijving" value="<?=$taskrow['beschrijving']?>">
							</div>
						</div>
						<div class="row">
                            <div class="col-md-10">
                                <label>Categorie</label><br>
                                <!-- Hier moet een foreach loop komen met de categorieën die later beheerbaar gemaakt zullen worden, tot die tijd handmatig invullen -->
                                <select name="categorie" class="categorieselect" style="width:250px;" value="<?=$taskrow['categorie']?>">
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
								<input type="text" class="form-control" name="klokuren" id="klokuren" value="<?=$taskrow['klokuren']?>">
							</div>
							<div class="col-md-5">
								<label>Lesuren</label>
								<input type="text" class="form-control" name="lesuren" id="lesuren" value="<?=$taskrow['lesuren']?>">
							</div>
						</div>
						</div>
						<div class="col-md-5">
							<legend>Subteam</legend>
							<select name="subteam" class="subteamselect" style="width:250px;">
							<?  foreach ($subteams as $row){?>
                            <option id="<?=$row['id']?>" value="<?=$row['id']?>" <? if ($row['id']== $taskrow['subteam']) { ?> selected <? } ?>><?=$row['subteamnaam']?></option>
    <?}?>
							</select>
							<div style = "margin-top:20px">
								<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Opslaan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!--einde content-->
	</div>
</div>
<? } ?>
<script>
    $(".categorieselect").select2();
    $(".subteamselect").select2();
$(function() {
    var spinner = $( "#klokuren").spinner({ step: "0.1" });
    var spinner2 = $( "#lesuren").spinner({ step: "0.1" });

});





</script>
<?

include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>
