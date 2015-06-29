<?
define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"toevoegen");
define("PAGINA_CATEGORIE"	, 	"gebruiker");

$document = new document();
$document->open_html();
$document->open_head();
$document->load_metatags('Toevoegen','Description','keywords,keywords');
$document->load_plugins();
$document->load_stylesheets();
$document->close_head();
$document->open_body();

if($_SESSION['userlevel']!=4){ die('Geen bevoegdheden'); }




include(ROOT_WEBSITE."includes/header.php");
if (isset($_POST['aanhef'])){
	$werknemer = new werknemer();
	$maakGebruiker = $werknemer->maakGebruiker($_POST);
	if (!$maakGebruiker){
		$document->failed('Gebruiker','toegevoegd');
	}
	else {
		$document->success('Gebruiker', 'toegevoegd');
	}
}
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include(ROOT_WEBSITE."includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Medewerker toevoegen</h1>
			<hr>
			<form role="form" method="post" action="">
			  <div class="form-group">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-2" style="padding-right:5px;">
			    		<select class="form-control" name="aanhef" required>
			    			<option value="Dhr.">Dhr.</option>
			    			<option value="Mvr.">Mvr.</option>
			    		</select>
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
			    		<input type="text" class="form-control" name="voorletters" id="voorletters" placeholder="Voorletters" required>
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam" required>
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel">
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px;">
					    <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam" required>
			    	</div>
			    </div>
			  </div>
			  <div class="form-group">
			  	<label for="adresgegevens">Adresgegevens</label>
			  	<div class="row">
			  		<div class="col-md-6">
			  			<div class="row">
					  		<div class="col-md-9" style="padding-right:5px;">
					    		<input type="text" class="form-control" name="straat" id="straat" placeholder="Straatnaam" required>
					  		</div>
					  		<div class="col-md-3" style="padding-left:5px;">
					    		<input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnr." required>
					  		</div>
			  			</div>
			  		</div>
			  		<div class="col-md-6">
				  		<div class="row">
						  	<div class="col-md-8" style="padding-right:5px;">
							  	<input type="text" class="form-control" name="woonplaats" id="woonplaats" placeholder="Woonplaats" required>
						  	</div>
					  		<div class="col-md-4" style="padding-left:5px;">
							  	<input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" required>
					  		</div>
				  		</div>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<label for="werkgerelateerd">Werkgerelateerde informatie</label>
			  	<div class="row">
			  		<div class="col-md-4">
					    <select class="form-control" name="functie" required>
					    	<option>- Selecteer je functie</option>
					    	<option value="Docent" <? if ($row['functie']=="Docent"){ ?>selected<? } ?>>Docent</option>
					    	<option value="Teamleider" <? if ($row['functie']=="Teamleider"){ ?>selected<? } ?>>Teamleider</option>
					    	<option value="Opleidingverantwoordelijke" <? if ($row['functie']=="Opleidingverantwoordelijke"){ ?>selected<? } ?>>Opleidingverantwoordelijke</option>
					    </select>
			  		</div>
			  		<div class="col-md-2">
			  			<input type="text" id="werktijdfactor" class="form-control" name="werktijdfactor" placeholder="LTE" required>
			  		</div>
			  		<div class="col-md-3">
			  			<input type="text" id="datepicker" class="form-control" name="indienstneming" placeholder="Datum indienstneming">
			  		</div>
			  		<div class="col-md-3">
			  			<input type="text" id="emailadres" class="form-control" name="emailadres" placeholder="E-mailadres" required>
			  		</div>

			  	</div>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" name="wachtwoord" id="exampleInputPassword1" placeholder="Password" required>
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