<?php

  session_start();
  $_SESSION=array();
  session_destroy(); 

  include("ressources/config.php");
  include_once("app/modele/Gallery.php");
  include_once("app/modele/GalleryManager.php");
  include_once("app/modele/Category.php");
  include_once("app/modele/CategoryManager.php");
  include_once("app/modele/Image.php");
  include_once("app/modele/ImageManager.php");
  include_once("app/modele/OptionManager.php");
  include_once("app/modele/Option.php");

  // recup de toutes les galeries
  $galleryManager = new GalleryManager($db);
  $listGalleries = $galleryManager->getListGalleries();

  // recup de toutes les categories
  $categoryManager = new CategoryManager($db);
  $listCategories = $categoryManager->getListCategories();

  // recup de toutes les images
  $imageManager = new ImageManager($db);

  $current_gal = $listGalleries[0]->getId();

  $optionManager = new OptionManager($db);
  $options_json = $optionManager->getOption_json(1);

      if  (isset($_GET['section']) AND $_GET['section'] == 'login') {                    
          include_once("app/vue/login.php");
      // gestion  des filtres categories en jquery + ajax : retour d'un tableau json avec src des images à afficher
      } elseif (isset($_POST['catActiveIds'])) {
             $response = array();

            if(isset($_POST['gal'])) {
                $current_gal = $_POST['gal'];
                $listImages = $imageManager->getImagesByCategoriesAndGallery($_POST['catActiveIds'], $_POST['gal']);
            }else{
                $current_gal = $listGalleries[0]->getId();
                $listImages = $imageManager->getImagesByCategoriesAndGallery($_POST['catActiveIds'], $listGalleries[0]->getId());
            }

            foreach ($listImages as $img) {
                // $donnees_array['src'] = $img->getLocationMiniature();
                array_push($response, $img->getLocationMiniature());
            }
            echo json_encode($response);
            
       // sinon, rechargement de la page   
      }else{
          if (isset($_POST['searched'])) {
              $current_gal = '0';
              $listImages = $imageManager->getImagesByResearch($_POST['searched']);
          } elseif (isset($_GET['gal'])) {
              $current_gal = $_GET['gal'];
              $listImages = $imageManager->getImagesByGallery($_GET['gal']);
          } else {
              $listImages = $imageManager->getImagesByGallery($listGalleries[0]->getId());
          }

          include_once('app/vue/home.php');
      }


  

