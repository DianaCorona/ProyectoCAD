<?php 
    //Declaración del Objeto $consultas de la Clase controladora DBClass.php necesaria para el control de funciones del Sistema
    include_once 'DBClass.php';
    $consultas = new DBClass(); 
    
    //Validación de SESION
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('Mexico/General');    
    
    if((!isset($_SESSION['autorizacionrm']))||($_SESSION['autorizacionrm']==false))
    {
        header("Location: index.php");        
        exit;
    }   
?>
<!DOCTYPE html>
<html lang="en">

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
        <link rel="stylesheet" type="text/css" href="css/style.css">

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
        
    </head>

    <body class="ink-drawer">
        <!-- Validación de IE9 -->
        
        <!--[if lte IE 9 ]>
        <div class="ink-grid">
            <div class="ink-alert basic" role="alert">
                <button class="ink-dismiss">&times;</button>
                <p>
                    <strong>You are using an outdated Internet Explorer version.</strong>
                    Please <a href="http://browsehappy.com/">upgrade to a modern browser</a> to improve your web experience.
                </p>
            </div>
        </div>
        -->
        
        <!-- Include del archivo Menu -->	
        <?php include ("menu.php"); ?>

        <div class="content-drawer" style="margin-top:50px;">
            <div class="ink-grid">
                <div class="column-group">
                    <div class="all-100">
                        <h1>titulo</h1>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
                        <p>And though of all men the moody captain of the Pequod was the least given to that sort of shallowest assumption; and though the only homage he ever exacted, was implicit, instantaneous obedience; though he required no man to remove the shoes from his feet ere stepping upon the quarter-deck; and though there were times when, owing to peculiar circumstances connected with events hereafter to be detailed, he addressed them in unusual terms, whether of condescension or IN TERROREM, or otherwise; yet even Captain Ahab was by no means unobservant of the paramount forms and usages of the sea.</p>
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