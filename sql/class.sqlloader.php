<?php

 class sqlloader
 {
  
  public static function factory($sql_mode='mysql') //FACTORY-Pattern
  {
   include_once dirname(__FILE__).'/class.'.$sql_mode.'.php';
   return new $sql_mode;
  }
 }
?>