<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Test Gallery js </title>
        <link rel="stylesheet" type="text/css" href="app/css/bootstrap.min.css"/> 
        <link rel="stylesheet" type="text/css" href="app/css/public.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"/></script>
        <!--[if IE]>
            <script src="js/html5-ie.js"></script>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    </head> 

    <body>
  

        <header>
            <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Gallery Powa</a>
                </div>
               
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?= "index.php?section=login "?>">Se connecter  </a></li>
                </ul>

                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Categorie, titre...">
                  </div>
                  <button type="submit" class="btn btn-default">Chercher</button>
                </form>

                 <ul class="nav navbar-nav navbar-right">
                    <?php foreach ($listGalleries as $gallery) {?>
                      <li>
                            <a href="#"><?= $gallery->getName() ?></a>
                      </li>
                      <?php } ?>
                </ul>
            </nav>
        </header>
