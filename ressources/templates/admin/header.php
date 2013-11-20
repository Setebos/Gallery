<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Test Gallery js - Espace admin </title>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css"/> 
        <link rel="stylesheet" type="text/css" href="../../css/admin.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"/></script>
        <!--[if IE]>
            <script src="js/html5-ie.js"></script>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
          include("../../../ressources/config.php");
          try {
               $bdd = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
          }
          catch (Exception $e) {
                  die('Erreur : ' . $e->getMessage());
          }
        ?>

        <header>
            <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Gallery Powa - Administration</a>
                </div>
               
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php">Se déconnecter  </a></li>
                </ul>
            </nav>
        </header>
