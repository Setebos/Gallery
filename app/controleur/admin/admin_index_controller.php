<?php

include("ressources/config.php");
include_once("app/modele/Gallery.php");
include_once("app/modele/GalleryManager.php");

// recup de toutes les galeries
$managerGallery = new GalleryManager($db);
$listGalleries = $managerGallery->getListGalleries();

include_once('app/vue/admin/index.php');