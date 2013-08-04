<?php
//phpinfo();
session_start();
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
  print($json);
} catch(OAuthException $E) {
  print_r($E);
}

?>