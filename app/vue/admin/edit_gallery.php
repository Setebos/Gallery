<?php
      require_once("ressources/templates/admin/header.php");
?>

	    <div class="row height-full">
		  	<div class="col-md-3 gallery-part-full-height">
			  	<div class="gallery-header">
			  		<h4><a href="index.php?section=admin_index">< Retour à la liste des galeries</a></h4>
			 	</div>
			 	<div class="gallery-body-full-height"></div>
			 </div>
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<h3>Modifier la galerie <?= $gallery->getName() ?> </h3>
			  	</div>
			  	<div class="new-gallery-form-body">
			  		<div class="well">
	                    <form id="editGalleryForm" class="new-gallery-align" method="post" action="<?= "index.php?section=update_gallery "?>" role="form">
	                        <div class="form-group">
	                            <label name="galleryName">Nom : </label>
	                            <input id="editGallery" class="<?= $gallery->getName() ?>" type="text" name="galleryName" value="<?= $gallery->getName() ?>"/>
	                            <span id="validateGalleryName"></span>
	                        </div>
	                        <div class="form-group">
	                            <label name="galleryDescription">Description : </label>
	                            <textarea cols="45" rows="4" name="galleryDescription"><?= $gallery->getDescription() ?></textarea>
	                        </div>
	                        <input type="hidden" name="id" value=<?= $id ?>>
	                        <div class="col-md-offset-3">
		                        <div class= "new-gallery-cancel">
	                        		<a href="<?= "index.php?section=admin_index "?>">Annuler</a>
	                        	</div>
	                        	<div class="new-gallery-valid">
		                        	<button type="submit" class="btn btn-default">Modifier</button>
		                        </div>
	                    	</div>
	                    	<input type="hidden" name="originalName" value="<?= $gallery->getName() ?>">
	                    </form>
                	</div>
			  	</div>
			 </div>
		</div>
	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>