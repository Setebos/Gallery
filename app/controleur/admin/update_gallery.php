<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$id = $_POST["id"];
$originalName = $_POST['originalName'];
if(isset($_POST["galleryName"])) {
	$name = htmlspecialchars($_POST["galleryName"]);
}
if(isset($_POST["galleryDescription"])) {
	$description = $_POST["galleryDescription"];
}

$managerGallery = new GalleryManager($db);

$existe = false;

$galleryNames = $managerGallery->getGalleryNames();

foreach ($galleryNames as $galleryName) { //Le nom de galerie doit être unique
	if($name == $galleryName['name'] && $name != $originalName) {
		$existe = true;
	}
}

if($existe == false) {
	$newGallery = new Gallery(array(
		'id' => $id,
		'name' => $name,
		'description' =>$description
	));

	$gallery = $managerGallery->getGallery($id);
	$gallery = $managerGallery->updateGallery($newGallery);

	header('Location: index.php?section=admin_index');  
} else {
	header('Location: index.php?section=admin_index');  
}



