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

if ($_FILES['imageUpload']['error'] > 0) {
    if($_FILES['imageUpload']['error'] == 1) {
        echo "Erreur : la taille de cette image est trop importante";
    } else {
        echo "Une erreur est survenue";
    }
} else {

    $title = htmlspecialchars($_POST['imageName']);
    $imageGallery = $_POST['imageGallery'];
    if(isset($_POST['imageDescription'])) {
        $description = htmlspecialchars($_POST['imageDescription']);
    } else {
        $description = null;
    }
    if(isset($_POST['imageCategories'])) {
        $imageCategories = $_POST['imageCategories'];
    }
    
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

    // On récupère les positions des images déjà présentes dans la galerie pour déterminer celle qu'aura l'image créée
    foreach ($listPositions as $positions) {
        $enumPositions[] =  $positions['position'];
    }

    $position = max($enumPositions) + 1;


    if (in_array($fileExtension, $validExtensions)) {
        $time = time();
        $destination = 'app/img/' . $time . '_' . $title . $fileExtension ;
        
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
            
            $resize->resizeTo(120, 120, 'precrop');

            $temp = 'app/img/temp-' . $title . $fileExtension;

            $resize->saveImage($temp); // Création d'une image temporaire aux bonnes dimensions afin de pouvoir cropper sans étirer

            $resize = new ResizeImage($temp);

            $resize->resizeTo(120, 120, "crop");

            $destinationThumbnail = 'app/img/' . $time . '_' . $title . "-thumbnail" . $fileExtension;

            $resize->saveImage($destinationThumbnail);

            unlink($temp); // Destruction de l'image temporaire servant à effectuer le crop
           
            //Création de la miniature

            $resize = new ResizeImage($destination);
            $resize->resizeTo(400, 400);

            $destinationMiniature = 'app/img/' . $time . '_' . $title . "-miniature" .$fileExtension;

            $resize->saveImage($destinationMiniature);

            //Rattachement aux catégories
            // Il faut connaitre l'id de l'image pour y ajouter des catégories, on récupère l'image ajoutée en dernier à la base
            $newImage = $imageManager->getImageByPosition($position, $gallery->getId());

            $newImage->setLocationMiniature($destinationMiniature);
            $newImage->setLocationThumbnail($destinationThumbnail);
            $imageManager->updateImage($newImage);

            if(isset($_POST['imageCategories'])) {
                foreach ($imageCategories as $imageCategory) {
                    $category = $categoryManager->getCategoryByName($imageCategory);
                    $categories = new ImageCategory(array(
                        'image_id' => $newImage->getId(),
                        'category_id' => $category->getId()
                    ));
                    $imageCategoryManager->createImageCategory($categories);
                }
            } 
            header('Location: index.php?section=admin_index'); 
        }

    } else {
        header('Location: index.php?section=admin_index');  
    }
}