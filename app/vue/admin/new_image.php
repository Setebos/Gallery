		<div class="row height-full">
		  	<div class="col-md-3 gallery-part-full-height">
			  	<div class="gallery-header">
			  		<h4><a href="index.php?section=admin_index">< Retour à la liste des galeries</a></h4>
			 	</div>
			 	<div class="gallery-body-full-height">
			 	</div>
			 </div>
			 <div class="col-md-8 picture-part">
			  	<div class="picture-header">
			  		<h3>Nouvelle image </h3>
			  	</div>
			  	<div class="upload-image-form-body">
			  		<div class="well">
	                    <form id="newImageForm" class="upload-image-align" enctype="multipart/form-data" method="post" action="<?= "index.php?section=upload_image "?>" role="form">
	                        <div class="pull-right">
		                        <div class= "upload-image-cancel">
	                        		<a href="<?= "index.php?section=admin_index "?>">Annuler</a>
	                        	</div>
	                        	<div class="upload-image-valid">
		                        	<button type="submit" class="btn btn-default">Créer</button>
		                        </div>
	                    	</div>

	                        <div class="form-group">
	                            <label name="imageName">Titre de l'image : </label>
	                            <input id="imageName" type="text" name="imageName" />
	                            <span class="validateImageName form-error"></span>
	                        </div>
	                        <div class="form-group">
	                            <label name="imageGallery">Galerie : </label>
	                            <select name="imageGallery">
	                            	<?php foreach ($listGalleries as $gallery) {
	                            		echo "<option>" . $gallery['name'] . "</option>";
	                            	}?>
                            	</select>
	                        </div>
	                        <div class="form-group">
	                            <label name="imageDescription">Description : </label>
	                            <textarea cols="45" rows="4" name="imageDescription" placeholder="Entrez la description de votre image"></textarea>
	                        </div>
	                        <div class="form-group">
					        	<label name="imageUpload">Sélectionner une image : </label>
						    	<input id="imageUpload" type="file" name="imageUpload" />
						    	<span class="validateImageUpload form-error"></span>
						    </div>
						    <div class="form-group list-categories">
					        	<label name="imageCategories">Choisissez des catégories : </label>
					        	<ul class="list-inline">
					        		<?php foreach ($listCategories as $category) {
					        		?>
						        		<li>
						        			<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
						        		</li>
                            		<?php } ?>
                        			<li>
                        				<div class="btn btn-default btn-sm upload-image-new-category">
									    	<a href="#" title="créer une nouvelle catégorie">+</a>
									    </div>
                        			</li>
                        		</ul>
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
							        	<span id="validateCategoryName"></span>
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