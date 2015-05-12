<?php

/**
* Class voor Team.
*/
class Subteam extends Database {

	private $id;
	private $subteamnaam;
	private $idteamleider;
	private $idolv;  
	private $iddocent;
//FUNCTIE OM SUBTEAM TE MAKEN
	public function maakSubteam($data){

		$subteamnaam1=mysql_real_escape_string($data['subteamnaam']);
		$idopleidingsverantwoordelijke1=mysqlcd_real_escape_string($data['opleidingsverantwoordelijke']);
		$idteam1=mysql_real_escape_string($data['idteam']);
	
		$subteam=htmlspecialchars($subteamnaam1);
		$idopleidingsverantwoordelijke=htmlspecialchars($idopleidingsverantwoordelijke1);
		$idteam=htmlspecialchars($idteam1);
		
		$query="INSERT INTO `subteam`(
			`subteamnaam`,
			`idteam`,
			`idopleidingsverantwoordelijke`,
			`actief`)
      Values(
			`$subteam`,
			`$idteam`,
			`$idopleidingsverantwoordelijke`,
			`1`)";


			
		$this->query($query); 
	}
//FUNCTIE OM SUBTEAM TE WIJZIGEN
	public function wijzigSubteam($data){

		$id=$data['id'];	
		$subteamnaam1=mysql_real_escape_string($data['subteamnaam']);
		$idopleidingsverantwoordelijke1=mysql_real_escape_string($data['idteamleider']);
		$idteam1=mysql_real_escape_string($data['idteam']);

		$subteam=htmlspecialchars($subteamnaam1);
		$idopleidingsverantwoordelijke=htmlspecialchars($idopleidingsverantwoordelijke1);
		$idteam=htmlspecialchars($idteam1);
		
		$query = ("UPDATE `subteam` SET 
		`subteamnaam`	 				='$subteamnaam',
		`idteamleider`   				='$idteamleider',
		`idopleidingsverantwoordelijke` ='$idolv',
		WHERE`id`=$id;");

		$this->query($query);

	}
//SUBTEAM ARCHIVERNE NIET VERWIJDEREN!
	public function archiveerSubteam($id){
		$sql="SELECT `actief` FROM `subteam` WHERE `id`=$id";	
		$result=$this->query($sql);
		foreach($result as $result)
		$result=$result->actief;

		//ACTIEF TOGGLE (JA=NEE / NEE=JA)
		if ($result==1) {
			$sql="UPDATE `subteam` SET `actief`= 0 WHERE `id` =$id";
			$this->query($sql);
			$melding="Ik ben naar niet actief gezet";
		}

		if ($result==0) {
			$sql="UPDATE `subteam` SET `actief`= 1 WHERE `id` =$id";
			$this->query($sql);
			$melding="Ik ben actief gezet";

		}

		return $melding;
	}

	public function overzicht(){
		$sql ="SELECT * from `subteam` ";
		return $this -> query($sql);
	}



	public function alleOLV(){
		$sql ="SELECT * from `olv`";
			return $this->query($sql);
	}
			
	public function alleTeams(){
	$sql = "SELECT * from `team`";
			return $this->query($sql);

	}

	public function voegDocent ($werknemerid, $subteamid){
		 $sql="SELECT * FROM `subteamdocenten` WHERE `werknemerid`= $werknemerid AND `subteamid`= $subteamid";
		$result=$this->query($sql);
		
		$result=count($result);
		

		if($result==0){
		$sql = "INSERT INTO `subteamdocenten`(`subteamid`, `werknemerid`) VALUES ($subteamid, $werknemerid)";
		$this->query($sql);
		
		return "Docent is opgeslagen";
		}

		if ($result>=1) {
		return "Docent bestaat al";
		}
	}

	public function verplaatsDocent($werknemerid, $oldsubteamid, $newsubteamid){
		$sql="SELECT * FROM `subteamdocenten` WHERE `werknemerid`= $werknemerid AND `subteamid`= $newsubteamid";
		$this->query($sql);
		$result=count($result);
		

		if($result==0){
		$this->verwijderDocent($werknemerid,$oldsubteamid);
		$sql = "INSERT INTO `subteamdocenten`(`subteamid`, `werknemerid`) VALUES ($newsubteamid, $werknemerid)";
		$this->query($sql);
		
		return "Docent is opgeslagen";
		}

		if ($result>=1) {
		return "Docent bestaat al";
		}


	}


    public function getWerknemers($subteamid){
        $sql="SELECT werknemer.*, subteamdocenten.* FROM werknemer INNER JOIN subteamdocenten WHERE subteamdocenten.subteamid = $subteamid AND subteamdocenten.werknemerid = werknemer.id";
        $subteamdocenten = $this->query($sql);
        return $subteamdocenten;
    }
	public function verwijderDocent($werknemerid, $subteamid){
		$sql="DELETE * FROM `subteamdocenten` WHERE `werknemerid`= $werknemerid AND `subteamid`= $subteamid";
		$this->query($sql);

		return "Docent verwijderd";
	}

	public function getSubTeamByLeader($userId){
		$sql = "SELECT * FROM `team` WHERE `idteamleider` = $userId";
		$team=$this->query($sql);
		foreach ($team as $row) {
		$subteams= $this->getSubteams($row->id);
		}
		return $subteams;
	}
		
    public function getSubteam($subteamid){
        $sql = "SELECT * FROM `subteam` WHERE `id` = $subteamid";

        return $this->query($sql);
    }

    public function addWerknemer($werknemerid, $subteamid){
        $sql = "INSERT INTO `subteamdocenten`(`subteamid`, `werknemerid`) VALUES ($subteamid,$werknemerid)";

        $this->query($sql);
    }

    public function checkNotInSubteam($allUsers, $leden){

        $notInSubteam = $allUsers->id - $leden->werknemerid;

        $diff = array_udiff($allUsers, $leden, $notInSubteam);

        return $diff;
    }
	// public function getSubteamMembers($memberid){
	// 	$sql = "SELECT * FROM 'werknemer' WHERE 'idteam' = $memberid";
	// 	$subteamMember=$this->query($sql);
	// 	return $subteamMember;
	// }

}

?>