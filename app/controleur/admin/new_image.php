<?php
    require_once("ressources/templates/admin/header.php");
    include_once("app/modele/GalleryManager.php");
	include_once("app/modele/Gallery.php");
	include_once("app/modele/CategoryManager.php");
	include_once("app/modele/Category.php");
    $galleryManager = new GalleryManager($db);
    $categoryManager = new CategoryManager($db);
    $listGalleries = $galleryManager->getGalleryNames();
    $listCategories = $categoryManager->getListCategories();




include_once('app/vue/admin/new_image.php');