<?php
require_once("ressources/templates/header.php");   
?>

<container  id="gallery">
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

  <section class="gallery">
    <div class="diapo-nav clearfix">
      <div class="btn-group pull-right">
        <button data-dir="prev" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span></button>
        <button data-dir ="next" type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span>   </button>
      </div>               
    </div>
    <div id="diapo">
      <ul>
        <?php foreach ($listImages as $image) {?>
        <li>
          <img src="<?= $image->getLocation(); ?>">
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
  $("#diapo").slideshowPlugin(
  {
    'show_entire_gallery' : false,
    'diaporama_width' : 800,
    'nb_images_per_line' : 3  
  });
})

</script>
