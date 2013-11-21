<?php

  session_start();
  $_SESSION=array();
  session_destroy(); 

  include("ressources/config.php");
  include_once("app/modele/Gallery.php");
  include_once("app/modele/GalleryManager.php");
  include_once("app/modele/Category.php");
  include_once("app/modele/CategoryManager.php");

  // recup de toutes les galeries
  $managerGallery = new GalleryManager($db);
  $listGalleries = $managerGallery->getListGalleries();

  // recup de toutes les categories
  $managerCategory = new CategoryManager($db);
  $listCategories = $managerCategory->getListCategories();
  $listCategories_json = $managerCategory->getListCategories_json();

  include_once('app/vue/home.php');

