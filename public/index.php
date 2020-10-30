<?php
    require_once 'init.php';
    $authenticated = $app->is_authenticated();
?>

<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="author" content="QUAD SYSTEMS">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <title> <?php echo APP_TITLE; ?></title>
        <!--<link place="index" rel="manifest" href="<?php echo ASSETS_URL; ?>/manifest.json">-->
        
        <style>
            .iframe-container iframe {
               border: 0;
               height: 100%;
               left: 0;
               position: absolute;
               top: 0;
               width: 100%;
            }
            
            body { 
                margin:0px!important;
                overflow: hidden!important;
            }
        </style>
    </head>
    <!--<frameset id="frame" rows="*" cols="*" frameborder="no" border="0" framespacing="0" onmouseover="document.body.style.overflow='hidden';" onmouseout="document.body.style.overflow='hidden';">-->
    <div class="iframe-container">
        <?php
        if ($authenticated) {
            echo '<iframe src="home.php" allowfullscreen class="logMe" id="logMe"></iframe>';
        } else {
            echo '<iframe src="login.php" allowfullscreen class="homeMe" id="homeMe"></iframe>';
        }
        ?>
    </div>
    <!--</frameset>

    <noframes></noframes>-->

</html>

