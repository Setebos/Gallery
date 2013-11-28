<?php

/*include("../../../ressources/config.php");
include_once("../..//modele/Gallery.php");
include_once("../..//modele/GalleryManager.php");
include_once("../..//modele/ImageManager.php");
include_once("../..//modele/Image.php");

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

try {
     $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"], $options);
  }
  catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
  }*/

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
<div id="<?= "delete-gallery" . $id ?>" class="btn btn-default pull-right gallery-delete-button">
	<a href="#">Supprimer galerie</a>
</div>
<div id="<?= "edit-gallery" . $id ?>" class="btn btn-default pull-right gallery-edit-button">
	<a href="<?= "index.php?section=edit_gallery&id=".$id ?>">Modifier galerie</a>
</div>
<ul class="list-inline testAjax">
	<?php foreach ($listImages as $image) {?>
		<li class="picture-list">
			<div class="picture-div">
				<img src="<?= $image->getLocation() ?>">
			</div>
		</li>
	<?php } ?>
</ul>