<?php
require_once("ressources/templates/header.php");   
?>

<container  id="gallery-full">
  
  <section class="categories">
    <div class="row row-cat">
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
    <div id="dvLoading"></div>
    <?php if (empty($listImages)) {?>
      <p class="text-center"> <em>Aucune image à afficher</em> </p>
    <?php } else { ?>
      
      <div id="diapo-nav">          
      </div>
      <div id="diapo">
        <ul>
          <?php foreach ($listImages as $image) {?>
        <li>
          <?php  
              $categories = $categoryManager->getCategoriesByImage($image->getId());
              $cat_string="";
              foreach ($categories as $category) {
                $cat_string.=";".$category->getName();
                // array_push($cat_array, $category->getName());
              }
          ?>
          <img src="<?= $image->getLocationMiniature(); ?>" 
          title="<?= $image->getTitle(); ?>" data-desc="<?= $image->getDescription(); ?>" data-cat="<?= $cat_string ?>">

        </li>
        <?php }} ?>
      </ul>
    </div>
  </section >
</container>
</body>
</html>

<script type="text/javascript">


$(document).ready(function(){
  $('#dvLoading').fadeOut(500);

   var options = <?=$options_json?>;
   console.log(options.display_duration);
   options.show_entire_gallery == 0 ? options.show_entire_gallery = false : options.show_entire_gallery =true;

  $("#diapo").slideshowPlugin({
    'show_entire_gallery' : options.show_entire_gallery,
    'diaporama_width' : options.diaporama_width,
    'nb_images_per_line' : options.nb_images_per_line, 
    'displayDuration' : options.display_duration
  });

})

</script>
