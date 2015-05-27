<?

define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"gebruiker");

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
	$werknemer = new werknemer();
	if (isset($_GET["var2"])) {
		if ($_GET['var2']=="togglestatus") {
			$toggleActive = $werknemer->toggleActive($_GET['var3']);
			if ($toggleActive=="actief"){
				print '<div class="alert alert-info" role="alert">Gebruiker is actief gemaakt.</div>'; 
			}
			if ($toggleActive=="inactief"){
				print '<div class="alert alert-info" role="alert">Gebruiker is inactief gemaakt.</div>'; 
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
			<h1 style="margin-top:0px;">Medewerker overzicht</h1>
			<? 
			if (isset($_GET["var2"])) {

			if ($_GET['var2']=="updatestatus"){ ?> 
				<div id="confirm">
					<h4 style="text-align:center;">Weet je zeker dat je de status van deze gebruiker wilt wijzigen?</h4>
					<div style="width:200px; margin:0 auto; text-align:center;">
						<a style="padding:5px;" href="<?=HTTP?>gebruikersoverzicht/togglestatus/<?=$_GET['var3']?>">Ja</a> <a style="padding:5px;" href="<?=HTTP?>gebruikersoverzicht">Nee</a>
					</div>
				</div>
			<? }
			} ?>
			
			<hr>
			<table class="table table-hover">
				<thead>
					<tr class="row">
						<th class="col-md-6 col-xs-8">Naam docent</th>
						<th class="col-md-3 col-xs-2">Functie</th>
						<th class="col-md-2 indienstneming">Indienstneming</th>
						<th class="col-md-2 col-xs-2">Actief</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<? 	

				$result = $werknemer->alleGebruikers();
				foreach ($result as $row) {
				?>
					<tr class="row">
						<td class="col-md-5 col-xs-8"><?=$row['voornaam']?> <?=$row['tussenvoegsel']?> <?=$row['achternaam']?></td>
						<td class="col-md-3 col-xs-2"><?=$row['functie']?></td>
						<td class="col-md-2 indienstneming"><?=$document->convertFromSQLDate($row['indienstneming'])?></td>
						<td class="col-md-2 col-xs-2"><a href="<?=HTTP?>gebruikersoverzicht/updatestatus/<?=$row['id']?>">
							<? if ($row['actief']== "1"){
								print '<div style="width:20px; height:20px; background:#9FD495; border: 1px solid black;">&nbsp;</div>';
								}
								else {
								print '<div style="width:20px; height:20px; background:red; border: 1px solid black;">&nbsp;</div>';
								}
								
							?></a></td>
						<td class="col-md-1 col-xs-2"><a href="gebruikerswijzigen/<?=$row['id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
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