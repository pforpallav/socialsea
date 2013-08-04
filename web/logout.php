<?php
	session_start();
  	session_unset();
  	$forward_url = "https://socialsearch.cloudcontrolled.com";
  	header("Location: ".$forward_url);
?>
