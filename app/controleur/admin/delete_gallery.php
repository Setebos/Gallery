<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

if(isset($_POST["id"])) {
	$id = $_POST['id'];
}

if(isset($_GET["id"])) {
	$id = $_GET['id'];
}


$managerGallery = new GalleryManager($db);

$gallerySelect = $managerGallery->getGallery($id);
$managerGallery->deleteGallery($gallerySelect);

$listGalleries = $managerGallery->getListGalleries();
?>

<div class="gallery-body">
	<?php foreach ($listGalleries as $gallery) {?>
    <div class="gallery-list">
        <div class="affichage" id="<?= "gallery" . $gallery->getId() ?>"><a href="#"><?= $gallery->getName() ?></a></div>
        <div class="gallery-suppr-button">
        	<span class="glyphicon glyphicon-trash"></span>
        </div>
    </div>
	<?php } ?>
</div>
