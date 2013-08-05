 <?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');

$link_table_sql="CREATE TABLE LikedLinks(YourID CHAR(30),Links CHAR(200),ViewCount INT(30),Reco CHAR(30))";
$check_count = run_query($link_table_sql);

?>