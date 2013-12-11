<?php
require_once("ressources/templates/admin/header.php");   
?>

		<div class="row height-full">
		  	<div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<div class="btn btn-default  pull-right">
			  			<a href="<?= "index.php?section=new_gallery "?>">Ajouter galerie</a>
			  		</div>
			  		<h3>Galeries</h3>
			 	</div>
			 </div>
			 <div class="col-md-9 upload-image-form-part">
			  	<div class="upload-image-form-header">
			  		<h3>Nouvelle image</h3>
			  	</div>
			  	<div class="upload-image-form-body">
			  		<div class="well">
	                    <form class="upload-image-align" enctype="multipart/form-data" method="post" action="<?= "index.php?section=upload_image"?>" role="form">
	                        <div class="form-group">
	                            <label name="imageName">Titre de l'image : </label>
	                            <input type="text" name="imageName" value="<?= $image->getTitle() ?>"/>
	                        </div>
	                        <div class="form-group">
	                            <label name="imageGallery">Galerie : </label>
	                            <select name="imageGallery">
	                            	<?php foreach ($listGalleries as $galleries) {
	                            		if ($galleries['name'] == $galleryName) {
	                            			echo ('<option selected="selected">' . $galleries['name'] . '</option>');
	                            		} else {
	                            			echo ('<option>' . $galleries['name'] . '</option>');
	                            		}
	                            	}?>
                            	</select>
	                        </div>
	                        <div class="form-group">
	                            <label name="imageDescription">Description : </label>
	                            <textarea cols="45" rows="4" name="imageDescription"><?= $image->getDescription() ?></textarea>
	                        </div>
						    <div class="form-group list-categories">
					        	<label name="imageCategories">Choisissez des catégories : </label>
					        	<?php foreach ($listCategories as $category) {
					        		?>
                            		<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
                            	<?php } ?>
						    </div>
						    <div class="btn btn-default col-md-offset-4 upload-image-new-category">
						    	<a href="#">Ajouter catégorie</a>
						    </div>
	                        <div class="col-md-offset-4">
		                        <div class= "upload-image-cancel">
	                        		<a href="<?= "index.php?section=admin_index "?>">Annuler</a>
	                        	</div>
	                        	<div class="upload-image-valid">
		                        	<button type="submit" class="btn btn-default">Créer</button>
		                        </div>
	                    	</div>
	                    </form>
	                    <div class="new-category">
					    	<form class="new-category-align" method="post" action="#" role="form">
								<div class="new-category-valid">
									<label name="categoryName">Nom de catégorie : </label>
									<input id="categoryName" type="text" name="categoryName" />
								</div>
								<div class="new-category-valid">
							    	<div class="new-category-valid">
							        	<button id="categorySubmit" type="submit" class="btn-small btn-default">Créer Catégorie</button>
							        </div>
								</div>
							</form>
					    </div>
                	</div>
			  	</div>
			 </div>
		</div>
	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>