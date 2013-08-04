<?php
require("OAuth.php");
 
$cc_key  = "dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz";
$cc_secret = "a3d93853ba3bad8a99a175e8ffa90a702cd08cfa";
$url = "http://yboss.yahooapis.com/ysearch/news,web,images";
$args = array();
$args["q"] = "dota 2";
$args["format"] = "json";
 
$consumer = new OAuthConsumer($cc_key, $cc_secret);
$request = OAuthRequest::from_consumer_and_token($consumer, NULL,"GET", $url, $args);
$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, NULL);
$url = sprintf("%s?%s", $url, OAuthUtil::build_http_query($args));
$ch = curl_init();
$headers = array($request->to_header());
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$rsp = curl_exec($ch);
$results = json_decode($rsp);
print_r($results);
?>