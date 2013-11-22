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
include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

if(isset($_POST["id"])) {
	$id = $_POST["id"];
}

$managerImage = new ImageManager($db);
$listImages = $managerImage->getImagesByGallery($id);

?>

<ul class="list-inline testAjax">
	<?php foreach ($listImages as $image) {?>
		<li class="picture-list">
			<div class="picture-div">
				<img src="<?= $image->getLocation() ?>">
			</div>
		</li>
	<?php } ?>
</ul>