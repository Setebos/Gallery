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
	                    </div>
                  	<?php } ?>
		 		</div>
			 </div>
			 <div class="col-md-9 picture-part">
			  	<div class="picture-header">
			  		<div class="btn btn-default pull-right">
			  			<a href="addPicture.php">Ajouter image</a>
			  		</div>
			  		<h3>Images</h3>
			  	</div>
			  	<div class="picture-body">
			 		<div id="display"></div>
			 	</div>
			 </div>
		</div>
	</body>
	<script type="text/javascript" src="app/js/admin.js"></script>
</html>
