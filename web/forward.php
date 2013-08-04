<?php
//phpinfo();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
//require('oauth/OAuth.php');

//process request here
$forward_url = $_GET['url'];

header("Location: ".$forward_url);
?>