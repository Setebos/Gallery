<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/ImageCategoryManager.php");
include_once("app/modele/ImageCategory.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

$id = $_POST["id"];
$title = $_POST["imageName"];
$imageGallery = $_POST["imageGallery"];
$description = $_POST["imageDescription"];
$imageCategories = $_POST['imageCategories'];

$imageManager = new ImageManager($db);
$imageCategoryManager = new ImageCategoryManager($db);
$categoryManager = new CategoryManager($db);
$galleryManager = new GalleryManager($db);

$image = $imageManager->getImage($id);
$position = $image->getPosition();
$gallery = $galleryManager->getGalleryByName($imageGallery);

//Gérer la position en cas de changement de galerie
if($image->getGalleryId() != $gallery->getId()) {
	$listPositions = $imageManager->getPositions($gallery->getId());

	foreach ($listPositions as $positions) {
	    $enumPositions[] =  $positions['position'];
	}

	$oldPosition = $position;
	//L'image qui a changé de galerie prend la dernière position
	$position = max($enumPositions) + 1;

	$images = $imageManager->getImagesByGallery($image->getGalleryId());

	foreach ($images as $img) {
		//On ajuste la position des images de l'ancienne galerie
		if($img->getPosition() > $oldPosition) {
			$img->setPosition($img->getPosition() - 1);
			$imageManager->updateImage($img);
		}
	}
}


$updateImage = new Image(array(
	'id' => $id,
    'title' => $title,
    'description' => $description,
    'location' => $image->getLocation(),
    'position' => $position,
    'gallery_id' => $gallery->getId()
));

$imageManager->updateImage($updateImage);

$imageCategoryManager->deleteImageCategories($id);

foreach ($imageCategories as $imageCategory) {
    $category = $categoryManager->getCategoryByName($imageCategory);
    $categories = new ImageCategory(array(
        'image_id' => $id,
        'category_id' => $category->getId()
    ));
    $imageCategoryManager->createImageCategory($categories);
}

header('Location: index.php?section=admin_index');