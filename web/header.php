<div class='top-overlay'>
<div class='yui3-g-r top'>
	<div class='yui3-u-4-5'>
		<div style="padding-left:20px">
			<h1 class="logo" >Soc Sea</h1>
			<!--b>Social Search on <img src="yahoo.png" style="height:15px;width:auto"/></b-->
		</div>
	</div>
	<div class='yui3-u-1-5'>
		<div class='unlogged-info'>
		<?php if(is_loggedin()){
			echo "<img src='".getUserPic()."' style='height:40px;width:40px;float:left' /><b> ";
			echo getUsername();
			$config = array(
		            'appId' => '473716305986228',
		            'secret' => '833d11c4693957b672518cdb8319f924',
		        );
		        $facebook = new Facebook($config);
			$logoutUrl = $facebook->getLogoutUrl();
			echo '<a href="'.$logoutUrl.'">Logout</a>';
		}
		else {
		?>		
				You are not logged in.<br>
				Please Login
		<?php } ?>
		</div>
	</div>
</div>
</div>
