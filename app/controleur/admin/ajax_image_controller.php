<?php

include_once("ressources/config.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/GalleryManager.php");
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");
include_once("app/modele/Category.php");
include_once("app/modele/CategoryManager.php");

if(isset($_POST["id"])) {
	$id = $_POST["id"];
}

$managerCategory = new CategoryManager($db);
$managerGallery = new GalleryManager($db);
$managerImage = new ImageManager($db);
$listCategories = $managerCategory->getListCategories();
$listGalleries = $managerGallery->getListGalleries();
$listImages = $managerImage->getImagesByGallery($id);


if($listGalleries != null) {
	$gallerySelect = $managerGallery->getGallery($id)->getName();
	$vide = false;
} else {
	$vide = true;
}

?>



<div class="picture-header">
	<div class="btn-admin pull-left"  title="Ajouter une image à la galerie">
		<a href="<?= "index.php?section=new_image "?>">+</a>
	</div>
	<ul>
		<li>
			<a href="#" id="new-cat-btn"><p>Editer les catégories</p></a>
		</li>
	</ul>
	<h3>Images 
		<?php if($vide == false) { 
			echo  " - ".$gallerySelect;
		} ?>
	</h3>
</div>
<div class="picture-header-option-part">
	<div class="new-cat">
		<div class="row">
			<div class="col-md-8">
				<h4> Catégories existantes </h4>
				<ul class="list-inline">
					<?php foreach ($listCategories as $category) {?>
					<li class="cat-label">
						<p id="<?= "cat" . $category->getId() ?>" class="cat-name cat-active"><?= $category->getName() ?></p>
						<span id="<?= "del-cat" . $category->getId() ?>" class="span-del-cat">
							X
						</span>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-md-3 well ">
				<form class="form-inline" role="form">
					<p> Ajouter une catégorie </p>
					<div class="form-group">
						<input class="categoryName"  class="form-control" placeholder="Nom de la catégorie">
					</div>
					<button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
					<br/><span class="validateCategoryName"></span>
				</form>
			</div>
		</div>
	</div>	
</div>
<div class="picture-body">
	<div class="conteneur-images">
		<?php if($vide == false) { ?>
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
		<?php } ?>
	</div>
</div>