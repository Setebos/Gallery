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

// Texte pour la bulle de confirmation de suppression de catégorie
$confirmText = 'Confirmez-vous la suppression de l\'image ?<br>';
$confirmText .= '<div class=\'pull-right\'><a class=\'del-img-dialog\' href='.'index.php?section=admin_index'.'>Annuler</a>';
$confirmText .= '<button class=\'btn btn-danger btn-sm del-img-dialog del-img-confirm\'><span>Confirmer</span></button></div>';


include_once('app/vue/admin/edit_image_modal.php');
