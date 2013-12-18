<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

$id = $_GET["id"];

$galleryManager = new GalleryManager($db);
$categoryManager = new CategoryManager($db);
$imageManager = new ImageManager($db);

$listGalleries = $galleryManager->getGalleryNames();
$listCategories = $categoryManager->getListCategories();
$image = $imageManager->getImage($id);
$gallery = $image->getGalleryId();
$gallery = $galleryManager->getGallery($gallery);
$galleryName = $gallery->getName();
$categories = $categoryManager->getCategoriesByImage($id);

// $test = "Confirmez-vous la suppression de l'image ? test";


include_once('app/vue/admin/edit_image_modal.php');
// include_once('app/vue/admin/edit_image.php');