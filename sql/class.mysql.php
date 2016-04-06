<?php

require dirname(__FILE__)."/interface.sql.php";

define('DB_SERVER', "localhost");
define('DB_USR', "USER");
define('DB_PWD', "PASSWORD");
define('DB_NAME', "homeswitch");

 class mysql implements sql
 {
 
  private $mysqli;
  private $sqlquery;
  private $sqlresult;
  private $buglog='';
  
  function __construct()
  {
   $this->mysqli=new mysqli(DB_SERVER,DB_USR,DB_PWD,DB_NAME);
   if(!$this->mysqli && mysqli_connect_errno())
   {
    //$this->logBug('Die Datenbankverbindung ist fehlgeschlagen.');
    exit();
   }
  } 
  
  public function setQuery($query)
  {
   $this->sqlquery=$query;
  }
  
  public function getQuery()
  {
   return $this->sqlquery;
  }
  
  public function makeQuery($query='')
  {
   if($query=='' || $query==null)
   {
    if($result=$this->mysqli->query($this->sqlquery))
	{
	 //Weitergabe zum Log
	 $this->sqlresult=$result;
	 return $result;
	}
	else
	{
	 echo 'Fehler ('.$this->mysqli->sqlstate.'): '.$this->mysqli->error;
	 $this->logBug();
	}
   }
   else
   {
    if($result=$this->mysqli->query($query))
	{
	 //Weitergabe zum Log
	 $this->sqlresult=$result;
	 return $result;
	}
	else
	{
	 echo 'Fehler ('.$this->mysqli->sqlstate.'): '.$this->mysqli->error;
	 $this->logBug();
	}
   }
  }
  
  public function makeResult($result=false)
  {
   $array=array();
   if($result===false && isset($result))
   {
    if(isset($this->sqlresult))
    {
     while($row=$this->sqlresult->fetch_assoc())
	 {
	  array_push($array,$row);
	 }
	 return $array;
    }
    else
      return false;
   }
   else
   {
    while($row=$result->fetch_assoc())
	{
	 array_push($array,$row);
	}
	return $array;
   }
  }
  
  public function getAffectedRows()
  {
   return $this->mysqli->affected_rows;
  }
  
  //Log-Funktion sp�ter durch class.logger.php realisiert
  private function sendBugMail()
  {
   $empfaenger="medienwart@rggerresheim.de";
   $betreff="SQL-Reply";
   $from="From: RGG-HP <medienwart@rggerresheim.de>\n";
   $from.="Reply-To: medienwart@rggerresheim.de\n";
   $from.="Content-Type: text/html\n";
   $text=$this->buglog;

   mail($empfaenger, $betreff, $text, $from);

  }
  
  private function sendBugLog()
  {
   file_put_contents('./log/buglog.htm',$this->buglog,FILE_APPEND);
  }
    
  private function logBug($message='')
  {
   if(!isset($message) || $message=='')
   {
    $this->buglog.='<p>'.date('d.m.Y. H:i:s').'<br />SQL-Fehler('.$this->mysqli->errno.') :'.$this->mysqli->error.'<br />[SQLSTATE]: '.$this->mysqli->sqlstate.'<hr /></p>';
   }
   else
   {
    $this->buglog.='<p>'.date('d.m.Y. H:i:s').'<br />'.$message.'<hr /></p>';
   }
  }
  
  function __destruct()
  {
   $this->mysqli->close();
  }
  
 }
?>