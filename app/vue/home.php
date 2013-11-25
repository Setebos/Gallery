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
            <ul class="pull-right">
                <li>
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </li>
                <li>
                    <span class="glyphicon glyphicon-chevron-right"></span> 
                </li>
            </ul>               
        </div>
        <div class="diapo">
            <ul id="ajax-image">
                <?php foreach ($listImages as $image) {?>
                <li class="image-container">
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

$(document).bind('ready ajaxComplete', function(){

    $(".gallery").slideshowPlugin(
    {
        'nbPic': 4
    });

})


</script>
