<?php
 interface sql
 {

  public function setQuery($query);
  
  public function getQuery();
  
  public function makeQuery($query='');
  
  public function makeResult($result=false);
  
  public function getAffectedRows();
 	
 }
?>