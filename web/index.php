<?php session_start()?>
<html>
<head>

<title>
Social Sea
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
        <div id="demo" class="yui3-g-r">
            <form>
                <input type="text" name="q" placeholder="Your Query" <?php if(isset($_GET['q'])){echo "value=".$_SERVER["QUERY_STRING"];} ?> style="background: #EEE;border: 1px solid #AAA;">
                <input type="submit" value="Search" class="yui3-button">
            </form>
        </div>

                <?php 
                    if(isset($_GET['q']))
                    {
                ?>
                <div class='yui3-g-r result-div'>
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
                                    <h3><a href="forward.php?url=<?php echo $key['clickurl']; ?>"><?php echo $key['title']; ?></a>
                                    <span style="style="color: darkgreen;font-style: italic;font-size: 12px;float: right;text-align: right;">
                                        <p style="margin: 5px 0px -5px 0px;">
                                        <?php 
                                         if($key['count']>0){
                                         	echo $key['count'].'  of your friends visited this';
                                         }?> 
                                        </p>
                                        <p> 
                                        <?php 
                                         if(!$key['self_reco']){ ?>
                                            <a href="reco.php?url=<?php echo $key['clickurl']; ?>">Recommend</a>
                                        <?php } else {?> 
                                            <a href="dereco.php?url=<?php echo $key['clickurl']; ?>">Un-Recommend</a>
                                        <?php }
                                        if($key['reco_count']>0){
                                            echo $key['reco_count'].' friends Recommended this';
                                         }
                                        ?> 
                                        </p>
                                    </span>
                                    </h3>
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
            <div class='yui3-g-r' style="text-align:center;padding-top:100px">
            <a href="<?php echo $login_url ?>"><img src="login_1.png" style="height:172.5px;width:360px"/></a>
            </div>
        <?php } ?>

    </div>

    <?php include "footer.php"; ?>
</body>
</html>
