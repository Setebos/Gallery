<?php

include("ressources/config.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

if(isset($_POST["id"])) {
	$id = $_POST["id"];
}

$managerGallery = new GalleryManager($db);
$gallerySelect = $managerGallery->getGallery($id)->getName();
$managerImage = new ImageManager($db);
$listImages = $managerImage->getImagesByGallery($id);
?>

<h3 class="gallery-title"><?= $gallerySelect ?></h3>
<p>Faites glisser et déposez les miniatures pour changer l'ordre d'affichage des images</p>
<ul class="list-inline sortable">
	<?php foreach ($listImages as $image) {?>
		<li id="<?= "item-".$image->getId() ?>" class="picture-list">
			<span class="roll"></span>
			<div class="picture-div">
				<img id="<?= "image-".$image->getId() ?>" src="<?= $image->getLocationThumbnail() ?>">
			</div>
		</li>
	<?php } ?>
</ul>