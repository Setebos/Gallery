<?php
      require_once("ressources/templates/header.php");   
?>

        <container  id="gallery">
            <section class="categories">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="list-inline">
                            <li>
                                  <a class="cat-name cat-active" href="#">Toutes les categories</a>
                            </li>
                            <?php foreach ($listCategories as $category) {?>
                                <li>
                                    <a class="cat-name" href="#"><?= $category->getName() ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </section >

            <section class="gallery">
                <div class="row">
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-left pull-right nav-chevron"></span>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-inline" id="ajax-image">
                            <?php foreach ($listImages as $image) {?>
                                <li>
                                    <img src="<?= $image->getLocation(); ?>" style="height:150px">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-right pull-left nav-chevron"></span> 
                    </div>
                </div>
            </section >
        </container>
    </body>
</html>

<script type="text/javascript">

    $(".gallery").slideshowPlugin(
    {
        'nbPic': 4
    });

    $(document).ajaxComplete(function(){
        $(".gallery").slideshowPlugin(
        {
            'nbPic': 4
        });
    }); 



</script>
