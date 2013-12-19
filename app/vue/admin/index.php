<?php
      require_once("ressources/templates/admin/header.php");    
?>

		    <div class="row height-full">
			  <div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<div class="btn-admin pull-right" title="Ajouter une galerie">
			  			<a href="<?= "index.php?section=new_gallery "?>">+</a>
			  		</div>
			  		<ul>
			  			<li>
			  				<a href="#" id="display-options"><p>Options d'affichage</p></a>
			  			</li>
			  		</ul>
			  		<h3>Galeries</h3>
			 	</div>
			 	<div class="gallery-header-option-part">
				  	<div class="display-gal-opt">
				  		<form role="form" id="#display-gal-option">
					  		<h4> Options d'affichage de la galerie</h4>
					  		<div class="well">
					  			<span id="display-gal-opt-msg"></span>
				  				<div class="form-group">
				  					<label >Afficher toute la galerie : </label>
						      		<?php if($option->getShowEntireGallery() == 0) { ?>

						      		<label  class="radio-inline">
											<input type="radio" name="displayGallery" id="displayTrue" class="displayGallery" value="1">
											Oui
										</label>
							      	<label  class="radio-inline">
											<input type="radio" name="displayGallery" id="displayFalse" class="displayGallery" value="0" checked>
											Non
										</label>

										<?php } else { ?>

										<label  class="radio-inline">
											<input type="radio" name="displayGallery" id="displayTrue" class="displayGallery" value="1" checked>
											Oui
										</label>
							      	<label  class="radio-inline">
											<input type="radio" name="displayGallery" id="displayFalse" class="displayGallery" value="0">
											Non
										</label>

										<?php } ?>
								</div>
								<div class="form-group">
								    <label name="diaporamaWidth">Largeur du diaporama (en pixel) : </label>
								    <input type="text" class="form-control" id="diaporamaWidth" name="diaporamaWidth" value="<?= $option->getDiaporamaWidth() ?>">
								</div>
					  			<div class="form-group">
				  					<label name="nbImagesPerLine">Nombre d'images affichées par ligne : </label>
								    	<input type="text"  class="form-control" id="nbImagesPerLine" name="nbImagesPerLine" value="<?= $option->getNbImagesPerLine() ?>">
								</div>
								<div class="form-group">
								    <label name="displayDuration">Durée d'affichage des images dans le diaporama : 	</label>
								    <input type="text" class="form-control" id="displayDuration" name="displayDuration" value="<?= $option->getDisplayDuration() ?>">
								</div>
								<button id="gal-options-submit" type="submit" class="btn btn-default btn-sm pull-right">Valider</button>
								<br/><span id="validateGalOptions"></span>
							</div>
						</form>
				  	</div>	
				</div>
			 	<div class="gallery-body">
			 		<?php if($vide == false) {
			 		foreach ($listGalleries as $gallery) {
			 			if($gallery->getName() == $gallerySelect) { ?>
			 				<div class="gal-vign-container gallery-active"  id="<?= "gallery" . $gallery->getId() ?>">
			 			<?php } else { ?>
		 					<div class="gal-vign-container"  id="<?= "gallery" . $gallery->getId() ?>">
		 				<?php } ?>
                 		<div class="gal-vign-picture">
                 			 <?php if ($listFirstImages[$gallery->getId()] != null) {?>
                        		<img src="<?= $listFirstImages[$gallery->getId()]->getLocationThumbnail() ?>">
                        	<?php } else { ?>
                        	<img src="http://placehold.it/120&text=pic">
                        	<?php } ?>
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
            	<?php }} ?>
		 		</div>
			 </div>
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<div class="btn-admin pull-left"  title="Ajouter une image à la galerie">
			  			<a href="<?= "index.php?section=new_image "?>">+</a>
			  		</div>
			  		<ul>
			  			<li>
			  				<a href="#" id="new-cat-btn"><p>Editer les catégories</p></a>
			  			</li>
			  		</ul>
			  		<h3>Images 
			  		<?php if($vide == false) { 
                 		echo  " - ".$gallerySelect;
                 	} ?>
                 </h3>
			  	</div>
			  	<div class="picture-header-option-part">
				  	<div class="new-cat">
				  		<div class="row">
				  			<div class="col-md-8">
				  				<h4> Catégories existantes </h4>
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
					  		<div class="col-md-3 well ">
						  		<form class="form-inline" role="form">
						  			<p> Ajouter une catégorie </p>
								  <div class="form-group">
								    <input class="categoryName"  class="form-control" placeholder="Nom de la catégorie">
								  </div>
								  <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
								  <br/><span class="validateCategoryName"></span>
								</form>
							</div>
						</div>
				  	</div>	
				</div>
			  	<div class="picture-body">
	             	<div class="conteneur-images">
	             		<?php if($vide == false) { ?>
							<p class="help-block">Faites glisser et déposez les miniatures pour changer l'ordre d'affichage des images.</p>
							<ul class="list-inline sortable">
								<?php foreach ($listImages as $image) {?>
									<li id="<?= "item-".$image->getId() ?>" class="picture-list">
										<span class="roll"></span>
										<div class="picture-div">
											<img id="<?= "image-".$image->getId() ?>" src="<?= $image->getLocationThumbnail() ?>">
										</div>
									</li>
								<?php } ?>
							</ul>
							<?php } ?>
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
