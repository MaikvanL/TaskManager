<?php

/*
 * Werknemer Class
 * Revision: Maik van Lieshout
 */

class Werknemer {

	

	public function maakGebruiker($data){
   		$db = new Database();
        
        $aanhef         = $db->escapeString($data['aanhef']);
		$voorletters    = $db->escapeString($data['voorletters']);
		$voornaam       = $db->escapeString($data['voornaam']);
		$tussenvoegsel  = $db->escapeString($data['tussenvoegsel']);
		$achternaam     = $db->escapeString($data['achternaam']);
		$straat         = $db->escapeString($data['straat']);
		$huisnummer     = $db->escapeString($data['huisnummer']);
		$woonplaats     = $db->escapeString($data['woonplaats']);
		$postcode       = $db->escapeString($data['postcode']);
		$email          = $db->escapeString($data['emailadres']);
		$indienst       = $db->escapeString($data['indienstneming']);
		$wtf            = $db->escapeString($data['werktijdfactor']);
		$functie        = $db->escapeString($data['functie']);
		$wachtwoord     = $db->escapeString($data['wachtwoord']);
		


        $document = new document();
        $convertedDate = $document->convertToSQLdate($indienst);

        $tableinfo = ['id'=>'','aanhef'=>$aanhef,'voorletters'=>$voorletters,'voornaam'=>$voornaam,'tussenvoegsel'=>$tussenvoegsel,'achternaam'=>$achternaam,'straat'=>$straat,'huisnummer'=>$huisnummer,'woonplaats'=>$woonplaats,'postcode'=>$postcode,'email'=>$email,'indienstneming'=>$convertedDate,'wtf'=>$wtf,'functie'=>$functie,'wachtwoord'=>$wachtwoord];

		$execute = $db->insert('werknemer',$tableinfo);
		if ($execute) { return true; }
		else { return false; }

	}

	public function wijzigGebruiker($data){

        $db = new Database();

		$aanhef			=	$db->escapeString($data['aanhef']);
		$voorletters	=	$db->escapeString($data['voorletters']);
		$voornaam		=	$db->escapeString($data['voornaam']);
		$tussenvoegsel	=	$db->escapeString($data['tussenvoegsel']);
		$achternaam		=	$db->escapeString($data['achternaam']);
		$straat			=	$db->escapeString($data['straat']);
		$huisnummer		=	$db->escapeString($data['huisnummer']);
		$woonplaats		=	$db->escapeString($data['woonplaats']);
		$postcode		=	$db->escapeString($data['postcode']);
		$email			=	$db->escapeString($data['emailadres']);
		$indienst		=	$db->escapeString($data['indienstneming']);
		$wtf			=	$db->escapeString($data['werktijdfactor']);
		$functie		=	$db->escapeString($data['functie']);
		$id				=	$db->escapeString($data['id']);

        $document = new document();
        $convertedDate = $document->convertToSQLdate($indienst);
        $tableinfo = ['aanhef'=>$aanhef,'voorletters'=>$voorletters,'voornaam'=>$voornaam,'tussenvoegsel'=>$tussenvoegsel,'achternaam'=>$achternaam,'straat'=>$straat,'huisnummer'=>$huisnummer,'woonplaats'=>$woonplaats,'postcode'=>$postcode,'email'=>$email,'indienstneming'=>$convertedDate,'wtf'=>$wtf,'functie'=>$functie];
        $db->connect();

        $execute = $db->update('werknemer',$tableinfo,'`id`= '.$id);
		if ($execute) { return true; }
		else { return false; }

		
	}

	public function toggleActive($werknemerId){
        $db = new Database();
        $db->connect();
		$db->select('werknemer','actief',null,'`id`='.$werknemerId);
        $results = $db->getResult();

        foreach ($results as $result);
		$result = $result->actief;

		
		if ($result==1) {
			$db->update('werknemer',['actief'=>0],'`id` = '.$werknemerId);
			$melding="Inactief";
		}

		if ($result==0) {
            $db->update('werknemer',['actief'=>1],'`id` = '.$werknemerId);
			$melding="Actief";

		}

		return $melding;
	}

	public function alleGebruikers(){
        $db = new Database();
        $db->connect();
        $db->select('werknemer','*');
        $result = $db->getResult();
		return $result;
	}

	public function getGebruiker($werknemerId)
    {
        $db = new Database();
        $db->connect();
        $db->select('werknemer', '*', null, '`id` ='.$werknemerId);
        $result = $db->getResult();
        return $result;
    }

}

?>