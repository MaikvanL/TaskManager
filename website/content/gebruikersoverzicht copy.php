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
</style>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Medewerker overzicht</h1>
			<hr>
			<table class="table table-hover">
				<thead>
					<tr class="row">
						<th class="col-md-6 col-xs-8">Naam docent</th>
						<th class="col-md-3 col-xs-2">Functie</th>
						<th class="col-md-2 indienstneming">Indienstneming</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<? 	

				$werknemer = new werknemer();
				$result =$werknemer->alleGebruikers();
				
				foreach ($result as $row) {
				?>
					<tr class="row">
						<td class="col-md-6 col-xs-8"><?=$row->voornaam?> <?=$row->tussenvoegsel?> <?=$row->achternaam?></td>
						<td class="col-md-3 col-xs-2"><?=$row->functie?></td>
						<td class="col-md-2 indienstneming"><?=$row->indienstneming?></td>
						<td class="col-md-1 col-xs-2"><a href="gebruikerswijzigen/<?=$row->id?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
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