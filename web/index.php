<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require ('facebook-php-sdk-master/src/facebook.php');

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

        $friends = $facebook->api('/me/friends');

        echo '<ul>';
        foreach ($friends["data"] as $value) {
            echo '<li>';
            echo '<div class="pic">';
            echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
            echo '</div>';
            echo '<div class="picName">'.$value["name"].'</div>'; 
            echo '</li>';
        }
        echo '</ul>';

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'create_event, rsvp_event'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, so print a link for the user to login
      $login_url = $facebook->getLoginUrl(); 
      echo 'Please <a href="' . $login_url . '">login.</a>';
    }   
  ?>  
  </body>
</html>


