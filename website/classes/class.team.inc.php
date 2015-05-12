<?php

/**
* Class voor Team.
*/
class team extends database {

	function __construct(){/*leeg*/}

	public function maakTeam($data){

		$teamnaam1=mysql_real_escape_string($data['teamnaam']);
		$idteamleider1=mysql_real_escape_string($data['teamleider']);

		$teamnaam=htmlspecialchars($teamnaam1);
		$idteamleider=htmlspecialchars($idteamleider1);
				
		$query= "INSERT INTO `mvlc_taskmgr`.`team` (`id`, `teamnaam`, `idteamleider`) VALUES (NULL, '$teamnaam', '$idteamleider');";
		$execute = $this->query($query);
		if ($execute) { return true; }
		else { return false; }
		
	}

	public function wijzigTeam($data){

		$id1=mysql_real_escape_string($data['id']);
		$teamnaam1=mysql_real_escape_string($data['teamnaam']);
		$idteamleider1=mysql_real_escape_string($data['idteamleider']);

		$id=htmlspecialchars($id1);
		$teamnaam=htmlspecialchars($teamnaam1);
		$idteamleider=htmlspecialchars($idteamleider1);

		$query="UPDATE `mvlc_taskmgr`.`team` SET `teamnaam`='$teamnaam', `idteamleider`='$idteamleider' WHERE `id` = $id";

		$execute = $this->query($query);
		if ($execute) { return true; }
		else { return false; }
	}

	public function archiveerTeam($teamid){
		$sql="SELECT `actief` FROM `team` WHERE `id`='$teamid'";	
		
		$result=$this->query($sql);
		foreach($result as $result)
		$result=$result->actief;

		
		if ($result==1) {
			$sql="UPDATE `team` SET `actief`= 0 WHERE `id` =$id";
			$this->query($sql);
			$melding="Ik ben naar niet actief gezet";
		}

		if ($result==0) {
			$sql="UPDATE `team` SET `actief`= 1 WHERE `id` =$id";
			$this->query($sql);
			$melding="Ik ben actief gezet";

		}

		return $melding;
  }
		
  public function voegSubteam($teamid,$subteamid){
	    $sql="SELECT * FROM `teamsubteam` WHERE `team` = $teamid AND `subteam`=$subteamid";
	  	$result=$this->query($sql);
  	
		$result=count($result);
		
		

		if($result==0){
		$sql = "INSERT INTO `teamsubteam`(`team`, `subteam`) VALUES ($teamid, $subteamid)";
		$this->query($sql);
		
		
		return "subteam is er bij opgeslagen";
		}

		if ($result>=1) {
		return "Bestaat al";
		}
	}
	
	public function verplaatsSubteam($teamid,$newsubteamid,$oldsubteamid){
		$sql="SELECT * FROM `teamsubteam` WHERE `teamid`= $teamid AND `subteamid`= $newsubteamid";
		$this->query($sql);
		$result=count($result);
		

		if($result==0){
		$this->verwijderTeam($teamid,$oldsubteamid);
		$sql = "INSERT INTO `teamsubteam`(`subteamid`, `teamid`) VALUES ($newsubteamid, $teamid)";
		$this->query($sql);
		
		return "subteam is opgeslagen";
		}

		if ($result>=1) {
		return "subteam bestaat al";
		}
		
		
	}


	public function verwijderSubteam($teamid, $subteamid){
		$sql="DELETE * FROM `teamsubteam` WHERE `teamid`= $teamid AND `subteamid`= $subteamid";
		$this->query($sql);

		return "Docent verwijderd";
	}
	
	public function alleTeams(){
	$sql="SELECT * FROM `team`";
	$alleteams=$this->query($sql);
	
	return $alleteams;
	}

	public function getSubTeamByLeader($userId){
		$sql = "SELECT `id` FROM `team` WHERE `idteamleider` = $userId";
		$teamId=$this->query($sql);
		
		foreach ($teamId as $row) {
		$subteams= $this->getSubteams($row->id);
		}
		return $subteams;
	}

    public function getSubteams($teamid){
        $sql = "SELECT * FROM `subteam` WHERE `idteam` = $teamid";
        $subteams=$this->query($sql);
        return $subteams;
    }

	public function getTeam($teamid){
		$sql = "SELECT * FROM `team` WHERE `id` = $teamid";

		return $this->query($sql);
	}
    public function toggleActive($teamid){
        $sql="SELECT `actief` FROM `team` WHERE id='$teamid'";
        $result=$this->query($sql);
        foreach ($result as $result);
        $result=$result->actief;


        if ($result==1) {
            $sql="UPDATE `team` SET `actief`= 0 WHERE `id` =$teamid";
            $this->query($sql);
            $melding="inactief";
        }

        if ($result==0) {
            $sql="UPDATE `team` SET `actief`= 1 WHERE `id` =$teamid";
            $this->query($sql);
            $melding="actief";

        }

        return $melding;
    }
	
}// einde class

?>

