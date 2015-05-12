<?
define("PAGINA_TITEL"		,	"Toevoegen");
define("PAGINA_NAAM"		,	"toevoegen");
define("PAGINA_CATEGORIE"	, 	"gebruiker");
include("includes/start.php");
include("includes/header.php");


?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<? include("includes/sidenav.php"); ?>
	</div>
	<div class="col-md-9 col-xs-12">
		<div class="content">
			<h1 style="margin-top:0px;">Medewerker toevoegen</h1>
			<hr>
			<form role="form">
			  <div class="form-group">
			    <label for="functie">Functie</label>
			    <select class="form-control" name="functie">
			    	<option>- Selecteer je functie</option>
			    	<option value="docent">Docent</option>
			    	<option value="teamleider">Teamleider</option>
			    	<option value="nietactief">Niet actief</option>
			    	<option value="opleidingverantwoordelijke">Opleidingverantwoordelijke</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="naam">Naam</label>
			    <div class="row">
			    	<div class="col-md-2" style="padding-right:5px;">
			    		<select class="form-control" name="aanhef">
			    			<option value="Dhr.">Dhr.</option>
			    			<option value="Mvr.">Mvr.</option>
			    		</select>
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
			    		<input type="text" class="form-control" name="voorletters" id="voorletters" placeholder="Voorletters">
			    	</div>
			    	<div class="col-md-2" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam">
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px; padding-right:5px;">
					    <input type="text" class="form-control" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel">
			    	</div>
			    	<div class="col-md-3" style="padding-left:5px;">
					    <input type="text" class="form-control" name="achternaam" id="achternaam" placeholder="Achternaam">
			    	</div>
			    </div>
			  </div>
			  <div class="form-group">
			  	<label for="adresgegevens">Adresgegevens</label>
			  	<div class="row">
			  		<div class="col-md-6">
			  			<div class="row">
					  		<div class="col-md-9" style="padding-right:5px;">
					    		<input type="text" class="form-control" name="straat" id="straat" placeholder="Straatnaam">
					  		</div>
					  		<div class="col-md-3" style="padding-left:5px;">
					    		<input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnr.">
					  		</div>
			  			</div>
			  		</div>
			  		<div class="col-md-6">
				  		<div class="row">
						  	<div class="col-md-8" style="padding-right:5px;">
							  	<input type="text" class="form-control" name="woonplaats" id="woonplaats" placeholder="Woonplaats">
						  	</div>
					  		<div class="col-md-4" style="padding-left:5px;">
							  	<input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode">		
					  		</div>
				  		</div>
			  		</div>
			  	</div>
			  </div>
			  <div class="form-group">
			  	<label for="werkgerelateerd">Werkgerelateerde informatie</label>
			  	<div class="row">
			  		<div class="col-md-4">
					    <select class="form-control" name="functie">
					    	<option>- Selecteer je functie</option>
					    	<option value="docent">Docent</option>
					    	<option value="teamleider">Teamleider</option>
					    	<option value="opleidingverantwoordelijke">Opleidingverantwoordelijke</option>
					    </select>
			  		</div>
			  		<div class="col-md-4">
			  			<input type="text" id="datepicker" name="indienstneming">
			  		</div>
			  		<div class="col-md-4">
			  			
			  		</div>

			  	</div>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" name="wachtwoord" id="exampleInputPassword1" placeholder="Password">
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
	$(function(){ $("#datepicker").datepicker();  });
</script>
<?
include("includes/footer.php");
?>