<?php

  session_start();
  $_SESSION=array();
  session_destroy(); 

  include("ressources/config.php");
  include_once("app/modele/Image.php");
  include_once("app/modele/ImageManager.php");

  // recup de toutes les images
  $managerImage = new ImageManager($db);

   if (isset($_POST['idGallery'])) {
    $listImages = $managerImage->getImagesByGallery($_POST['idGallery']);
  } else {
      $listImages = $managerImage->getListImages();
  }

  ?>


<?php 
if(empty($listImages)){ ?>

  <div>
    <p> Aucune image dans cette galerie </p>
  </div>

<?php } else {
  foreach ($listImages as $image) { ?>

    <li>
        <img src="<?= $image->getLocation(); ?>" style="height:150px">
    </li>

<?php } }?>
