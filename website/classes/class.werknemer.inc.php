<?php

class Werknemer extends Database {	

	
	function __construct(){}//leeg

	//krijgt van de formulier de post data in $data
	public function maakGebruiker($data){
		//zet $data om in vars.
		//$id = auto increment
		$aanhef1=mysql_real_escape_string($data['aanhef']);
		$voorletters1=mysql_real_escape_string($data['voorletters']);
		$voornaam1=mysql_real_escape_string($data['voornaam']);
		$tussenvoegsel1=mysql_real_escape_string($data['tussenvoegsel']);
		$achternaam1=mysql_real_escape_string($data['achternaam']);
		$straat1=mysql_real_escape_string($data['straat']);
		$huisnummer1=mysql_real_escape_string($data['huisnummer']);
		$woonplaats1=mysql_real_escape_string($data['woonplaats']);
		$postcode1=mysql_real_escape_string($data['postcode']); 
		$email1=mysql_real_escape_string($data['emailadres']);
		$indienst1=mysql_real_escape_string($data['indienstneming']);
		$wtf1=mysql_real_escape_string($data['werktijdfactor']);
		$functie1=mysql_real_escape_string($data['functie']);
		$wachtwoord1=mysql_real_escape_string($data['wachtwoord']);
		
		
		$aanhef=htmlspecialchars($aanhef1);
		$voorletters=htmlspecialchars($voorletters1);
		$voornaam=htmlspecialchars($voornaam1);
		$tussenvoegsel=htmlspecialchars($tussenvoegsel1);
		$achternaam=htmlspecialchars($achternaam1);
		$straat=htmlspecialchars($straat1);
		$huisnummer=htmlspecialchars($huisnummer1);
		$woonplaats=htmlspecialchars($woonplaats1);
		$postcode=htmlspecialchars($postcode1);
		$email=htmlspecialchars($email1);
		$indienst=htmlspecialchars($indienst1);
		$wtf=htmlspecialchars($wtf1);
		$functie=htmlspecialchars($functie1);
		$wachtwoord=htmlspecialchars($wachtwoord1);

        $document = new document();
        $convertedDate = $document->convertToSQLdate($indienst);


        //SQL om het toe tevoegen
		$sql="INSERT INTO `werknemer` (
		`id`, 
		`aanhef`,
		`voorletters`,
		`voornaam`,
		`tussenvoegsel`,
		`achternaam`,
		`straat`,
		`huisnummer`,
		`woonplaats`,
		`postcode`,
		`email`,
		`indienstneming`,
		`wtf`,
		`functie`,
		`wachtwoord`) 
		VALUES(
			'',
			'$aanhef',
			'$voorletters',
			'$voornaam',
			'$tussenvoegsel',
			'$achternaam',
			'$straat',
			'$huisnummer',
			'$woonplaats',
			'$postcode',
			'$email',
			'$convertedDate',
			'$wtf',
			'$functie',
			'$wachtwoord')";
		
		$execute = $this->query($sql);
		if ($execute) { return true; }
		else { return false; }

	}

	public function wijzigGebruiker($data){
		$aanhef			=	$data['aanhef'];
		$voorletters	=	$data['voorletters'];
		$voornaam		=	$data['voornaam'];
		$tussenvoegsel	=	$data['tussenvoegsel'];
		$achternaam		=	$data['achternaam'];
		$straat			=	$data['straat'];
		$huisnummer		=	$data['huisnummer'];
		$woonplaats		=	$data['woonplaats'];
		$postcode		=	$data['postcode']; 
		$email			=	$data['emailadres'];
		$indienst		=	$data['indienstneming'];
		$wtf			=	$data['werktijdfactor'];
		$functie		=	$data['functie'];
		$id				=	$data['id'];

        $document = new document();
        $convertedDate = $document->convertToSQLdate($indienst);

		$sql=("UPDATE `mvlc_taskmgr`.`werknemer` SET
		`id`			= 	'$id',
		`aanhef`		= 	'$aanhef',
		`voorletters`	=	'$voorletters',
		`voornaam`		=	'$voornaam',
		`tussenvoegsel`	=	'$tussenvoegsel',
		`achternaam`	=	'$achternaam',
		`straat`		=	'$straat',
		`huisnummer`	=	'$huisnummer',
		`woonplaats`	=	'$woonplaats',
		`postcode`		=	'$postcode',
		`email`			=	'$email',
		`indienstneming`=	'$convertedDate',
		`wtf`			=	'$wtf',
		`functie`		=	'$functie'
		 WHERE id=$id;");
		
		$execute = $this->query($sql);
		if ($execute) { return true; }
		else { return false; }

		
	}

	public function toggleActive($werknemerId){
		$sql="SELECT `actief` FROM `werknemer` WHERE id='$werknemerId'";	
		$result=$this->query($sql);
		foreach ($result as $result);
		$result=$result->actief;

		
		if ($result==1) {
			$sql="UPDATE `werknemer` SET `actief`= 0 WHERE `id` =$werknemerId";
			$this->query($sql);
			$melding="inactief";
		}

		if ($result==0) {
			$sql="UPDATE `werknemer` SET `actief`= 1 WHERE `id` =$werknemerId";
			$this->query($sql);
			$melding="actief";

		}

		return $melding;
	}

	public function alleGebruikers(){
		$sql = "SELECT * FROM `werknemer`";

		return $this->query($sql);
	}

	public function getGebruiker($werknemerId){
		$sql = "SELECT * FROM `werknemer` WHERE `id` = $werknemerId";

		return $this->query($sql);
	}




}// einde class





?>