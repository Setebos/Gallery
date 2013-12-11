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
	                        <div class="gallery-suppr-button">
	                        	<span class="glyphicon glyphicon-trash"></span>
	                        </div>
	                    </div>
                  	<?php } ?>
		 		</div>
			 </div>
			 <div class="col-md-9 picture-part">
			  	<div class="picture-header">
			  		<div class="btn btn-default pull-right">
			  			<a href="<?= "index.php?section=select_image "?>">Ajouter image</a>
			  		</div>
			  		<h3>Images</h3>
			  		<div class="category-header">
			  			<h4>Filtrer par catégories</h4>
				  		<div class="form-group list-categories">
				  			<form class="new-category-align" method="post" action="#" role="form">
				  				<? foreach ($listCategories as $category) {
									?>
									<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
								<? } ?>
								<button id="categoryFilterBtn" type="submit" class="btn btn-default btn-sm">Filtrer</button>
				  			</form>
							
						</div>
						<!-- <div class="new-category">
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
					    </div> -->
			  		</div>
			  	</div>
			  	<div class="picture-body">
                    <div class="conteneur-images">
                    	<h3>Aucune galerie sélectionnée</h3>
                    	<ul class="list-inline sortable">
	                    	<?php foreach ($listImages as $image) {?>
		                    	<li class="picture-list">
	                        		<div class="picture-div">
	                        			<div class="picture-delete">
				                        	<span class="glyphicon glyphicon-trash"></span>
				                        </div>
	                        			<img src="<?= $image->getLocation() ?>">
	                    			</div>
	                    		</li>
	                  		<?php } ?>
                    	</ul>
                	</div>
                	<div class="picture-options">
                		<div class="btn btn-default edit-picture-button">
                		 	<a href="<?= "index.php?section=edit_image "?>">Modifier l'image</a>
                		</div>
                		<br/>
                		<div class="btn btn-default">
                		 	<a href="<?= "index.php?section=delete_image "?>">Supprimer l'image</a>
                		</div>
                	</div>
			 	</div>
			 </div>
		</div>
		<div id="dialog-confirm" title="Supprimer la galerie ?">
			<p>
				<span class="glyphicon glyphicon-warning-sign"></span>
				Supprimer la galerie détruira toutes les images la composant. Êtes-vous sur de vouloir effectuer cette action?
			</p>
		</div>
	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>
