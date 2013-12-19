<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Test Gallery js - Espace admin </title>
        <link rel="stylesheet" type="text/css" href="app/css/bootstrap.min.css"/> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="app/css/admin.css"/>
        <?php $IE8 = (preg_match('/msie/',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
            if ($IE8 == 1) {  ?>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
           <?php  } else { ?>
                <script type="text/javascript" src="app/js/jquery_2.0.3.min.js"></script>
            <?php } ?>
        <script type="text/javascript" src="app/js/jquery-ui_1.10.3.min.js"></script>
        <script type="text/javascript" src="app/js/bootstrap.min.js"/></script>
        <!--[if IE]>
            <script src="app/js/html5-ie.js"></script>
            <script src="app/js/html5shiv.js"></script>
            <script src="app/js/respond.js"></script>
        <![endif]-->
    </head>

    <body>
        <header>
            <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php?section=admin_index">Gallery Powa - Administration</a>
                </div>
               
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?= "index.php?section=home "?>"> Retour à la galerie</a></li>
                </ul>
            </nav>
        </header>
