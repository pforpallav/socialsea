<?php require ('facebook-php-sdk-master/src/facebook.php'); ?>
<?php
	function is_loggedin(){
		$config = array(
		'appId' => '473716305986228',
		'secret' => '833d11c4693957b672518cdb8319f924',
	  	);
		$facebook = new Facebook($config);
  		$user_id = $facebook->getUser();
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
		if($a['reco_count']==$b['reco_count'])
		{
			return $b['count'] - $a['count'];
		}
		return $b['reco_count'] - $a['reco_count'];
   			
	}

	function process_json($input){
		$results = $input["bossresponse"]["web"]["results"];
		$config = array(
		'appId' => '473716305986228',
		'secret' => '833d11c4693957b672518cdb8319f924',
	  	);
		$facebook = new Facebook($config);
		$friends = $facebook->api('/me/friends');
		$con = db_connect();
		$friends_array = array();
		$final_results = array();
		foreach ($friends['data'] as $friend) {
			array_push($friends_array,$friend['id']);
		}
		foreach ($results as $result) {
			$url_count = 0;
			$view_count = 0;
			$reco_count = 0;
			$find_count = "SELECT `YourID`,`ViewCount`,`Reco` FROM `LikedLinks` WHERE Links='".$result['clickurl']."'";
			$result1 = mysql_query($find_count,$con);
			if(!$result1){
				echo mysql_errno($con).": ".mysql_error($con)."\n";
			}
			while ($row = mysql_fetch_row($result1)) {
				if (in_array($row[0], $friends_array)) {
				    $url_count++;
				    $view_count = $view_count + $row[1];
				    $reco_count = $reco_count + $row[2];
				}
			}
			$one = "1";
			$check_reco = "SELECT * FROM `LikedLinks` WHERE YourID='".$_SESSION['fb_id']."' AND Links='".$result['clickurl']."' AND Reco = 1";
			$result2 = mysql_query($check_reco,$con);
			if(mysql_num_rows($result2)==0){
				$result['self_reco'] = false;
				echo mysql_errno($con).": ".mysql_error($con)."\n";
			}
			$result['self_reco'] = true;
			$result['count'] = $url_count;
			$result['view_count'] = $view_count;
			$result['reco_count'] = $reco_count;
			array_push($final_results,$result);
		}
		db_disconnect($con);
		usort($final_results, 'sortURL');
		return $final_results;
	}
?>
