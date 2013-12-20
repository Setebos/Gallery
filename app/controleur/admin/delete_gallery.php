<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

if(isset($_POST["id"])) {
	$id = $_POST['id'];
}

if(isset($_GET["id"])) {
	$id = $_GET['id'];
}

$managerGallery = new GalleryManager($db);
$managerImage = new ImageManager($db);

$gallerySelect = $managerGallery->getGallery($id);
$managerGallery->deleteGallery($gallerySelect);

$listGalleries = $managerGallery->getListGalleries();

$listFirstImages = array();

foreach ($listGalleries as $gallery) { //Récupération des images pour les miniatures identifiant les galeries
    $id = $gallery->getId();
    $listFirstImages[$id] = $managerImage->getFirstImageByGallery($id);
}


?>

<div class="gallery-body">
    <?php foreach ($listGalleries as $gallery) {?>
        <div class="gal-vign-container"  id="<?= "gallery" . $gallery->getId() ?>">
                <div class="gal-vign-picture">
                     <?php if ($listFirstImages[$gallery->getId()] != null) {?>
                        <img src="<?= $listFirstImages[$gallery->getId()]->getLocationThumbnail() ?>">
                    <?php } else { ?>
                    <img src="http://placehold.it/120&text=pic">
                    <?php } ?>
                </div>
                <div class="gal-vign-detail">
                    <a href="#"><p><?= $gallery->getName() ?></p></a>
                    <button class="btn btn-default btn-xsm gal-suppr-btn">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <a href="<?= "index.php?section=edit_gallery&id=".$gallery->getId() ?>">
                        <button id="<?= "edit-gallery" . $gallery->getId() ?>" class="btn btn-default btn-xsm gallery-edit-button">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
            </a>        
               </div>
        </div>
    <?php } ?>
</div>
