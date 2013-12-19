<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$name = htmlspecialchars($_POST['galleryName']);
if(isset($_POST['galleryDescription'])) {
	$description = htmlspecialchars($_POST['galleryDescription']);
} else {
	$description = null;
}

$manager = new GalleryManager($db);

$galleryNames = $manager->getGalleryNames();

$existe = false;

foreach ($galleryNames as $galleryName) { //Le nom de galerie doit être unique
	if(trim(strtolower($name)) == trim(strtolower($galleryName['name']))) {
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


