<?php
//phpinfo();
/*session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require('utils.php');

$cc_key  = "dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz";
$cc_secret = "a3d93853ba3bad8a99a175e8ffa90a702cd08cfa";
$url = "http://yboss.yahooapis.com/ysearch/web";

$args = array();
$args["q"] = "dota 2";
$args["format"] = "json";

try {
  $oauth = new OAuth($cc_key, $cc_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
  $oauth->enableDebug();
  $oauth->fetch($url,$args);
  $json = json_decode($oauth->getLastResponse(),true);
  $json = process_json($json);
  print_r($json);
} catch(OAuthException $E) {
  print_r($E);
}*/

$query_string = $_SERVER['QUERY_STRING'];
$query_string = strstr($query_string, "q="); // As of PHP 5.3.0
$query_string1 = strstr($query_string, "&", true);
if(strcmp($query_string1, "") != 0)
	$query_string = $query_string1;
//$query_string = strstr($query_string, "#", true);
$query_string = substr($query_string, 2);
$query_string = str_replace("+", " ", $query_string);
echo $query_string;

?>
