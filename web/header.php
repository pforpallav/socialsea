<div class='top-overlay'>
<div class='yui3-g-r top'>
	<div class='yui3-u-4-5'>
		<div style="padding-left:20px">
			<h1 class="logo" >Social Sea</h1>
			<!--b>Social Search on <img src="yahoo.png" style="height:15px;width:auto"/></b-->
		</div>
	</div>
	<div class='yui3-u-1-5'>
		<?php if(is_loggedin()){
			echo '<div class="unlogged-info">';
			echo "<img src='".getUserPic()."' style='height:40px;width:40px;float:right;margin-left:10px' /><b> ";
			echo getUsername();
			$config = array(
		            'appId' => '473716305986228',
		            'secret' => '833d11c4693957b672518cdb8319f924',
		        );
		        $params = array( 'next' => 'https://socialsearch.cloudcontrolled.com/logout.php' );
		        $facebook = new Facebook($config);
			$logoutUrl = $facebook->getLogoutUrl($params);
			echo '<br><a href="'.$logoutUrl.'">Logout</a>';
		}
		else {
		?>
		<div class='unlogged-info' style="display:none">		
				You are not logged in.<br>
				Please Login
		<?php } ?>
		</div>
	</div>
</div>
</div>
