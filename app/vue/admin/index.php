	<?php
      require_once("ressources/templates/admin/header.php");    
?>

		    <div class="row height-full">
			  <div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<a href="<?= "index.php?section=new_gallery "?>">
			  			<div class="btn-admin pull-right" title="Ajouter une galerie">
			  			+
			  			</div>
			  		</a>
			  		<ul>
			  			<li>
			  				<a href="#" id="display-options"><p>Options d'affichage</p></a>
			  			</li>
			  		</ul>
			  		<h3>Galeries</h3>
			 	</div>
			 	<!-- Options de la galerie -->
			 	<div class="gallery-header-option-part">
				  	<div class="display-gal-opt">
				  		<form role="form" id="display-gal-option">
					  		<h4> Options d'affichage de la galerie</h4>
					  		<div class="well">
					  			<span id="display-gal-opt-msg"></span>  <!-- span contenant le message de réussite/erreur -->
				  				<div class="form-group radio-btn">
				  					<label >Afficher toute la galerie : </label>
				  					<br>
						      		<?php if($option->getShowEntireGallery() == 0) { ?>

						      		<label class="radio-inline">
										<input type="radio" name="displayGallery" id="displayTrue" class="displayGallery" value="1">
										Oui
									</label>
							      	<label class="radio-inline">
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
								    <label name="diaporamaWidth">Largeur du diaporama (<abbr title="min : 300 ; max : 1000">en pixel</abbr>) : </label>
								    <div class="col-md-5">
								    	<input type="text" class="form-control input-sm" id="diaporamaWidth" name="diaporamaWidth" value="<?= $option->getDiaporamaWidth() ?>">
								    </div>
								</div>
					  			<div class="form-group">
				  					<label name="nbImagesPerLine">Nombre d'images affichées par ligne : </label>
				  					<div class="col-md-5">
								    	<input type="text"  class="form-control input-sm" id="nbImagesPerLine" name="nbImagesPerLine" value="<?= $option->getNbImagesPerLine() ?>">
								    </div>
								</div>
								<div class="form-group">
								    <label name="displayDuration">Durée d'affichage des images dans le diaporama (<abbr title="min : 500 ; max : 10 000">en millisecondes</abbr>) : 	</label>
								    <div class="col-md-5">
								    	<input type="text" class="form-control input-sm" id="displayDuration" name="displayDuration" value="<?= $option->getDisplayDuration() ?>">
									</div>
								</div>
								<button id="gal-options-submit" type="submit" class="btn btn-default btn-sm pull-right">Valider</button>
								<br/>
							</div>
						</form>
				  	</div>	
				</div>
				<!-- Affichage de la liste des galeries -->
			 	<div class="gallery-body">
			 		<?php if($vide == false) {
			 		foreach ($listGalleries as $gallery) {
			 			if($gallery->getName() == $gallerySelect) { ?> 
			 				<div class="gal-vign-container gallery-active"  id="<?= "gallery" . $gallery->getId() ?>">
			 			<?php } else { ?>
		 					<div class="gal-vign-container"  id="<?= "gallery" . $gallery->getId() ?>">
		 				<?php } ?>
                 		<div class="gal-vign-picture">
                 			 <?php if ($listFirstImages[$gallery->getId()] != null) {?> <!-- Si la galerie contient des images, la première est affichée pour identifier la galerie -->
                        		<img src="<?= $listFirstImages[$gallery->getId()]->getLocationThumbnail() ?>">
                        	<?php } else { ?> <!-- Gestion du cas des galeries sans images -->
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
			 <!-- Header de la partie image avec gestion des catégories -->
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<a href="<?= "index.php?section=new_image "?>">
			  			<div class="btn-admin pull-left"  title="Ajouter une image à la galerie">+ </div>
			  		</a>
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
								    <input type="text" class="categoryName"  class="form-control" placeholder="Nom de la catégorie">
								  </div>
								  <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
								  <br/><span class="validateCategoryName"></span>
								</form>
							</div>
						</div>
				  	</div>	
				</div>
				<!-- Affichage des images -->
			  	<div class="picture-body">
	             	<div class="conteneur-images">
	             		<?php if($vide == false) { 
	             			if(!isset($listImages)) {?>
	             				<p class="help-block">Appuyez sur le bouton " + " ci-dessus pour ajouter des images.</p>
             				<?php } else {?> <!-- Gestion du cas ou aucune galerie n'existe -->
								<p class="help-block">Faites glisser et déposez les miniatures pour changer l'ordre d'affichage des images.</p>
								<p class="help-block">Cliquez sur une image pour la modifier.</p>
							<?php } ?>
							<ul class="list-inline sortable">
								<?php foreach ($listImages as $image) {?>
									<li id="<?= "item-".$image->getId() ?>" class="picture-list">
										
										<div class="picture-div">
											<img id="<?= "image-".$image->getId() ?>" src="<?= $image->getLocationThumbnail() ?>" title="cliquez pour modifier cette image">
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
			<p>Supprimer la galerie détruira toutes les images la composant. </p>
			<p>Êtes-vous sur de vouloir effectuer cette action ?</p>
		</div>
		<!-- 		Alert suppression categorie			  -->
		<div id="dial-del-cat" title="Supprimer la categorie ?">
			<p>
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
		    </div>
		  </div>
		</div>

	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>
