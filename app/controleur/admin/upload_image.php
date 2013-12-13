<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");
include_once("app/modele/ImageCategoryManager.php");
include_once("app/modele/ImageCategory.php");
include_once("app/modele/ResizeImage.php");
include_once("app/modele/ImageManipulator.php");

if ($_FILES['imageUpload']['error'] > 0) {
    echo "Error: " . $_FILES['imageUpload']['error'] . "<br />";
} else {
    $title = $_POST['imageName'];
    $imageGallery = $_POST['imageGallery'];
    $description = $_POST['imageDescription'];
    $imageCategories = $_POST['imageCategories'];
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
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
        //$manipulator = new ImageManipulator($_FILES['imageUpload']['tmp_name']);
        
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

            //Création du thumbnail admin

            $resize = new ResizeImage($destination);
            
            $resize->resizeTo(120, 120, "crop");
            // var_dump($resize);

            // $width  = $resize->getWidth();
            // $height = $resize->getHeight();

            // if($width == 120) {

            // } elseif ($height == 120) {
            //     $centreX = round($width / 2);
            //     $x1 = $centreX - 60;
            //     $x2 = $centreX + 60;
            //     $y1 = 
            // }

            //$resize->cropTo($x1, $y1, $x2, $y2);

            $destinationAdmin = 'app/img/' . time() . '_' . $title . "-thumbnail-admin" . $fileExtension;

            $resize->saveImage($destinationAdmin);

            

            // if($fileExtension == ".jpg" || $fileExtension == ".jpeg") {
            //     $manipulator->save($destinationAdmin);
            // } elseif ($fileExtension == ".gif") {
            //     $manipulator->save($destinationAdmin, IMAGETYPE_GIF);
            // } 
            // elseif ($fileExtension == ".png") {
            //     $manipulator->save($destinationAdmin, IMAGETYPE_PNG);
            // } 
           

            //Création du thumnail public

            $resize = new ResizeImage($destination);
            $resize->resizeTo(400, 400);

            $destinationThumbnail = 'app/img/' . time() . '_' . $title . "-thumbnail-public" .$fileExtension;

            $resize->saveImage($destinationThumbnail);

            //Rattachement aux catégories

            $newImage = $imageManager->getImageByPosition($position, $gallery->getId());

            $newImage->setLocationAdmin($destinationAdmin);
            $newImage->setLocationThumbnail($destinationThumbnail);
            //var_dump($newImage);
            $imageManager->updateImage($newImage);


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