<?
define("PAGINA_TITEL"		,	"Inzien");
define("PAGINA_NAAM"		,	"inzien");
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
	$subteam = new Subteam();
	$huidigsubteam = $subteam->getSubteam($_GET['var2']);
}

foreach ($huidigsubteam as $row) {
print_r($row);
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<div class="row">
				<div class="col-md-6">
					<h3>Subteam Informatie</h3>
                    <hr>
                    <table>
					<tr><td>Naam:</td><td><?=$row['subteamnaam']?></td></tr>
                    <tr><td>Subteamleider: </td>
                        <td><?
                            $werknemer = new werknemer();
                            $olv = $werknemer->getGebruiker($row['olv_id']);
                            foreach ($olv as $verantwoordelijke) {
                                print ($verantwoordelijke['voornaam'].' '.$verantwoordelijke['tussenvoegsel'].' '.$verantwoordelijke['achternaam']);
                            }
                            ?></td></tr>
                    </table>
				</div>
				<div class="col-md-6">
					<h3>Leden</h3>
                    <div class="row">
                        <table class="col-md-12">
                        <?
                            $leden = $subteam->getWerknemers($row['st_id']);

                            foreach ($leden as $subteamlid) {
                                print_r($subteamlid);
                                ?>

                            <tr class="row">
                                <td class="col-md-9"><?=$subteamlid['wn_id']?> <?=$subteamlid['voornaam']?> <?=$subteamlid['tussenvoegsel']?> <?=$subteamlid['achternaam']?></td>
                                <td class="col-md-3"><a href="<?=HTTP?>gebruikerswijzigen/<?=$subteamlid['wn_id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>

                        <?  } ?>
                        </table>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="margin-top:0px;">Leden toevoegen</h3>
                            <? print_r($leden); ?>
                            <hr>
                            <?
                                $allUsers = $werknemer->alleGebruikers();
                                $notInSubteam = $subteam->checkNotInSubteam($allUsers,$leden);
                                print_r($notInSubteam);
                            ?>
                        </div>
                    </div>

				</div>
			</div>

		</div>
	</div>
</div>
<? }?>
<script>
	$(function(){ $("#datepicker").datepicker();  });
</script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>