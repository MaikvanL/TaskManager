<?
define("PAGINA_TITEL"		,	"Overzicht");
define("PAGINA_NAAM"		,	"overzicht");
define("PAGINA_CATEGORIE"	, 	"gebruiker");
include("includes/start.php");
include("includes/header.php");


?>
<style>
@media (max-width: 767px) { 
.indienstneming { display:none !important; } 

}
</style>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include("includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Medewerker overzicht</h1>
			<hr>
			<table class="table table-hover">
				<thead>
					<tr class="row">
						<th class="col-md-6 col-xs-8">Naam docent</th>
						<th class="col-md-3 col-xs-2">Subteam</th>
						<th class="col-md-2 indienstneming">Indienstneming</th>
						<th class="col-md-1 col-xs-2">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr class="row">
						<td class="col-md-6 col-xs-8">Bram van Huele</td>
						<td class="col-md-3 col-xs-2">Applicatieontwikkelaar</td>
						<td class="col-md-2 indienstneming">04-02-1980</td>
						<td class="col-md-1 col-xs-2"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
					<tr class="row">
						<td class="col-md-6 col-xs-8">Rens Brandon</td>
						<td class="col-md-3 col-xs-2">Applicatieontwikkelaar</td>
						<td class="col-md-2 indienstneming">07-07-2014</td>
						<td class="col-md-1 col-xs-2"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
					<tr class="row">
						<td class="col-md-6 col-xs-8">Cees Schipper</td>
						<td class="col-md-3 col-xs-2">Applicatieontwikkelaar</td>
						<td class="col-md-2 indienstneming">02-03-2010</td>
						<td class="col-md-1 col-xs-2"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(function(){ $("#datepicker").datepicker();  });
</script>
<?
include("includes/footer.php");
?>