<?php
require_once("ressources/templates/header.php");   
?>

<container  id="gallery-full">
  <section class="categories">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <ul class="list-inline">
            <li>
              <a  id="all-cat" class="cat-name cat-active">Toutes catégories</a>
            </li>
          </ul> 
          <ul class="list-inline cat-bdd">
            <?php foreach ($listCategories as $category) {?>
            <li>
              <a href="#" id="<?= "cat" . $category->getId() ?>" class="cat-name"><?= $category->getName() ?></a>
            </li>
            <?php } ?>
          </ul>
      </div>
    </div>
  </section >

  <section id="gallery">
    <?php if (empty($listImages)) {?>
      <p class="text-center"> <em>Aucune image à afficher</em> </p>
    <?php } else { ?>
      
      <div id="diapo-nav">          
      </div>
      <div id="diapo">
        <ul>
          <?php foreach ($listImages as $image) {?>
        <li>
          <img src="<?= $image->getLocationMiniature(); ?>" 
          title="<?= $image->getTitle(); ?>" data-desc="<?= $image->getDescription(); ?>">
        </li>
        <?php }} ?>
      </ul>
    </div>
  </section >
</container>
</body>
</html>

<script type="text/javascript">

// var ajaxFired= false

$(document).ready(function(){

        


  $("#diapo").slideshowPlugin({
    'show_entire_gallery' : false,
    'diaporama_width' : 1000,
    'nb_images_per_line' : 3, 
    'displayDuration' : 2000
  });



})

</script>
