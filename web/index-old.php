<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require ('facebook-php-sdk-master/src/facebook.php');

echo 'Give up';
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

  $config = array(
    'appId' => '473716305986228',
    'secret' => '833d11c4693957b672518cdb8319f924',
  );

  // Initialize a Facebook instance from the PHP SDK
  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();

  // Convenience method to print simple pre-formatted text.
  function printMsg($msg) {
     echo "<pre>$msg</pre>";
  }
?>
<html>
  <head></head>
  <body>

  <?php
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        // Get the user profiles so we can print friendly messages
        $me = $facebook->api('/me', 'GET');
       
        printMsg('Hello ' . $me['name']);

	$dbhost = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com:3306';
	$dbuser = 'deppgaqahr2';
	$dbpass = '9WTSxxe07shi';
	$con = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql' . mysql_error());
	$dbname = 'deppgaqahr2';
	echo 'Connection completed';
	mysql_select_db($dbname);
	echo 'Database selected';
	// Check connection

	$check_friends_table = 'select * from Friends';

	$friendsPresent = mysql_query($check_friends_table);

	if($friendsPresent == FALSE)
	{
	  $friend_table_sql="CREATE TABLE Friends(YourID CHAR(30),FriendID CHAR(30))";
	  if (mysql_query($friend_table_sql))
  	  {
		  echo 'Friend Table  created successfully';
	  }
	  else
	  {
		  echo 'Error creating table friends';
	  }
	}

	$check_links_table = 'select * from LikedLinks';

	$linkTablePresent = mysql_query($check_links_table);

	if($linkTablePresent == FALSE)
	{
	  $link_table_sql="CREATE TABLE LikedLinks(YourID CHAR(30),Links CHAR(200))";
	  if (mysql_query($link_table_sql))
  	  {
		  echo 'link Table  created successfully';
	  }
	  else
	  {
		  echo 'Error creating table link';
	  }
	}

	$myId = $me['id'];
	$friends = $facebook->api('/me/friends');
	foreach ($friends["data"] as $value) {

		$friendId = $value['id'];
	  	$friend_sql="INSERT INTO Friends (YourID, FriendID)
			VALUES ($myId,$friendId)";

		if (!mysql_query($friend_sql))
	  	{
		  die('Error in adding friend');
	  	}
        }

	mysql_close($con);
	    

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
      }   
    } else {

      // No user, so print a link for the user to login
      $login_url = $facebook->getLoginUrl(); 
      echo 'Please <a href="' . $login_url . '">login.</a>';
    }   
  ?>  
  </body>
</html>


