<?php
//phpinfo();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');

$forward_url = $_GET['url'];
echo $_SESSION['fb_id'];
echo $forward_url;
$check_sql = "UPDATE `LikedLinks` SET Reco=0 WHERE YourID='".$_SESSION['fb_id']."' AND Links='".$forward_url."'";
$check_count = run_query($check_sql);
?>