<?

define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"taak");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Taakverdeling');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();


include(ROOT_WEBSITE."includes/header.php");

$task = new Taak();
$school = new School();
$subteam = new Subteam();
$werknemer = new Werknemer();

$taken      = $task->subteamTasks($_GET['var2']);
$curyear    = $school->getYear($_GET['var3']);
$stdocenten = $subteam->getWerknemers($_GET['var2']);
$curSubteam = $subteam->getSubteam($_GET['var2']);

?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Taakverdeling</h1>
            <? foreach ($curSubteam as $cs) { ?>
                <h4>Subteam: <?=$cs['subteamnaam']?></h4>
                <?
                $olvresult = $werknemer->getGebruiker($cs['olv_id']);
                foreach ($olvresult as $olv) { ?>
                    <h5>Opleidingverantwoordelijke: <?=$olv['voornaam']?> <?=$olv['tussenvoegsel']?> <?=$olv['achternaam']?></h5>
                <? } ?>
            <? } ?>
			<hr>
			<table class="table table-hover">
				<thead>
                    <tr>
                        <th class="noborder"></th>
                        <th class="noborder"></th>
                        <th class="noborder"></th>
                        <th class="verdeling noborder">To-do</th>
                        <? foreach ($stdocenten as $stdocent) {
                             ?>
                            <th class="verdeling noborder center"><? foreach($curyear as $cy) { echo($cy['urennorm']*$stdocent['wtf']); } ?></th>
                        <? } ?>
                    </tr>
                    <tr>
                        <th class="noborder"></th>
                        <th class="noborder"></th>
                        <th class="noborder"></th>
                        <th class="verdeling noborder">Assigned</th>
                        <? foreach ($stdocenten as $stdocent) { ?>
                            <th class="verdeling noborder center"><? echo($task->getTotalAssigned($_GET['var2'],$stdocent['wn_id'])); ?></th>
                        <? } ?>
                    </tr>

                    <tr>
                        <th class="noborder">Taak</th>
                        <th class="noborder center">Code</th>
                        <th class="noborder">Opmerking</th>
                        <th class="noborder">Klokuren</th>
                        <? foreach ($stdocenten as $stdocent) { ?>
                            <th class="verdeling noborder"><?=$stdocent['afkorting']?></th>
                        <? } ?>
                    </tr>
				</thead>
				<tbody>
                <? foreach ($taken as $taak) {?>
                    <tr>
                        <td><?=$taak['naam']?></td>
                        <td class="center"><?=$taak['code']?></td>
                        <td><?=$taak['beschrijving']?></td>
                        <td><?=$taak['klokuren']?></td>
                        <? foreach ($stdocenten as $stdocent) {
                            $ut = $task->getUserTaak($taak['tk_id'],$stdocent['wn_id']);?>
                            <td class="verdeling">
                                <input class="ureninput"
                                       type="number"
                                       data-taak="<?=$taak['tk_id']?>"
                                       data-leraar="<?=$stdocent['wn_id']?>"
                                       value="<? if (!empty($ut)) { foreach($ut as $u) { print($u['tu_taken']); } }?>"
                                    >
                            </td>
                        <? } ?>
                    </tr>
                <? } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <? foreach ($stdocenten as $stdocent) { ?>
                            <td class="verdeling"><button type="button" data-leraar="<?=$stdocent['wn_id']?>">Save</button></th>
                        <? } ?>
                    </tr>

                </tfoot>
			</table>
		</div>
	</div>
</div>


<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>