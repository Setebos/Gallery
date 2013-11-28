<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$id = $_POST["id"];
$name = $_POST["galleryName"];
$description = $_POST["galleryDescription"];

$newGallery = new Gallery(array(
	'id' => $id,
	'name' => $name,
	'description' =>$description
));

$managerGallery = new GalleryManager($db);
$gallery = $managerGallery->getGallery($id);
$gallery = $managerGallery->updateGallery($newGallery);

/*include_once('app/controleur/admin/admin_index_controller.php');*/
header('Location: index.php?section=admin_index');  

