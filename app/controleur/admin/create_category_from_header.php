<?php

include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

if(isset($_POST["name"])) {
	$name = $_POST['name'];
}

$manager = new CategoryManager($db);

$categories = $manager->getListCategories();

$existe = false;

foreach ($categories as $category) {
	if($name == $category->getName()) {
		$existe = true;
	}
}

if($existe == false) {
	$newCategory = new Category(array(
		'id' => null,
		'name' => $name
	));

	$manager->createCategory($newCategory);
}

$listCategories = $manager->getListCategories();

?>

	<div class="cat-filters">
		<div class="row">
	  		<div class="col-md-11">
		  		<div class="form-group list-categories">
					<? foreach ($listCategories as $category) {
						?>
							<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
					<? } ?>
				</div>
			</div>
			<div class="col-md-1">
	  			<button id="cat-filters-submit" type="submit" class="btn-admin">Filtrer !</button>
	  		</div>
		</div>
	</div>	
	<div class="new-cat">
		<div class="row">
			<div class="col-md-9">
				<p> Catégories existantes </p>
				<ul class="list-inline">
	          <?php foreach ($listCategories as $category) {?>
	          <li class="cat-label">
	            <a id="<?= "cat" . $category->getId() ?>" class="cat-name cat-active"><?= $category->getName() ?></a>
	            <span class="span-delete-cat">
	            	<a id="<?= "del-cat" . $category->getId() ?>">X</a>
	            </span>
	          </li>
	          <?php } ?>
	        </ul>
			</div>
  		<div class="col-md-3 well">
	  		<form class="form-inline" role="form">
	  			<p> Ajouter une catégorie </p>
			  <div class="form-group">
			    <input type="email" class="form-control" placeholder="Nom de la catégorie">
			  </div>
			  <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
			</form>
		</div>
	</div>
	</div>	


