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

            <section>
                <div class="row">
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-left pull-right"></span>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-inline" id="ajax-image">
                            <?php foreach ($listImages as $image) {?>
                                <li>
                                    <img src="<?= $image->getLocation(); ?>" style="width:200px">
                                </li>
                            <?php } ?>
                           
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-right pull-left"></span> 
                    </div>
                </div>
            </section >
        </container>
    </body>
</html>

<script type="text/javascript">

     // console.log(jsonList);
    /*$("#gallery").slideshowPlugin(
    {
        'nbPic': 4
    });*/




</script>
