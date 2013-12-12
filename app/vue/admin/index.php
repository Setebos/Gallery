<?php
      require_once("ressources/templates/admin/header.php");    
?>

		    <div class="row height-full">
			  <div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<div class="btn-admin pull-right" title="Ajouter une galerie">
			  			<a href="<?= "index.php?section=new_gallery "?>">+</a>
			  		</div>
			  		<h3>Galeries</h3>
			 	</div>
			 	<div class="gallery-body">
			 		<?php foreach ($listGalleries as $gallery) {?>
	                    <div class="gal-vign-container"  id="<?= "gallery" . $gallery->getId() ?>">
	                    		<div class="gal-vign-picture">
		                        	<img src="http://placehold.it/120&text=pic">
		                      </div>
		                       <div class="gal-vign-detail">
		                        	
		                        	<span class="gal-suppr-btn glyphicon glyphicon-trash"></span>
		                       </div>
	                    </div>
                  	<?php } ?>
		 		</div>
			 </div>
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<div class="btn-admin pull-right"  title="Ajouter une image à la galerie">
			  			<a href="<?= "index.php?section=select_image "?>">+</a>
			  		</div>
			  		<ul>
			  			<li>
			  				<a href="#" id="filter-cat-btn"><p>Filtrer par catégories</p></a>
			  			</li>
			  			<li>
			  				<a href="#" id="new-cat-btn"><p>Ajouter catégorie</p></a>
			  			</li>
			  		</ul>
			  		<h3>Images</h3>
			  	</div>
			  	<div class="cat-filters">
			  		<div class="row">
			  			<div class="col-md-1">
				  			<button id="cat-filters-submit" type="submit" class="btn-admin">Filtrer !</button>
				  		</div>
				  		<div class="col-md-11">
					  		<div class="form-group list-categories">
								<? foreach ($listCategories as $category) {
									?>
									<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
								<? } ?>
							</div>
						</div>
					</div>
			  	</div>	
			  	<div class="new-cat">
			  		<form class="form-inline" role="form">
					  <div class="form-group">
					    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Nom de la catégorie">
					  </div>
					  <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">Ajouter</button>
					</form>
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
