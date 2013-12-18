<?php

	include("ressources/config.php");
	include_once("app/modele/Image.php");
	include_once("app/modele/ImageManager.php");

	$imageManager = new ImageManager($db);

  	$listTerms = $imageManager->getImagesTerms($_GET["term"]);

	echo json_encode($listTerms);

?>
