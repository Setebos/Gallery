 <div class="upload-image-form-part">
  	<div class="upload-image-form-body">
  		<div class="well">
            
            <form class="upload-image-align" method="post" action="<?= "index.php?section=update_image"?>" role="form">
                <div class="edit-btn-image">
                    <button type="submit" class="btn btn-default btn-sm editImageSubmit">Modifier</button>
                    <span class="validateImageName form-error"></span>
                    <button id="<?= "del-img-".$id ?>" class="btn btn-default btn-xsm pull-right btn-del-img" data-html="true" data-toggle="clickover" data-placement="left" data-content="<?= $confirmText ?>" title="Supprimer l'image ?">
                        <span class="glyphicon glyphicon-trash "></span>
                    </button>
                </div>
                <hr>
                <div class="form-group">
                    <label name="imageName">Titre de l'image : </label>
                    <input id="imageName" type="text" name="imageName" value="<?= $image->getTitle() ?>"/>
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
                    <textarea cols="50" rows="4" name="imageDescription"><?= $image->getDescription() ?></textarea>
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
            				<div class="btn btn-default btn-xsm upload-image-new-category">
						    	<a href="#" title="créer une nouvelle catégorie">+</a>
						    </div>
            			</li>
            		</ul>
			    </div>
			    <input type="hidden" name="id" value=<?= $id ?>>
            </form>
            <div class="new-category">
                <form class="new-category-align form-inline" method="post" action="#" role="form">
                    <div class="form-group">
                        <input class="categoryName categoryNameModal" type="text" name="categoryName" placeholder="Nouvelle catégorie"/>
                    </div>
                    <button type="submit" class="btn-sm btn-default categorySubmit">Créer</button>
                    <span class="validateCategoryNameModal"></span>
                    <input type="hidden" class="imageId" name="id" value=<?= $id ?>>
                </form>
            </div>

    	</div>
  	</div>
 </div>
 <div id="dial-del-img" title="Supprimer l'image ?">
    <p>
        Confirmez-vous la suppression de l'image ?
    </p>
</div>
<script type="text/javascript">
    $(".btn-del-img").popover();
</script>
