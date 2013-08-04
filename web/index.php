<?php session_start()?>
<html>
<head>

<title>
	SocialSea
</title>
<link rel="stylesheet" type="text/css" href="cssgrids-responsive-min.css">
<link rel="stylesheet" type="text/css" href="home.css">
<?php require "utils.php"; ?>
<?php require("search.php"); ?>
</head>
<body style="margin:0px">
    <?php include "header.php"; ?>

    <div class="container">

        <?php if(isset($_SESSION['fb_id'])){ ?>   
        <div id="demo" class="yui3-g-r hide-pg search-div">
            <form>
                <input type="text" name="q" value="search">
                <input type="submit" value="Search" class="yui3-button">
            </form>
        </div>

                <?php 
                    if(isset($_GET['q']))
                    {
                ?>
                <div class='yui3-g-r search-div'>
                <?php
                        $json=searchBOSS($_GET['q']);
                        $json=process_json($json);

                        //var_dump($json);
                        $results = $json;//["bossresponse"]["web"]["results"];
                        foreach ($results as $key) {
                            //echo $key['dispurl'];?>
                            <!-- repeat this block -->
                            <div class="yui3-u-3-5 results">
                                <div class="title" style="color:#00f;">
                                    <h3><a href="forward.php?url=<?php echo $key['clickurl']; ?>"><?php echo $key['title']; ?></a></h3>
                                    <span style="float:right"><p> 
                                    <?php 
                                     if($key['count']>0){
                                     	echo $key['count'].'  friend visited this';
                                     }?> </p></span>
                                </div>
                                <div class="dispurl" style="color:#3b3;margin-top:-18px;">
                                    <?php echo $key['dispurl']; ?>
                                </div>
                                <div class="content">
                                    <?php echo $key['abstract']; ?>
                                </div>
                            </div>
                            <?php

                        }
                    }
                ?>

                </div>
        <?php }
            else{ 
                $config = array(
                    'appId' => '473716305986228',
                    'secret' => '833d11c4693957b672518cdb8319f924',
                );
                $facebook = new Facebook($config);
                $params = array('redirect_uri' => 'https://socialsearch.cloudcontrolled.com');

                $login_url = $facebook->getLoginUrl();
            ?>
            <div class='yui3-g-r' style="text-align:center;margin-top:100px">
            <a href="<?php echo $login_url ?>"><img src="login_1.png" style="height:172.5px;width:360px"/></a>
            </div>
        <?php } ?>

    </div>

    <?php include "footer.php"; ?>
</body>
</html>
