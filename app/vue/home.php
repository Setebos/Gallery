<?php
      require_once("ressources/templates/header.php");   
      var_dump($listCategories_json)
?>

        <container>
            <section class="categories">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="list-inline">
                            <li>
                                  <a href="#">Category</a>
                            </li>
                            <li>
                                  <a href="#"> <span class="badge">Category active</span></a>
                            </li>
                            <li>
                                  <a href="#">Category</a>
                            </li>
                            <li>
                                  <a href="#">Category</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section >

            <section id="gallery">
                <div class="row">
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-left pull-right"></span>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-inline">
                            <li>
                                  <img src="http://placehold.it/250x150">
                            </li>
                            <li>
                                  <img src="http://placehold.it/250x150">
                            </li>
                            <li>
                                  <img src="http://placehold.it/250x150">
                            </li>
                            <li>
                                  <img src="http://placehold.it/250x150">
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <span class="glyphicon glyphicon-chevron-right pull-left"></span> 
                    </div>
                </div>
            </section >

            <section id="gallery-test">
            </section>
        </container>
    </body>
</html>

<script type="text/javascript">
    
     var jsonList = <?=$listCategories_json?>;
     // console.log(jsonList);
    $("#gallery-test").slideshowPlugin(
    {
        'nbPic': 4,
        'data' : <?=$listCategories_json?>
    });
</script>
