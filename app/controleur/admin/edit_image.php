<?php

include_once("app/modele/ImageManager.php");
include_once("app/modele/Image.php");

$imageManager = new ImageManager($db);

$id = $_GET["id"];

$image = $imageManager->getImage($id);

include_once('app/vue/admin/edit_image.php');