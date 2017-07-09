<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Portal SEAT</title>
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" type="text/css" href="content/normalize.css">
    <link rel="stylesheet" type="text/css" href="content/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="content/datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="content/animate.css">
    <link rel="stylesheet" type="text/css" href="content/index.css">
    <script src="scripts/jquery.min.js" type="text/javascript"></script>
    <script src="scripts/moment.js" type="text/javascript"></script>
    <script src="scripts/bootstrap.js" type="text/javascript"></script>
    <script src="scripts/datetimepicker.min.js" type="text/javascript"></script>
    <script src="scripts/index.js" type="text/javascript"></script>
</head>
<body id="bodi">
    <header><?php include("shared/head.php"); ?></header>
    <div id="page">
        <?php
            if(isset($_GET['p']))
            {
                $page_name = $_GET['p'];
                include($page_name.".php");
            }
            else
            {
                include("home.php");
            }
        ?>
    </div>
    <footer><?php include("shared/foot.php"); ?></footer>
</body>
</html>