<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");
include_once("app/modele/ImageCategoryManager.php");
include_once("app/modele/ImageCategory.php");

if ($_FILES['imageUpload']['error'] > 0) {
    echo "Error: " . $_FILES['imageUpload']['error'] . "<br />";
} else {
    $title = $_POST['imageName'];
    $imageGallery = $_POST['imageGallery'];
    $description = $_POST['imageDescription'];
    $imageCategories = $_POST['imageCategories'];
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.bmp');
    $fileName = strstr($_FILES['imageUpload']['name'], ".", true);
    $fileExtension = strstr($_FILES['imageUpload']['name'], ".");
    $fileExtension = strtolower($fileExtension);

    $imageManager = new ImageManager($db);
    $galleryManager = new GalleryManager($db);
    $categoryManager = new CategoryManager($db);
    $imageCategoryManager = new ImageCategoryManager($db);

    $gallery = $galleryManager->getGalleryByName($imageGallery);
    $listPositions = $imageManager->getPositions($gallery->getId());

    foreach ($listPositions as $positions) {
        $enumPositions[] =  $positions['position'];
    }

    $position = max($enumPositions) + 1;


    if (in_array($fileExtension, $validExtensions)) {
        $destination = 'app/img/' . time() . '_' . $title . $fileExtension ;
        
        if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $destination)) {
            $newImage = new Image(array(
                'id' => null,
                'title' => $title,
                'description' => $description,
                'location' => $destination,
                'position' => $position,
                'gallery_id' => $gallery->getId()
            ));

            $imageManager->createImage($newImage);
            $newImage = $imageManager->getImageByPosition($position, $gallery->getId());

            foreach ($imageCategories as $imageCategory) {
                $category = $categoryManager->getCategoryByName($imageCategory);
                $categories = new ImageCategory(array(
                    'image_id' => $newImage->getId(),
                    'category_id' => $category->getId()
                ));
                $imageCategoryManager->createImageCategory($categories);
            }
            header('Location: index.php?section=admin_index');  
        }

    } else {
        header('Location: index.php?section=admin_index');  
    }
}