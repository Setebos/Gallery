<?php

include("ressources/config.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

// recup de toutes les galeries
$managerGallery = new GalleryManager($db);
$managerImage = new ImageManager($db);
$listGalleries = $managerGallery->getListGalleries();
$listImages = $managerImage->getListImages();


include_once('app/vue/admin/index.php');