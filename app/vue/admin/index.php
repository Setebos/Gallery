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
		                        	<a href="#"><p><?= $gallery->getName() ?></p></a>
		                        	<button class="btn btn-default btn-xsm gal-suppr-btn">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
		                        	<a href="<?= "index.php?section=edit_gallery&id=".$gallery->getId() ?>">
			                        	<button id="<?= "edit-gallery" . $gallery->getId() ?>" class="btn btn-default btn-xsm gallery-edit-button">
									<span class="glyphicon glyphicon-pencil"></span>
								</button>
							</a>		
		                       </div>
	                    </div>
                  	<?php } ?>
		 		</div>
			 </div>
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<div class="btn-admin pull-right"  title="Ajouter une image à la galerie">
			  			<a href="<?= "index.php?section=new_image "?>">+</a>
			  		</div>
			  		<ul>
			  			<li>
			  				<a href="#" id="new-cat-btn"><p>Editer les catégories</p></a>
			  			</li>
			  		</ul>
			  		<h3>Images</h3>
			  	</div>
			  	<div class="picture-header-option-part">
				  	<div class="new-cat">
				  		<div class="row">
				  			<div class="col-md-9">
				  				<p> Catégories existantes </p>
				  				<ul class="list-inline">
						          <?php foreach ($listCategories as $category) {?>
							          <li class="cat-label">
							            <p id="<?= "cat" . $category->getId() ?>" class="cat-name cat-active"><?= $category->getName() ?></p>
							            <span id="<?= "del-cat" . $category->getId() ?>" class="span-del-cat">
							            	X
							            </span>
							          </li>
						          <?php } ?>
						        </ul>
				  			</div>
					  		<div class="col-md-3 well">
						  		<form class="form-inline" role="form">
						  			<p> Ajouter une catégorie </p>
								  <div class="form-group">
								    <input id="newCategory" type="email" class="form-control" placeholder="Nom de la catégorie">
								  </div>
								  <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
								  <span id="validateCategoryName"></span>
								</form>
							</div>
						</div>
				  	</div>	
				</div>
			  	<div class="picture-body">
                	<div class="conteneur-images">
                    	<h3>Aucune galerie sélectionnée</h3>
                    	<ul class="list-inline sortable">
	                    	<?php foreach ($listImages as $image) {?>
		                    	<li class="picture-list">
	                        		<div class="picture-div" data-toggle="modal" data-target="#myModal">
	                        			<img id="<?= "image-".$image->getId() ?>" src="<?= $image->getLocationThumbnail() ?>" title="<?= $image->getTitle() ?>">
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
		<!-- 		Alert suppression galerie			  -->
		<div id="dialog-confirm" title="Supprimer la galerie ?">
			<p>
				<span class="glyphicon glyphicon-warning-sign"></span>
				Supprimer la galerie détruira toutes les images la composant. Êtes-vous sur de vouloir effectuer cette action ?
			</p>
		</div>
		<!-- 		Alert suppression categorie			  -->
		<div id="dial-del-cat" title="Supprimer la categorie ?">
			<p>
				<span class="glyphicon glyphicon-warning-sign"></span>
				Confirmez-vous la suppression de la catégorie ?
			</p>
		</div>

		<!-- 		Modal affichage info images			  -->
		<div id="modal_info_pic" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Editer l'image</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="ajax_content">
		        ...
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>
