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


$subteam = new Subteam();
$school = new School();


include(ROOT_WEBSITE."includes/header.php");
if (isset($_GET['var2'])){
	$huidigsubteam = $subteam->getSubteam($_GET['var2']);
}
if (isset($_GET['var3'])){
    if($_GET['var3'] == 'delete'){
        $subteam->verwijderDocent($_GET['var4'],$_GET['var2']);
    }
}
if (isset($_POST['subteamuser'])){
    $addWerknemer = $subteam->addWerknemer($_POST['subteamuser'],$_GET['var2']);
    if (!$addWerknemer){
        $document->failed('Gebruiker','toegevoegd');
    }
    else {
        $document->success('Gebruiker', 'toegevoegd');
    }
}

foreach ($huidigsubteam as $row) {
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

                            foreach ($leden as $subteamlid) { ?>

                            <tr class="row">
                                <td class="col-md-10"><?=$subteamlid['voornaam']?> <?=$subteamlid['tussenvoegsel']?> <?=$subteamlid['achternaam']?></td>
                                <td class="col-md-2"><a href="<?=HTTP?>gebruikerswijzigen/<?=$subteamlid['wn_id']?>"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;<a href="<?=HTTP?>subteaminzien/<?=$_GET['var2']?>/delete/<?=$subteamlid['wn_id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                            </tr>

                        <?  } ?>
                        </table>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="margin-top:0px;">Leden toevoegen</h3>
                            <?
                                $allUsers = $werknemer->alleGebruikers();
                            ?>
                            <form method="post">
                                <select name="subteamuser" class="userselect" style="width:250px;">
                                    <?  foreach ($allUsers as $user){?>
                                        <option id="<?=$user['wn_id']?>" value="<?=$user['wn_id']?>"><?=$user['voornaam']?> <?=$user['tussenvoegsel']?> <?=$user['achternaam']?></option>
                                    <?}?>
                                </select>
                                <button type="submit" class="btn btn-default">Submit</button>

                            </form>

                        </div>
                    </div>

				</div>
			</div>

		</div>
	</div>
</div>
<? }?>
<script>
    $(function(){ $(".userselect").select2(); });
	$(function(){ $("#datepicker").datepicker();  });
</script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>