<?php

  session_start();
  $_SESSION=array();
  session_destroy(); 

  include("ressources/config.php");
  include_once("app/modele/Gallery.php");
  include_once("app/modele/GalleryManager.php");
  include_once("app/modele/Category.php");
  include_once("app/modele/CategoryManager.php");
  include_once("app/modele/Image.php");
  include_once("app/modele/ImageManager.php");



    // var_dump($_GET['gal']);
    // echo($_GET['gal']);

  // recup de toutes les galeries
  $managerGallery = new GalleryManager($db);
  $listGalleries = $managerGallery->getListGalleries();
  // $listGalleries_json = json_encode($managerGallery->getListGalleries());

  // recup de toutes les categories
  $managerCategory = new CategoryManager($db);
  $listCategories = $managerCategory->getListCategories();
  // $listCategories_json = json_encode($managerCategory->getListCategories());

  // recup de toutes les images
  $managerImage = new ImageManager($db);

   if (isset($_GET['gal'])) {
    $listImages = $managerImage->getImagesByGallery($_GET['gal']);
  } else {
      $listImages = $managerImage->getListImages();
  }

  include_once('app/vue/home.php');

