<?
define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"toevoegen");
define("PAGINA_CATEGORIE"	, 	"team");
define("USER_LEVEL", 2);

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();


include(ROOT_WEBSITE."includes/header.php");

$werknemer = new werknemer();
$result = $werknemer->alleGebruikers();

?>


<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Team toevoegen</h1>
			<hr>
			<? 
				if (isset($_POST['teamnaam'])){
					$team = new team();
					$createTeam  = $team->maakTeam($_POST);
					if (!$createTeam){
						$document->failed('Team', 'toegevoegd');
					}
					else { 
						$document->success('Team', 'toegevoegd');
					}
				}
				?>

			<form role="form" method="post" action="">
			  <div class="form-group">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <input type="text" class="form-control" name="teamnaam" id="teamnaam" placeholder="Teamnaam">
			    	</div>
			    </div>
			    <label for="teamleider">Teamleider</label>
			    <div class="row">
			    	<div class="col-md-12">
					    <select class="form-control" name="teamleider" id="teamleider">
						    <? foreach ($result as $row) { ?> 
					    	<option value="<?=$row->id?>"><?=$row->voornaam?> <?=$row->tussenvoegsel?> <?=$row->achternaam?></option>
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