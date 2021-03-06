<?php
    include_once 'DBClass.php';
    $consultas = new DBClass();
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('Mexico/General');
    if((!isset($_SESSION['autorizacionrm']))||($_SESSION['autorizacionrm']==false))
    {
        header("Location: index.php");
        exit;
    }   
    $consultas->destruirSesion();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema Record</title>
        <meta name="description" content="Sistema de control de inventarios">
        <meta name="author" content="PARANOIT.mx">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- Place favicon.ico and apple-touch-icon(s) here  -->

        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="img/touch-icon.57.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch-icon.72.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch-icon.114.png">
        <link rel="apple-touch-startup-image" href="img/splash.320x460.png" media="screen and (min-device-width: 200px) and (max-device-width: 320px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">

        <!-- load inks css from the cdn -->
        <link rel="stylesheet" type="text/css" href="css/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

        <!-- load inks css for IE8 -->
        <!--[if lt IE 9 ]>
            <link rel="stylesheet" href="css/ink-ie.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <![endif]-->

        <!-- test browser flexbox support and load legacy grid if unsupported -->
        <script type="text/javascript" src="js/modernizr.js"></script>
        <script type="text/javascript">
            Modernizr.load({
                test: Modernizr.flexbox,
                nope : 'css/ink-legacy.min.css'
            });
        </script>

        <!-- load inks javascript files from the cdn -->
        <script type="text/javascript" src="js/holder.js"></script>
        <script type="text/javascript" src="js/ink-all.min.js"></script>
        <script type="text/javascript" src="js/autoload.js"></script>


        <style type="text/css">
            footer {
                height:100px;
                color:#fff;
                background: #a4a4a4;
            }
        </style>
        
        <script>
            Ink.requireModules(['Ink.UI.Drawer_1'], function(Drawer) {
                var inkDrawer = new Drawer({ sides: 'left', mode: 'push' });
            });
        </script>
    </head>
    <body class="ink-drawer">
        <div id="top-menu" style="position:fixed;top:0;z-index:100;background:#1B75CE;width:100%;">
            <nav class="ink-navigation ink-grid">
                <ul class="menu horizontal blue push-left medium-push-left small-push-left tiny-push-left">
                    <li class="hide-all show-tiny show-small show-medium"><a style="font-size:1em;" class="fa fa-bars left-drawer-trigger"></a> </li>
                    <li><img src="mundo.png" style="height:40px;margin:0 1em 0 0;padding-top:6px;"></li>

                </ul>
                
                <ul class="menu horizontal blue push-right">
                    <li class="condensed-300">
                        <a style="color:#fff;" href="index.php"> Iniciar Sesión&nbsp <span style="font-size:1em;" class="fa fa-user"></span></a>
                        
                    </li>
                </ul>
            </nav>
        </div>

        <div class="left-drawer" style="margin-top:45px;background:#c6c6c6;">
            <nav class="ink-navigation ink-grid" style="padding:0;">
                <ul class="menu vertical black">
                    <li class="condensed-300 active"><a href="#">item 1</a></li>
                    <li class="condensed-300">
                        <a href="#">item 2</a>
                        <ul class="submenu">
                            <li class="condensed-300"><a href="#">item 2.1</a></li>
                            <li class="condensed-300"><a href="#">item 2.2</a></li>
                            <li class="condensed-300"><a href="#">item 2.3</a></li>
                        </ul>
                    </li>
                    <li class="condensed-300"><a href="#">item 3</a></li>
                    <li class="condensed-300"><a href="#">item 4</a></li>
                    <li class="condensed-300"><a href="#">item 5</a></li>
                </ul>
            </nav>
        </div>
        <!-- Contenido -->	
        <div class="content-drawer" style="margin-top:50px;">
            <div class="ink-grid">
                <div class="column-group">
                    <div class="all-100">
                        <h1>Fin de Sesión</h1>
                        
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                    </div>
                </div>
            </div>
        </div>
		
        <footer class="clearfix">
            <div class="ink-grid">
                <p>Footer</p>
            </div>
        </footer>
	
    </body>
</html>
