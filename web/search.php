<?php
//phpinfo();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
//require('oauth/OAuth.php');


$cc_key  = "dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz";
$cc_secret = "a3d93853ba3bad8a99a175e8ffa90a702cd08cfa";
$url = "http://yboss.yahooapis.com/ysearch/web";
$args = array();
$args["q"] = "dota 2";
$args["format"] = "json";

$req_url = 'https://fireeagle.yahooapis.com/oauth/request_token';
$authurl = 'https://fireeagle.yahoo.net/oauth/authorize';
$acc_url = 'https://fireeagle.yahooapis.com/oauth/access_token';
$api_url = 'https://fireeagle.yahooapis.com/api/0.1';

try {
  $oauth = new OAuth($cc_key, $cc_secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
  $oauth->enableDebug();
  $oauth->fetch($url,$args);
  $json = json_decode($oauth->getLastResponse(),true);
} catch(OAuthException $E) {
  print_r($E);
}
 
print_r($json);
?>