<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Test Gallery js </title>
        <link rel="stylesheet" type="text/css" href="app/css/bootstrap.min.css"/> 
        <link rel="stylesheet" type="text/css" href="app/css/public.css"/>
        <link rel="stylesheet" type="text/css" href="app/css/plugin.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="app/js/public.js"/></script>
        <script type="text/javascript" src="app/js/jquery.slideshowTrebouzul.js"/></script>
        <script type="text/javascript" src="app/js/bootstrap.min.js"/></script>
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
                <?php if (!isset($_GET['section']) OR $_GET['section'] != 'login') { ?>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?= "index.php?section=login "?>">Se connecter  </a></li>
                </ul>

                <form class="navbar-form navbar-right" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Categorie, titre...">
                  </div>
                  <button type="submit" class="btn btn-default">Chercher</button>
                </form>
                <div id="ajax-gallery">
                  <ul id="galleries-list" class="nav navbar-nav navbar-right">
                    <?php foreach ($listGalleries as $gallery) {?>
                      <li id="<?= "gallery" . $gallery->getId() ?>" class="gallery-desc " /
                        data-placement="bottom" data-original-title="<?= $gallery->getDescription(); ?>">
                        <?php (isset($_GET['gal']) && $_GET['gal'] == $gallery->getId()) || (!isset($_GET['gal']) && $gallery == $listGalleries[0])? $class = "gal-active" : $class = "" ?>
                            <a href="index.php?section=home&gal=<?= $gallery->getId()  ?>" / 
                              class="<?=$class  ?>"><?= $gallery->getName() ?></a>
                      </li>
                      <?php } ?>
                  </ul>
                </div>
                <?php } ?>
            </nav>
        </header>

<script type="text/javascript">

  $(".gallery-desc").tooltip();

</script>
