<?php

	include("ressources/config.php");
	include_once("app/modele/Image.php");
	include_once("app/modele/ImageManager.php");

// var_dump(dirname(__FILE__));
// $term = $_GET["term"];

	$imageManager = new ImageManager($db);

  	$listTerms = $imageManager->getImagesTerms($_GET["term"]);

  	// var_dump(json_encode($listTerms));

	echo json_encode($listTerms);

?>
