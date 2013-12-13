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


