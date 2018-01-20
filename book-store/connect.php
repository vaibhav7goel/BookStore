
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
 $mysql_host='localhost';
 $mysql_user='vaibhav';
 $mysql_password='';
 $mysql_db="store";
 $Error_msg="sorry cannot connect to the database ";
  
 if($con=mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db)){
	
 }else
  die($Error_msg);
 // $connection=1 when it will be connected
?>