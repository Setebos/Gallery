<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$name = $_POST['galleryName'];
$description = $_POST['galleryDescription'];

$manager = new GalleryManager($db);

$galleryNames = $manager->getGalleryNames();

$existe = false;

foreach ($galleryNames as $galleryName) {
	if($name == $galleryName['name']) {
		$existe = true;
	}
}


if($existe == false) {
	$newGallery = new Gallery(array(
		'id' => null,
		'name' => $name,
		'description' =>$description
	));

	$manager->createGallery($newGallery);

	header('Location: index.php?section=admin_index');  
} else {
	header('Location: index.php?section=admin_index');  
}


