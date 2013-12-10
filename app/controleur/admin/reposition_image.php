<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

$imageManager = new ImageManager($db);

if ( count($_POST) && is_array($_POST['item']) ) {


	foreach ( $_POST['item'] as $key => $val ) {
		$key = $key + 1;
		$image = $imageManager->getImage($val);

		if($image->getPosition() != $key) {
			$image->setPosition($key);
			$imageManager->updateImage($image);
		}
	}
}