<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

$action = $_POST['action'];
if(isset($_POST['galleryName'])) {
	$galleryName = $_POST['galleryName'];
}
if(isset($_POST['categoryName'])) {
	$categoryName = $_POST['categoryName'];
}

$galleryManager = new GalleryManager($db);
$categoryManager = new CategoryManager($db);

$listGalleries = $galleryManager->getGalleryNames();
$listCategories = $categoryManager->getCategoryNames();

function galleryNameTaken($galleryName, $listGalleries) {
	foreach ($listGalleries as $gallery) {
		if ($gallery['name'] == $galleryName) {
			return true;
		}
	}
}

function categoryNameTaken($categoryName, $listGalleries) {
	foreach ($listCategories as $category) {
		if ($category['name'] == $categoryName) {
			return true;
		}
	}
}

function checkGalleryName($galleryName, $listGalleries) {
	$response = array();

	if(!$galleryName) {
		$response = array(
			'ok' => false, 
	    	'msg' => "Veuillez entrer un nom de galerie"
    	);
	} elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $galleryName)) {
		$response = array(
      		'ok' => false, 
      		'msg' => "Le nom de la galerie ne doit contenir que des caractères alphanumériques"
      	);
	} elseif (galleryNameTaken($galleryName, $listGalleries)) {
		$response = array(
      		'ok' => false, 
      		'msg' => "Ce nom est déjà utilisé"
      	);
	} else {
		$response = array(
	      	'ok' => true, 
	      	'msg' => "Ce nom est libre"
      	);
	}

	return $response;
}

function checkCategoryName() {

}

if ($action == "checkGallery") {
	echo json_encode(checkGalleryName($galleryName, $listGalleries));
    exit;
} elseif ($action == "checkCategory") {
	echo json_encode(checkCategoryName($categoryName, $listCategories));
    exit;
}