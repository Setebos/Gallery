<?php 

include 'Image.php';
include 'ImageManager.php';

$id = $_POST["id"];


include("../../ressources/config.php");
try {
   $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
}
catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
}

$manager = new ImageManager($db);

$listImages = $manager->getImagesByGallery($id);
var_dump($listImages);

