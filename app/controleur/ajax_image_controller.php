<?php

  session_start();
  $_SESSION=array();
  session_destroy(); 

  include("ressources/config.php");
  include_once("app/modele/Image.php");
  include_once("app/modele/ImageManager.php");

  // recup de toutes les images
  $managerImage = new ImageManager($db);

   if (isset($_POST['gal'])) {
    $listImages = $managerImage->getImagesByGallery($_POST['gal']);
  } else {
      $listImages = $managerImage->getListImages();
  }


  include_once('app/vue/home.php');



