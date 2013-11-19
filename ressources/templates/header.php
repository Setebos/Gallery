<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Test Gallery js </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"/></script>
        <!--[if IE]>
            <script src="js/html5-ie.js"></script>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        include("../ressources/config.php");
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
                    <a class="navbar-brand" href="#">Gallery Powa</a>
                </div>
               
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="login.php">Se connecter  </a></li>
                </ul>

                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Catégorie, titre...">
                  </div>
                  <button type="submit" class="btn btn-default">Chercher</button>
                </form>

                 <ul class="nav navbar-nav navbar-right">
                      <li class="active"><a href="#">Gallery 1</a></li>
                      <li><a href="#">Gallery 2</a></li>
                </ul>
            </nav>
        </header>
