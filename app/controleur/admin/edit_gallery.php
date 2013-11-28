<?php

include_once("app/modele/GalleryManager.php");
include_once("app/modele/Gallery.php");

$id = $_GET["id"];

$managerGallery = new GalleryManager($db);
$gallery = $managerGallery->getGallery($id);

include_once('app/vue/admin/edit_gallery.php');
