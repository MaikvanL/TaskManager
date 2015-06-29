<?php

/**
 * Class voor Team.
 * Revision 2
 * Author: Maik van Lieshout
*/
class Subteam {

	private $id;
	private $subteamnaam;
	private $idteamleider;
	private $idolv;  
	private $iddocent;

	public function maakSubteam($data){
        $db = new Database();


		$subteam    = $db->escapeString($data['naam']);
		$idolv      = $db->escapeString($data['olv']);
		$idteam     = $db->escapeString($data['team']);

        $tabelinfo  = ['subteamnaam'=>$subteam,'t_id'=>$idteam,'olv_id'=>$idolv,'actief'=>1];
        $db->connect();
        $db->insert('subteam',$tabelinfo);

    }

	public function wijzigSubteam($data){
        $db = new Database();

        $id     = $db->escapeString($data['st_id']);
        $naam   = $db->escapeString($data['naam']);
        $idolv  = $db->escapeString($data['olv']);
        $idteam = $db->escapeString($data['idteam']);

        $db->connect();
        $db->update('subteam',['subteamnaam'=>$naam,'tl_id'=>$idolv,'t_id'=>$idteam],'st_id = '.$id);

	}

/*
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
*/

	public function overzicht(){
        $db = new Database();
        $db->connect();
        $db->select('subteam');
        $result = $db->getResult();
        return $result;
	}

	public function alleTeams(){
        $db = new Database();
        $db->connect();
        $db->select('team');
        $result = $db->getResult();
        return $result;

    }

    /*	public function voegDocent ($werknemerid, $subteamid){
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
        }*/


    public function getWerknemers($subteamid){
        $db = new Database();
        $db->connect();
        $db->usersInTeam($subteamid);
        $result = $db->getResult();
        return $result;
    }
	public function verwijderDocent($werknemerid, $subteamid){
        $db = new Database();
        $db->connect();
        $db->delete('subteamdocenten', '`wn_id`= '.$werknemerid.' AND `st_id` = '.$subteamid);

		return "Docent verwijderd";
	}

/*
 	public function getSubTeamByLeader($userId){
		$sql = "SELECT * FROM `team` WHERE `idteamleider` = $userId";
		$team=$this->query($sql);
		foreach ($team as $row) {
		$subteams= $this->getSubteams($row->id);
		}
		return $subteams;
	}
*/
		
    public function getSubteam($subteamid){
        $db = new Database();
        $db->connect();
        $db->select('subteam','*',null,'st_id = '.$subteamid);
        $result = $db->getResult();
        return $result;
    }

    public function addWerknemer($werknemerid, $subteamid){

        $db = new Database();
        $db->connect();
        $db->insert('subteamdocenten',['st_id'=>$subteamid,'wn_id'=>$werknemerid]);


    }

    public function checkNotInSubteam($allUsers, $leden){

        $notInSubteam = ($allUsers - $leden['wn_id']);

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