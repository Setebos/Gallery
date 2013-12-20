<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

if(isset($_POST["id"])) {
	$id = $_POST['id'];
}

$imageManager = new ImageManager($db);
$galleryManager = new GalleryManager($db);

$image = $imageManager->getImage($id);
$gallery = $galleryManager->getGallery($image->getGalleryId());
$gallerySelect = $gallery->getName();
$position = $image->getPosition();

$imageManager->deleteImage($image);

$listImages = $imageManager->getImagesByGallery($image->getGalleryId());

foreach ($listImages as $img) {
	//On ajuste la position des images de l'ancienne galerie
	if($img->getPosition() > $position) {
		$img->setPosition($img->getPosition() - 1);
		$imageManager->updateImage($img);
	}
}

?>

<h3 class="gallery-title"><?= $gallerySelect ?></h3>
<p>Faites glisser et déposez les miniatures pour changer l'ordre d'affichage des images</p>
<p class="help-block">Cliquez sur une image pour la modifier.</p>
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