<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

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

    $gallery = $galleryManager->getGalleryByName($imageGallery);
    $listPositions = $imageManager->getPositions($gallery->getId());

    foreach ($listPositions as $positions) {
        $enumPositions[] =  $positions['position'];
    }

    $position = max($enumPositions) + 1;


    if (in_array($fileExtension, $validExtensions)) {
        /*$destination = 'app/img/' . time() . '_' . $title . $fileExtension ;
        
        if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $destination)) {
            $newImage = new Image(array(
                'id' => null,
                'title' => $title,
                'description' => $description,
                'location' => $destination,
                'position' => $position,
                'gallery_id' => $gallery->getId()
            ));
            $manager = new ImageManager($db);
            $manager->createImage($newImage);
            header('Location: index.php?section=admin_index');  
        }*/

        var_dump($imageCategories);
    } else {
        header('Location: index.php?section=admin_index');  
    }
}