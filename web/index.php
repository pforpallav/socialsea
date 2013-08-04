<?php session_start()?>

<html>
<head>

<title>
	Search
</title>
<link rel="stylesheet" type="text/css" href="cssgrids-responsive-min.css">
<link rel="stylesheet" type="text/css" href="home.css">
<?php include "utils.php"; ?>
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
            <div class="results">
                <?php 
                    if(isset($_GET['q']))
                    {
                        $json=searchBOSS($_GET['q']);

                        //var_dump($json);
                        $results = $json["bossresponse"]["web"]["results"];
                        foreach ($results as $key) {
                            echo $key['dispurl'];
                        }
                    }
                ?>
            </div>
            <div class="paginator">
            </div>
        </div>

        <?php }
            else{ 
                $config = array(
                    'appId' => '473716305986228',
                    'secret' => '833d11c4693957b672518cdb8319f924',
                );
                $facebook = new Facebook($config);
                $login_url = $facebook->getLoginUrl();
            ?>
            <div class='yui3-g-r' style="text-align:center;margin-top:100px">
            <a href="' . $login_url . '"><img src="login_1.png" style="height:172.5px;width:360px"/></a>
            </div>
        <?php } ?>

    </div>

    <?php include "footer.php"; ?>
</body>
</html>