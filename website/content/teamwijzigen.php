<?
define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"toevoegen");
define("PAGINA_CATEGORIE"	, 	"team");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Wijzigen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();



include(ROOT_WEBSITE."includes/header.php");
$team = new team();
$werknemer = new werknemer();

if (isset($_POST['teamnaam'])){
	$wijzigTeam = $team->wijzigTeam($_POST);
	if (!$wijzigTeam) {
		$document->failed('Team','gewijzigd');
	}
	else{
		$document->success('Team','gewijzigd');
	}
}
if (isset($_GET['var2'])){
	$huidigteam=$team->getTeam($_GET['var2']);
} else {
	
}

?>


<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Team wijzigen</h1>
			<hr>
			<? foreach ($huidigteam as $row) { ?>
			<form role="form" method="post" action="">
			  <input type="hidden" id="id" value="<?=$row->id?>" name="id">
			  <div class="form-group">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <input type="text" class="form-control" value="<?=$row->teamnaam?>" name="teamnaam" id="teamnaam" placeholder="Teamnaam">
			    	</div>
			    </div>
			    <label for="teamleider">Teamleider</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <select class="form-control" name="idteamleider" id="idteamleider" placeholder="Teamnaam">
					    
						    <?
						    $result = $werknemer->alleGebruikers(); 
						    foreach ($result as $rij) { ?> 
					    	<option value="<?=$rij->id?>" <? if ($rij->id==$row->idteamleider) { echo("selected"); }?>><?=$rij->voornaam?> <?=$rij->tussenvoegsel?> <?=$rij->achternaam?></option>
					    	<? } ?>
					    </select>
			    	</div>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			<? } ?>
		</div>
	</div>
</div>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>