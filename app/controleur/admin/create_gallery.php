<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$name = $_POST['galleryName'];
$description = $_POST['galleryDescription'];

$newGallery = new Gallery(array(
	'id' => null,
	'name' => $name,
	'description' =>$description
));

$manager = new GalleryManager($db);

$manager->createGallery($newGallery);

include_once('app/controleur/admin/admin_index_controller.php');

