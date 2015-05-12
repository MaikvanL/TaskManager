<?

define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"team");




$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Overzicht');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();


include(ROOT_WEBSITE."includes/header.php");

?>
<style>
@media (max-width: 767px) { 
.indienstneming { display:none !important; } 

}
</style>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Subteam overzicht</h1>
			<hr>
			<table class="table table-hover">
				<thead>
					<tr class="row">
						<th class="col-md-3 col-xs-3">Naam subteam</th>
						<th class="col-md-2 col-xs-3">Team</th>
						<th class="col-md-4 col-xs-3">Opleidingsverantwoordelijke</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<? 	
				$subteam = new subteam();
				$result = $subteam->overzicht();
				
				$werknemer = new werknemer();
				$team = new team();

				foreach ($result as $row) {
				?>
					<tr class="row">
						<td class="col-md-3 col-xs-3"><?=$row->subteamnaam?></td>
						<td class="col-md-2 col-xs-3">
							<?
								$teamresult = $team->getTeam($row->idteam);
								foreach ($teamresult as $teamdata) { 
								
								echo($teamdata->teamnaam);
								
								}

							?>
						</td>
						<td class="col-md-4 col-xs-3"><? 
							$olvresult = $werknemer->getGebruiker($row->idopleidingsverantwoordelijke);
							foreach ($olvresult as $olv) {							
							?>
							<?=$olv->voornaam?> <?=$olv->tussenvoegsel?> <?=$olv->achternaam?>
							<? } ?></td>
						<td class="col-md-1 col-xs-2"><a href="?action=remove&id=<?=$row->id?>"><span class="glyphicon glyphicon glyphicon-trash"></span></a></td>
						<td class="col-md-1 col-xs-2"><a href="subteaminzien/<?=$row->id?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
						<td class="col-md-1 col-xs-2"><a href="subteamwijzigen/<?=$row->id?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
				<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script> 
	document.ready()({
		$("#archiveren").click(function()){
		});
		
	});
	
</script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>