<?php
      require_once("ressources/templates/admin/header.php");    
?>

		    <div class="row height-full">
			  <div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<div class="btn btn-default pull-right">
			  			<a href="<?= "index.php?section=new_gallery "?>">Ajouter galerie</a>
			  		</div>
			  		<h3>Galeries</h3>
			 	</div>
			 	<div class="gallery-body">
			 		<?php foreach ($listGalleries as $gallery) {?>
	                    <div class="gallery-list">
	                        <div class="affichage" id="<?= "gallery" . $gallery->getId() ?>"><a href="#"><?= $gallery->getName() ?></a></div>
	                    </div>
                  	<?php } ?>
		 		</div>
			 </div>
			 <div class="col-md-9 picture-part">
			  	<div class="picture-header">
			  		<div class="btn btn-default pull-right">
			  			<a href="addPicture.php">Ajouter image</a>
			  		</div>
			  		<h3>Images</h3>
			  	</div>
			  	<div class="picture-body">
			 		<ul class="list-inline">
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    	<li class="picture-list">
                        	<div class="picture-div">
                            	<img src="http://placehold.it/250x150">
                    		</div>
                    	</li>
                    </ul>
                    <br/>
                    <ul class="list-inline">
                    	<?php foreach ($listImages as $image) {?>
	                    	<li class="picture-list">
                        		<div class="picture-div">
                        			<img src="<?= $image->getLocation() ?>">
                    			</div>
                    		</li>
                  		<?php } ?>
                    </ul>
                    <div class="testAjax">
                	</div>
			 	</div>
			 </div>
		</div>
	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>
