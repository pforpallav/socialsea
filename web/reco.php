<?php
//phpinfo();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');
$forward_url = $_GET['url'];
$one = 1;
$check_sql = "UPDATE `LikedLinks` SET Reco=".$one." WHERE YourID='".$_SESSION['fb_id']."' AND Links='".$forward_url."'";
$check_count = run_query($check_sql);
if(!$check_count){
	$link_sql = "INSERT INTO `LikedLinks` (YourID, Links,ViewCount,Reco) VALUES ('".$_SESSION['fb_id']."','".$forward_url."',".$one.",".$one.")";
	run_query($link_sql);
}
header("location:javascript://history.go(-1)");
?>