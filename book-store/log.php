<?php
  ob_start();
  if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
  $current_php_page = @$_SERVER['SCRIPT_NAME'];
  $http_refer=@$_SERVER['HTTP_REFERER'];
  
?>