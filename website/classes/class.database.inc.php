<?php
class DBResult {
 
  private $_results = array();
 
  public function __construct(){}
 
  public function __set($var,$val){
    $this->_results[$var] = $val;
  }
 
  public function __get($var){ 
    if (isset($this->_results[$var])){
      return $this->_results[$var];
    }
    else{
      return null;
    }
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