<?php

include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

if(isset($_POST["name"])) {
	$name = htmlspecialchars($_POST['name']);
}
if(isset($_POST["id"])) {
	$id = htmlspecialchars($_POST['id']);
}

$manager = new CategoryManager($db);

$listCategories = $manager->getListCategories();
$categories = $manager->getCategoriesByImage($id);

$existe = false;

foreach ($listCategories as $category) {
	if($name == $category->getName()) {
		$existe = true;
	}
}

if($existe == false) { // Le nom de catégorie doit être unique
	$newCategory = new Category(array(
		'id' => null,
		'name' => $name
	));

	$manager->createCategory($newCategory);
}



?>

<!-- <div class="form-group list-categories">
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
</div> -->

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


