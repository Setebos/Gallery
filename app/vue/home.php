<?php
require_once("ressources/templates/header.php");   
?>

<container  id="gallery-full">
  <section class="categories">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div><p class="intertitre">Catégories</p></div>
        <ul class="list-inline">
          <?php foreach ($listCategories as $category) {?>
          <li>
            <a class="cat-name cat-active" href="#"><?= $category->getName() ?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section >

  <section id="gallery">
    <div id="diapo-nav">          
    </div>
    <div id="diapo">
      <ul>
        <?php foreach ($listImages as $image) {?>
        <li>
          <img src="<?= $image->getLocation(); ?>" 
          title="<?= $image->getTitle(); ?>" data-desc="<?= $image->getDescription(); ?>">
        </li>
        <?php } ?>
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
    'diaporama_width' : 800,
    'nb_images_per_line' : 2, 
    'displayDuration' : 4000
  });
})

</script>
