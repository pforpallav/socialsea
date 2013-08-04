<?php
//phpinfo();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');

$delete_sql = "DELETE FROM `LikedLinks`";
$check_count = run_query($delete_sql);

?>