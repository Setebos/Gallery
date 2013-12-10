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
	<? foreach ($listCategories as $category) {
		?>
		<input type="checkbox" class="upload-image-checkbox" name="imageCategories[]" value="<?= $category->getName() ?>"><?= $category->getName() ?>
	<? } ?>
</div>


