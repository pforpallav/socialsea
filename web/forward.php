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
$check_sql = "SELECT * FROM LikedLinks WHERE YourID=".$_SESSION['fb_id']."AND Links=$forward_url";
$check_count = run_query($check_sql);
echo $check_count;
if(mysql_num_rows($check_count)==0){
	$link_sql = "INSERT INTO LikedLinks (YourID, Links) VALUES (".$_SESSION['fb_id'].",$forward_url)";
	run_query($link_sql);
?><script>alert("Added entry!! <?php echo $check_count;?>")</script><?php
}
else{
	?><script>alert(" entry already present!!")</script><?php
}


//header("Location: ".$forward_url);
?>