<?php require ('facebook-php-sdk-master/src/facebook.php'); ?>
<?php
	function is_loggedin(){
		$config = array(
		'appId' => '473716305986228',
		'secret' => '833d11c4693957b672518cdb8319f924',
	  	);
		$facebook = new Facebook($config);
  		$user_id = $facebook->getUser();
  		echo "userid is: ".$user_id;
  		if($user_id){
			try {
	            $me = $facebook->api('/me');
	  			$_SESSION['fb_id'] = $me['id'];
	  			$_SESSION['user_name'] = $me['name'];
	  			$_SESSION['pic_url'] = "http://graph.facebook.com/".$me['id']."/picture"; 
				$return = true;
			}	catch(FacebookApiException $e) {
				$return = false;
	      		}   
  		} else {
  			$return = false;
  		}
  		return $return;
	}

	function getUsername(){
		return $_SESSION['user_name'];
	}

	function getUserPic(){
		return $_SESSION['pic_url'];
	}

	function db_connect(){
		$dbhost = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com:3306';
		$dbuser = 'deppgaqahr2';
		$dbpass = '9WTSxxe07shi';
		$con = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql' . mysql_error());
		$dbname = 'deppgaqahr2';
		mysql_select_db($dbname);
		return $con;
	}

	function db_disconnect($con){
		mysql_close($con);
	}

	function run_query($query){
		$con = db_connect();
		$ret = mysql_query($query,$con);
		if(!$ret){
			echo mysql_errno($con).": ".mysql_error($con)."\n";
		}
		db_disconnect($con);
		return $ret;
	}

	function sortURL($a, $b) {
   		return strtotime($a['count']) - strtotime($b['count']);
	}

	function process_json($input){
		$results = $input["bossresponse"]["web"]["results"];
		$friends = $facebook->api('/me/friends');
		foreach ($results as $result) {
			$url_count = 0;
			foreach ($friends['data']['id'] as $friend_id) {
				$find_count = "SELECT count(*) FROM `LikedLinks` WHERE YourID='".$friend_id."' AND Links='".$result['clickurl']."'";
				$url_count += run_query($find_count);
			}
			$result['count'] = $url_count;
		}
		return usort($results, 'sortURL');
	}
?>
