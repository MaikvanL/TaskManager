<?
define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"toevoegen");
define("PAGINA_CATEGORIE"	, 	"team");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();



include(ROOT_WEBSITE."includes/header.php");
if (isset($_POST['teamnaam'])){
	$team = new team();
	$team->maakTeam($_POST);
}

$werknemer = new werknemer();
$result = $werknemer->alleGebruikers();
$team = new team();
$teamresult = $team->alleTeams();

?>


<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Subteam toevoegen</h1>
			<hr>
			<form role="form" method="post" action="">
			  <div class="form-group">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <input type="text" class="form-control" name="subteamnaam" id="subteamnaam" placeholder="Subteamnaam">
			    	</div>
			    </div>
			    <label for="afdelingverantwoordelijke">Afdelingverantwoordelijke</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <select class="form-control" name="afdelingverantwoordelijke" id="afdelingverantwoordelijke" placeholder="Afdelingverantwoordelijke">
						    <? foreach ($result as $row) { ?> 
					    	<option value="<?=$row->id?>"><?=$row->voornaam?> <?=$row->tussenvoegsel?> <?=$row->achternaam?></option>
					    	<? } ?>
					    </select>
			    	</div>
			    </div>
			    <label for="team">Team</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <select class="form-control" name="team" id="team" placeholder="Team">
						    <? foreach ($teamresult as $teamrow) { ?> 
					    	<option value="<?=$teamrow->id?>"><?=$teamrow->teamnaam?></option>
					    	<? } ?>
					    </select>
			    	</div>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>

		</div>
	</div>
</div>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>