<?php

/**
 * Class dbNew
 */

class dbNew {

    private $db_host = DB_HOSTNAME;
    private $db_user = DB_USERNAME;
    private $db_pass = DB_PASSWORD;
    private $db_name = DB_DATABASE;

    private $con = false; // Check of er al verbinding is met de database
    private $result = array(); // Result van de query
    private $myQuery = "";// Uitgevoerde query
    private $numResults = "";// Hoeveelheid v/d rijen van je result



    public function connect(){
        if(!$this->con){
            $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
            if($myconn){
                $seldb = @mysql_select_db($this->db_name,$myconn); // Database selecteren
                if($seldb){
                    $this->con = true;
                    return true;  // Verbinding gelukt -> return TRUE
                }else{
                    array_push($this->result,mysql_error());
                    return false;  // Database error -> return FALSE
                }
            }else{
                array_push($this->result,mysql_error());
                return false; // Verbinding error -> return FALSE
            }
        }else{
            return true; // Verbinding al gemaakt -> return TRUE
        }
    }

    public function disconnect(){
        // Check of er verbinding is
        if($this->con){
            if(@mysql_close()){
                $this->con = false; // Verbinding gesloten, con -> false
                return true; // Verbinding succesvol gesloten -> return TRUE
            }else{
                return false;     // Verbinding niet gesloten -> return false
            }
        }
    }

    public function sql($sql){
        $query = @mysql_query($sql);
        $this->myQuery = $sql; // Query definen
        if($query){
            $this->numResults = mysql_num_rows($query); // Aantal rows meegeven
            for($i = 0; $i < $this->numResults; $i++){ // Loop over het aantal rows
                $r = mysql_fetch_array($query);
                $key = array_keys($r);
                for($x = 0; $x < count($key); $x++){
                    if(!is_int($key[$x])){
                        if(mysql_num_rows($query) >= 1){
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        }else{
                            $this->result = null;
                        }
                    }
                }
            }
            return true; // Query gelukt
        }else{
            array_push($this->result,mysql_error());
            return false; // Geen resultaat
        }
    }

    public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null){
        $q = 'SELECT '.$rows.' FROM '.$table;        // Query opstellen op basis van de parameters
        if($join != null){
            $q .= ' JOIN '.$join;
        }
        if($where != null){
            $q .= ' WHERE '.$where;
        }
        if($order != null){
            $q .= ' ORDER BY '.$order;
        }
        if($limit != null){
            $q .= ' LIMIT '.$limit;
        }
        $this->myQuery = $q; // Query definen
        if($this->tableExists($table)){ // Check of table bestaat
            $query = @mysql_query($q);
            if($query){
                $this->numResults = mysql_num_rows($query);
                for($i = 0; $i < $this->numResults; $i++){
                    $r = mysql_fetch_array($query);
                    $key = array_keys($r);
                    for($x = 0; $x < count($key); $x++){
                        if(!is_int($key[$x])){
                            if(mysql_num_rows($query) >= 1){
                                $this->result[$i][$key[$x]] = $r[$key[$x]];
                            }else{
                                $this->result = null;
                            }
                        }
                    }
                }
                return true;
            }else{
                array_push($this->result,mysql_error());
                return false; // Geen rows gereturnd
            }
        }else{
            return false; // Table bestaat niet
        }
    }

    public function insert($table,$params=array()){
        if($this->tableExists($table)){
            $sql='INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES ("' . implode('", "', $params) . '")';
            $this->myQuery = $sql;
            if($ins = @mysql_query($sql)){
                array_push($this->result,mysql_insert_id());
                return true; // Insert geslaagd
            }else{
                array_push($this->result,mysql_error());
                return false; // Insert mislukt
            }
        }else{
            return false; // Table bestaat niet
        }
    }

    public function delete($table,$where = null){
        if($this->tableExists($table)){
            if($where == null){  // Check of er een table of rows verwijderd moeten worden
                $delete = 'DELETE '.$table; // Table verwijderen
            }else{
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; // Rows verwijderen
            }
            // Submit query to database
            if($del = @mysql_query($delete)){
                array_push($this->result,mysql_affected_rows());
                $this->myQuery = $delete;
                return true; // Delete gelukt
            }else{
                array_push($this->result,mysql_error());
                return false; // Delete mislukt
            }
        }else{
            return false; // Table bestaat niet
        }
    }

    public function update($table,$params=array(),$where){
        if($this->tableExists($table)){
            $args=array(); // Array maken om de rows te storen die geupdate moeten worden
            foreach($params as $field=>$value){
                $args[]=$field.'="'.$value.'"'; // Kolommen + bijbehorende values
            }
            $sql='UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where;
            $this->myQuery = $sql; //
            if($query = @mysql_query($sql)){
                array_push($this->result,mysql_affected_rows());
                return true; // Update gelukt
            }else{
                array_push($this->result,mysql_error());
                return false; // Update mislukt
            }
        }else{
            return false; // Tabel bestaat niet
        }
    }

    private function tableExists($table){
        $tablesInDb = @mysql_query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb){
            if(mysql_num_rows($tablesInDb)==1){
                return true; // Table bestaat
            }else{
                array_push($this->result,$table." does not exist in this database");
                return false; // Table bestaat niet
            }
        }
    }

    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }
    public function getSql(){
        $val = $this->myQuery;
        $this->myQuery = array();
        return $val;
    }
    public function numRows(){
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    public function escapeString($data){
        return mysql_real_escape_string($data);
    }
}



class Database {

     
  public function __construct(){}
//CONNECTIEGEGEVENS MET DATABASE
   protected function dbconnect() {
      $user = "mvlc_taskmgr";
      $pass = "Stipjes123";
      $host = "localhost"; 
//VERBINDING MAKEN MET DATABASE
    $conn = mysql_connect($host, $user, $pass)
      or die ("<br/>Kon geen verbindingen maken met de database, Probeer het opnieuw");
       
  }
//QUERY WAT ALLES DATA VERKEER MOET REGELEN
  public function query($sql){
 
    $this->dbconnect();
 //RESULTS VAN DATABASE
    $resulten = mysql_query($sql);
 
    if ($resulten){
      if (strrpos($sql, 'SELECT', -strlen($sql)) === false) {
        return true;
      }
    }
    else{
     if (strrpos($sql, 'SELECT', -strlen($sql)) === false) {
        return false;
      }
      else{
        return null;
      }
    }
 //ARRAY MAKEN 
    $results = array();
 //RESULT IN ARRAY ZETTEN
    while ($row = mysql_fetch_array($resulten)){
 
      $result = new dbresult();
 
      foreach ($row as $k=>$v){
        $result->$k = $v;
      }
  //RESULTAAT IN ARRAY ZETTEN
      $results[]= $result;
    }
  //RETURNEN
    return $results;     
  }
   
}