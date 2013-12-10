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

 if (isset($_POST['searched'])) {
    $listImages = $imageManager->getImagesByResearch($_POST['searched']);
  } elseif (isset($_GET['gal'])) {
    $listImages = $imageManager->getImagesByGallery($_GET['gal']);
  } else {
    $listImages = $imageManager->getImagesByGallery($listGalleries[0]->getId());
  }

  include_once('app/vue/home.php');

