<?php
require 'log.php';
echo $http_refer;
session_destroy();
header('Location: '.$http_refer);
?>