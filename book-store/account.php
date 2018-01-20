
<?php
require 'log.php';
require 'connect.php';
 
  if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){

echo "this is my account";
//account page
}else{
	include 'login.php';
}
?>