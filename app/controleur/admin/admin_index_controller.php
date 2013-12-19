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

// recup des options, forcement d'id = 1;
$managerOption = new OptionManager($db);
$option = $managerOption->getOption(1);

// recup de toutes les galeries
$managerGallery = new GalleryManager($db);
$managerImage = new ImageManager($db);
$managerCategory = new CategoryManager($db);
$listGalleries = $managerGallery->getListGalleries();
$listCategories = $managerCategory->getListCategories();

if($listGalleries != null) {
	$vide = false;
	$gallerySelect = $listGalleries[0]->getName();
	$listImages = $managerImage->getImagesByGallery($listGalleries[0]->getId());

	$listFirstImages = array();

	foreach ($listGalleries as $gallery) {
		$id = $gallery->getId();
		$listFirstImages[$id] = $managerImage->getFirstImageByGallery($id);
	}
} else {
	$vide = true;
}



include_once('app/vue/admin/index.php');
