<?
define("PAGINA_TITEL"		,	"Taaktoevoegen");
define("PAGINA_NAAM"		,	"taaktoevoegen");
define("PAGINA_CATEGORIE"	, 	"taken");
define("USER_LEVEL", 4);
include(ROOT_WEBSITE."includes/header.php");
$session = $_SESSION['userlevel'];
$userId  = $_SESSION['id'];
$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Taak toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();
$document->checkUserlevel($session, USER_LEVEL);

$subteam = new subteam();
$taak = new Taak();
$subteams=$subteam->overzicht();
if (isset($_POST['naam'])){
    $addTaak = $taak->add($_POST);
    if (!$addTaak){
        $document->failed('Taak','toegevoegd');
    }
    else {
        $document->success('Taak', 'toegevoegd');
    }

}


?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9">
		<div class="content">
			<div class="row">
				<div class="col-md-7">
						<legend>Taak toevoegen aan subteam</legend>
					<form method="post">
						<div class="row">
							<div class="col-md-10">
								<label>Categorie</label>
                                <!-- Hier moet een foreach loop komen met de categorieën die later beheerbaar gemaakt zullen worden, tot die tijd handmatig invullen -->
								<input type="text" class="form-control" name="categorie" id="categorie" placeholder="Naam">
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Code</label>
								<input type="text" class="form-control" name="code" id="code" placeholder="code">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Naam</label>
								<input type="text" class="form-control" name="naam" id="naam" placeholder="Naam">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-10">
								<label>Omschrijving</label>
								<input type="text" class="form-control" name="omschrijving" id="omschrijving" placeholder="Omschrijving">		
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<label>Klokuren</label>
								<input type="text" class="form-control" name="klokuren" id="klokuren" placeholder="Klokuren">		
							</div>
							<div class="col-md-5">
								<label>Lesuren</label>
								<input type="text" class="form-control" name="lesuren" id="lesuren" placeholder="Lesuren">		
							</div>
						</div>	
						</div>
						<div class="col-md-5">
							<legend>Subteams</legend>
							<select multiple="multiple" name="subteam" class="subteamselect" style="width:250px;">
							<?  foreach ($subteams as $row){?>		
								<option id="<?=$row->id?>" value="<?=$row->id?>"><?=$row->subteamnaam?></option>
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
<script>$(".subteamselect").select2();</script>
<style> .subteamselect { min-height:295px; } </style>
<? 
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>
