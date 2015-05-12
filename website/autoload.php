<?php
 function __autoload($class_name)
  {
      include_once 'classes/class.' . strtolower($class_name) . '.inc.php';
  }

?>