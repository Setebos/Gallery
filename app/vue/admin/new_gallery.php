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
			 <div class="col-md-9 new-gallery-form-part">
			  	<div class="new-gallery-form-header">
			  		<h3>Nouvelle galerie</h3>
			  	</div>
			  	<div class="new-gallery-form-body">
			  		<div class="well">
	                    <form class="new-gallery-align" method="post" action="<?= "index.php?section=create_gallery "?>" role="form">
	                        <div class="form-group">
	                            <label name="galleryName">Titre : </label>
	                            <input type="text" name="galleryName" />
	                        </div>
	                        <div ng-class="expression"ss="form-group">
	                            <label name="galleryDescription">Description : </label>
	                            <textarea cols="45" rows="4" name="galleryDescription" placeholder="Entrez la description de votre galerie"></textarea>
	                        </div>
	                        <div class="col-md-offset-3">
		                        <div class= "new-gallery-cancel">
	                        		<a href="<?= "index.php?section=admin_index "?>">Annuler</a>
	                        	</div>
	                        	<div class="new-gallery-valid">
		                        	<button type="submit" class="btn btn-default">Créer</button>
		                        </div>
	                    	</div>
	                    </form>
                	</div>
			  	</div>
			 </div>
		</div>
	</body>
</html>