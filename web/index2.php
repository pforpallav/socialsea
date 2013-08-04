<html>
<head>

	<title>
		Search
	</title>
<link rel="stylesheet" type="text/css" href="cssgrids-responsive-min.css">
<link rel="stylesheet" type="text/css" href="home.css">
<?php 
//phpinfo();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
?>
<?php include "utils.php"; ?>
<?php include "search.php"; ?>
</head>
<body style="margin:0px">
    <?php include "header.php"; ?>

    <div class="container">

        <?php if(is_loggedin()){ ?>   
        <div id="demo" class="yui3-g-r hide-pg search-div">
            <form>
                <input type="text" name="q" value="search2">
                <input type="submit" value="Search" class="yui3-button">
            </form>

            <?php 
                    echo "abcd";
                    if(isset($_GET('q')))
                    {
                        $json=searchBOSS($_GET('q'));

                        //display results
                        foreach ($json as $title => $value) {
                            echo $title;
                        }
                    }
                ?>
            <div class="results">
            </div>
            <div class="paginator">
            </div>
        </div>

        <?php }
              else{ ?>
        <div class='yui3-g-r' style="text-align:center;margin-top:100px">
            <img src="login_1.png" style="height:172.5px;width:360px"/>
        </div>
        <?php } ?>

    </div>

    <?php include "footer.php"; ?>
</body>
</html>