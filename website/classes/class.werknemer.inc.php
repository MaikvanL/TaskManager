<?php

class Werknemer extends Database {	

	
	function __construct(){}//leeg

	//krijgt van de formulier de post data in $data
	public function maakGebruiker($data){
		//zet $data om in vars.
		//$id = auto increment
		$aanhef=mysql_real_escape_string($data['aanhef']);
		$voorletters=mysql_real_escape_string($data['voorletters']);
		$voornaam=mysql_real_escape_string($data['voornaam']);
		$tussenvoegsel=mysql_real_escape_string($data['tussenvoegsel']);
		$achternaam=mysql_real_escape_string($data['achternaam']);
		$straat=mysql_real_escape_string($data['straat']);
		$huisnummer=mysql_real_escape_string($data['huisnummer']);
		$woonplaats=mysql_real_escape_string($data['woonplaats']);
		$postcode=mysql_real_escape_string($data['postcode']);
		$email=mysql_real_escape_string($data['emailadres']);
		$indienst=mysql_real_escape_string($data['indienstneming']);
		$wtf=mysql_real_escape_string($data['werktijdfactor']);
		$functie=mysql_real_escape_string($data['functie']);
		$wachtwoord=mysql_real_escape_string($data['wachtwoord']);
		


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
		$aanhef			=	mysql_real_escape_string($data['aanhef']);
		$voorletters	=	mysql_real_escape_string($data['voorletters']);
		$voornaam		=	mysql_real_escape_string($data['voornaam']);
		$tussenvoegsel	=	mysql_real_escape_string($data['tussenvoegsel']);
		$achternaam		=	mysql_real_escape_string($data['achternaam']);
		$straat			=	mysql_real_escape_string($data['straat']);
		$huisnummer		=	mysql_real_escape_string($data['huisnummer']);
		$woonplaats		=	mysql_real_escape_string($data['woonplaats']);
		$postcode		=	mysql_real_escape_string($data['postcode']);
		$email			=	mysql_real_escape_string($data['emailadres']);
		$indienst		=	mysql_real_escape_string($data['indienstneming']);
		$wtf			=	mysql_real_escape_string($data['werktijdfactor']);
		$functie		=	mysql_real_escape_string($data['functie']);
		$id				=	mysql_real_escape_string($data['id']);

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