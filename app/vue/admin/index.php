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
			  	</div>
			  	<div class="picture-body">
                    <div class="conteneur-images">
                    	<h3>Aucune galerie sélectionnée</h3>
                    	<ul class="list-inline sortable">
	                    	<?php foreach ($listImages as $image) {?>
		                    	<li class="picture-list">
	                        		<div class="picture-div">
	                        			<img src="<?= $image->getLocation() ?>">
	                    			</div>
	                    		</li>
	                  		<?php } ?>
                    	</ul>
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
