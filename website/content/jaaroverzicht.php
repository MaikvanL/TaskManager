<?

define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"taak");

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

#confirm { border-radius:5px; border:red 1px solid; padding:10px; }
#confirm h4 { margin-top:0; }
#confirm a { padding:5px; border-radius:5px; background:#B0EC98; }
#confirm a:hover { background: red; }
</style>

<?
	$school = new School();
	if (isset($_GET["var2"])) {
		if ($_GET['var2']=="togglestatus") {
			$toggleActive = $school->toggleActive($_GET['var3']);
			if ($toggleActive=="actief"){
				print '<div class="alert alert-info" role="alert">Schooljaar is actief gemaakt.</div>';
			}
			if ($toggleActive=="inactief"){
				print '<div class="alert alert-info" role="alert">Schooljaar is inactief gemaakt.</div>';
			}
			
		}
	}
?>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Schooljaar overzicht</h1>
			<? 
			if (isset($_GET["var2"])) {

			if ($_GET['var2']=="updatestatus"){ ?> 
				<div id="confirm">
					<h4 style="text-align:center;">Weet je zeker dat je de status van dit schooljaar wilt wijzigen?</h4>
					<div style="width:200px; margin:0 auto; text-align:center;">
						<a style="padding:5px;" href="<?=HTTP?>jaaroverzicht/togglestatus/<?=$_GET['var3']?>">Ja</a> <a style="padding:5px;" href="<?=HTTP?>jaaroverzicht">Nee</a>
					</div>
				</div>
			<? }
			} ?>
			
			<hr>
			<table class="table table-hover">
				<thead>
					<tr class="row">
						<th class="col-md-3">Schooljaar</th>
                        <th class="col-md-2 center">Start</th>
                        <th class="col-md-2 center">Eind</th>
                        <th class="col-md-1 center">Urennorm</th>
                        <th class="col-md-1 center">Werkdagen</th>
                        <th class="col-md-1 center">Werkweken</th>
						<th class="col-md-1 center">Actief</th>
						<th class="col-md-1">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<? 	

				$result = $school->allYears();
				foreach ($result as $row) {

				?>
					<tr class="row">
                        <td class="col-md-3"><?=$row['naam']?></td>
						<td class="col-md-2 center"><?=$document->convertFromSQLDate($row['start'])?></td>
						<td class="col-md-2 center"><?=$document->convertFromSQLDate($row['end'])?></td>
                        <td class="col-md-1 center"><?=$row['urennorm']?></td>
                        <td class="col-md-1 center"><?=$row['schooldagen']?></td>
                        <td class="col-md-1 center"><?=$row['werkweken']?></td>
                        <td class="col-md-1 center"><a href="<?=HTTP?>jaaroverzicht/updatestatus/<?=$row['schooljaar_id']?>">
                                <? if ($row['actief']== "1"){
                                    print '<div style="width:20px; height:20px; background:#9FD495; border: 1px solid black; margin:0 auto;">&nbsp;</div>';
                                }
                                else {
                                    print '<div style="width:20px; height:20px; background:red; border: 1px solid black; margin: 0 auto;">&nbsp;</div>';
                                }

                                ?></a></td>
						<td class="col-md-2"><a href="jaarwijzigen/<?=$row['schooljaar_id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
				<? } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>