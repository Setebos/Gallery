<?php

include("ressources/config.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/Category.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/OptionManager.php");
include_once("app/modele/Option.php");

$managerOption = new OptionManager($db);
$option = $managerOption->getOption(1);

// recup de toutes les galeries
$managerGallery = new GalleryManager($db);
$managerImage = new ImageManager($db);
$managerCategory = new CategoryManager($db);
$listGalleries = $managerGallery->getListGalleries();
$listImages = $managerImage->getListImages();
$listCategories = $managerCategory->getListCategories();

$listFirstImages = array();

foreach ($listGalleries as $gallery) {
	$id = $gallery->getId();
	$listFirstImages[$id] = $managerImage->getFirstImageByGallery($id);
}


include_once('app/vue/admin/index.php');
