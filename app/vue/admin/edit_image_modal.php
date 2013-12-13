 <div class="upload-image-form-part">
  	<div class="upload-image-form-body">
  		<div class="well">
            <form class="upload-image-align" method="post" action="<?= "index.php?section=update_image"?>" role="form">
                <div class="form-group">
                    <label name="imageName">Titre de l'image : </label>
                    <input type="text" name="imageName" value="<?= $image->getTitle() ?>"/>
                </div>
                <div class="form-group">
                    <label name="imageGallery">Galerie : </label>
                    <select name="imageGallery">
                    	<?php foreach ($listGalleries as $galleries) {
                    		if ($galleries['name'] == $galleryName) {
                    			echo ('<option selected>' . $galleries['name'] . '</option>');
                    		} else {
                    			echo ('<option>' . $galleries['name'] . '</option>');
                    		}
                    	}?>
                	</select>
                </div>
                <div class="form-group">
                    <label name="imageDescription">Description : </label>
                    <textarea cols="60" rows="4" name="imageDescription"><?= $image->getDescription() ?></textarea>
                </div>
			    <div class="form-group list-categories">
		        	<label name="imageCategories">Choisissez des catégories : </label>
		        	<ul class="list-inline">
		        		<?php foreach ($listCategories as $category) {
		        			if(in_array($category, $categories)) {
		        			?>
				        		<li>
				        			<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>" checked><?= $category->getName() ?>
				        		</li>
			        		<?php } else {
		        			?>
			        			<li>
				        			<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
				        		</li>
                			<?php }} ?>
            			<li>
            				<div class="btn btn-default btn-sm upload-image-new-category">
						    	<a href="#" title="créer une nouvelle catégorie">+</a>
						    </div>
            			</li>
            		</ul>
			    </div>
			    <input type="hidden" name="id" value=<?= $id ?>>
                <div class="col-md-offset-4">
                    <div class= "upload-image-cancel">
                		<a href="<?= "index.php?section=admin_index "?>">Annuler</a>
                	</div>
                	<div class="upload-image-valid">
                    	<button type="submit" class="btn btn-default">Modifier</button>
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