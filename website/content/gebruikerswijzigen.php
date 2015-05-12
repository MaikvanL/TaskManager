<?
define("PAGINA_TITEL"		,	"Wijzigen");
define("PAGINA_NAAM"		,	"wijzigen");
define("PAGINA_CATEGORIE"	, 	"gebruiker");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Wijzigen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();



include(ROOT_WEBSITE."includes/header.php");
if (isset($_POST['id'])){
	$werknemer = new werknemer();
	$wijzigGebruiker = $werknemer->wijzigGebruiker($_POST);
	if (!$wijzigGebruiker){
		$document->failed('Gebruiker', 'gewijzigd');
	}
	else {
		$document->success('Gebruiker', 'gewijzigd');
	}
}
if (isset($_GET['var2'])){
	$werknemer = new werknemer();
	$gebruiker=$werknemer->getGebruiker($_GET['var2']);
}

foreach ($gebruiker as $row) {

?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Medewerker wijzigen</h1>
			<hr>
			<form role="form" method="post" action="">
			  <div class="form-group">
			  	<input type="hidden" id="id" value="<?=$row->id?>" name="id">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-2" style="padding-right:5px;">
			    		<select class="form-control" name="aanhef">
			    			<option value="Dhr." <? if ($row->aanhef=="Dhr."){ ?>selected<? } ?>>Dhr.</option>
			    			<option value="Mvr." <? if ($row->aanhef=="Mvr."){ ?>selected<? } ?>>Mvr.</option>
			    		</select>
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
			    		<input type="text" class="form-control" name="voorletters" id="voorletters" placeholder="Voorletters" value="<?=$row->voorletters?>">
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam" value="<?=$row->voornaam?>">
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel" value="<?=$row->tussenvoegsel?>">
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px;">
					    <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam" value="<?=$row->achternaam?>">
			    	</div>
			    </div>
			  </div>
			  <div class="form-group">
			  	<label for="adresgegevens">Adresgegevens</label>
			  	<div class="row">
			  		<div class="col-md-6">
			  			<div class="row">
					  		<div class="col-md-9" style="padding-right:5px;">
					    		<input type="text" class="form-control" name="straat" id="straat" placeholder="Straatnaam" value="<?=$row->straat?>">
					  		</div>
					  		<div class="col-md-3" style="padding-left:5px;">
					    		<input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnr." value="<?=$row->huisnummer?>">
					  		</div>
			  			</div>
			  		</div>
			  		<div class="col-md-6">
				  		<div class="row">
						  	<div class="col-md-8" style="padding-right:5px;">
							  	<input type="text" class="form-control" name="woonplaats" id="woonplaats" placeholder="Woonplaats" value="<?=$row->woonplaats?>">
						  	</div>
					  		<div class="col-md-4" style="padding-left:5px;">
							  	<input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" value="<?=$row->postcode?>">		
					  		</div>
				  		</div>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<label for="werkgerelateerd">Werkgerelateerde informatie</label>
			  	<div class="row">
			  		<div class="col-md-4">
					    <select class="form-control" name="functie" value="value="<?=$row->functie?>"">
					    	<option>- Selecteer je functie</option>
					    	<option value="Docent" <? if ($row->functie=="Docent"){ ?>selected<? } ?>>Docent</option>
					    	<option value="Teamleider" <? if ($row->functie=="Teamleider"){ ?>selected<? } ?>>Teamleider</option>
					    	<option value="Opleidingverantwoordelijke" <? if ($row->functie=="Opleidingverantwoordelijke"){ ?>selected<? } ?>>Opleidingverantwoordelijke</option>
					    </select>
			  		</div>
			  		<div class="col-md-2">
			  			<input type="text" id="werktijdfactor" class="form-control" name="werktijdfactor" placeholder="Werktijdfactor" value="<?=$row->wtf?>">
			  		</div>
			  		<div class="col-md-2">
			  			<input type="text" id="datepicker" class="form-control" name="indienstneming" placeholder="Datum indienstneming" value="<?=$row->indienstneming?>">
			  		</div>
			  		<div class="col-md-4">
			  			<input type="text" id="emailadres" class="form-control" name="emailadres" placeholder="E-mailadres" value="<?=$row->email?>">
			  		</div>

			  	</div>
			  </div>
			  <div class="checkbox">
			    <label>
			      <input type="checkbox"> Actief
			    </label>
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>

		</div>
	</div>
</div>
<? }?>
<script>
    $(function(){ $("#datepicker").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: 0
        }
    );  });
</script>

<?
include(ROOT_WEBSITE."includes/footer.php");
$document->close_body();
$document->close_html();
?>