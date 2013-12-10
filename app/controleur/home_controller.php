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

  // recup de toutes les galeries
  $galleryManager = new GalleryManager($db);
  $listGalleries = $galleryManager->getListGalleries();

  // recup de toutes les categories
  $categoryManager = new CategoryManager($db);
  $listCategories = $categoryManager->getListCategories();

  // recup de toutes les images
  $imageManager = new ImageManager($db);
   // var_dump(isset($_POST['catActiveIds']));
   // var_dump(isset($_POST['gal']));
  // if (isset($_POST['catActiveIds'])) {
  //   $listImages = $imageManager->getImagesByCategories($_POST['catActiveIds']);
  // } else
  $current_gal = "";

  if (isset($_POST['searched'])) {
        // var_dump("searched");
        $listImages = $imageManager->getImagesByResearch($_POST['searched']);
  } elseif (isset($_POST['gal']) && isset($_POST['catActiveIds'])) {
       // var_dump("gal + cat");
        $current_gal = $_POST['gal'];
       $listImages = $imageManager->getImagesByCategoriesAndGallery($_POST['catActiveIds'], $_POST['gal']);
  } elseif (isset($_GET['gal'])) {
       // var_dump("gal");
        $current_gal = $_GET['gal'];
       $listImages = $imageManager->getImagesByGallery($_GET['gal']);
  } else {
        // var_dump("nothing");
        $listImages = $imageManager->getImagesByGallery($listGalleries[0]->getId());
  }
  // var_dump($listImages);
  // var_dump($current_gal );


  include_once('app/vue/home.php');

