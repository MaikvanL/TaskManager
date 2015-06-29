<?
define("PAGINA_TITEL"		,	"Inzien");
define("PAGINA_NAAM"		,	"wijzigen");
define("PAGINA_CATEGORIE"	, 	"gebruiker");
define("USER_LEVEL", 2);

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Inzien','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();


include(ROOT_WEBSITE."includes/header.php");
if (isset($_GET['var2'])){
	$team = new team();
	$huidigteam = $team->getTeam($_GET['var2']);
}

foreach ($huidigteam as $row) {

    $werknemer = new Werknemer();
    $teamleider = $werknemer->getGebruiker($row['tl_id']);

    foreach ($teamleider as $tl) {

    }
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<div class="row">
				<div class="col-md-6">
					<h3>Team informatie</h3>
					<hr>
					<strong>Naam:</strong> <?=$row['teamnaam']?><br>
                    <strong>Teamleider:</strong> <?=$tl['voornaam']?> <?=$tl['tussenvoegsel']?> <?=$tl['achternaam']?>
				</div>
				<div class="col-md-6">
					<h3>Onderdelen</h3>
					<hr>
					<table>
                        <tr class="row">
					    	<th class="col-md-10">Naam</th>
						   	<th class="col-md-2"></th>
                        </tr>
					<?
						$subteam = new subteam();
						$subteams = $subteam->getSubteams($_GET['var2']);
						foreach($subteams as $subteam){							
							?> 
							<tr class="row">
								<td class="col-md-10"><?=$subteam['subteamnaam']?></td>
                                <td class="col-md-2"><a href="<?=HTTP?>subteamwijzigen/<?=$subteam['st_id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
							</tr>
							<?
						
						}
					?>
				</div>
			</div>
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">

                </div>
            </div>

        </div>
	</div>
</div>
<? } ?>
<script>
	$(function(){ $("#datepicker").datepicker();  });
</script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>