<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Test Gallery js </title>
        <link rel="stylesheet" type="text/css" href="app/css/bootstrap.min.css"/>       
        <link rel="stylesheet" type="text/css" href="app/css/public.css"/>
        <link rel="stylesheet" type="text/css" href="app/css/plugin.css"/>
        
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <?php $IE8 = (ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
            if ($IE8 == 1) {  ?>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
           <?php  } else { ?>
                <script type="text/javascript" src="app/js/jquery_2.0.3.min.js"></script>
            <?php } ?>
        <script type="text/javascript" src="app/js/jquery-ui_1.10.3.min.js"></script>
        <script type="text/javascript" src="app/js/public.js"/></script>
        <script type="text/javascript" src="app/js/jquery.slideshowTrebouzul.js"/></script>
        <script type="text/javascript" src="app/js/bootstrap.min.js"/></script>
        <!--<script type="text/javascript" src="app/js/respond.js"></script>-->
        <!--[if IE]>
            <script src="app/js/html5-ie.js"></script>
            <script src="app/js/html5shiv.js"></script>
            <script src="app/js/respond.js"></script>
        <![endif]-->
    </head> 

    <body>
        <header>
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Gallery Powa</a>
                </div>
                <?php if (!isset($_GET['section']) OR $_GET['section'] != 'login') { ?>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?= "index.php?section=login "?>">Se connecter  </a></li>
                </ul>
                <?php 
                    (isset($_POST['searched']) && $_POST['searched'] != '')? $placeholder = "".$_POST['searched']."" :  $placeholder = "Rech. par titre";
                ?>
                <form method="post" action="<?= "index.php?section=home "?>" class="navbar-form navbar-right" role="search">
                  <div class="form-group">
                    <input type="text" id="search-input" name="searched" class="form-control" placeholder="<?= $placeholder; ?>">
                  </div>
                  <button type="submit" class="btn btn-default">Rechercher</button>
                </form>

                <div id="ajax-gallery">
                  <ul id="galleries-list" class="nav navbar-nav navbar-right">
                    <?php foreach ($listGalleries as $gallery) {?>
                      <li id="<?= "gallery" . $gallery->getId() ?>" class="gallery-desc " /
                        data-placement="bottom" data-original-title="<?= $gallery->getDescription(); ?>">
                        <?php 
                        ($current_gal == $gallery->getId() && (!isset($_POST['searched']))) || 
                        ($current_gal =="" && $gallery == $listGalleries[0] && (!isset($_POST['searched'])))?  
                        $class = "gal-active" : $class = "" ?>
                            <a href="index.php?section=home&gal=<?= $gallery->getId()  ?>" / 
                              class="<?=$class  ?>"><?= $gallery->getName() ?></a>
                      </li>
                      <?php } ?>
                  </ul>
                </div>
                <?php } ?>
            </nav>
            <input type="hidden" id="hidden-gallery-id" value="<?=$current_gal?>">
        </header>

<script type="text/javascript">
  
  $(".gallery-desc").tooltip();

</script>
