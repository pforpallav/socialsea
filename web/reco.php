<?php
//phpinfo();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');
$forward_url = $_GET['url'];
$check_sql = "SELECT * FROM `LikedLinks` WHERE YourID='".$_SESSION['fb_id']."' AND Links='".$forward_url."'";
$check_count = run_query($check_sql);
if(mysql_num_rows($check_count)==0){
	echo 'not present';
	$link_sql = "INSERT INTO `LikedLinks` (YourID,Links,ViewCount,Reco) VALUES ('".$_SESSION['fb_id']."','".$forward_url."',1,1)";
	run_query($link_sql);
}
else
{
	echo 'present';
	$link_sql = "UPDATE `LikedLinks` SET Reco=1 WHERE YourID='".$_SESSION['fb_id']."' AND Links='".$forward_url."'";
	run_query($link_sql);
}
header("Location: ".$_GET['curr']);
?>