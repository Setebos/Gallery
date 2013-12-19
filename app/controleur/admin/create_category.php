<?php

include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

if(isset($_POST["name"])) {
	$name = trim(strtolower(htmlspecialchars($_POST['name'])));
}
if(isset($_POST["id"])) {
	$id = htmlspecialchars($_POST['id']);
}

$manager = new CategoryManager($db);

$listCategories = $manager->getListCategories();
$categories = $manager->getCategoriesByImage($id);

$existe = false;

// On vérifie dans les catégories existantes si ce nom existe déjà
foreach ($listCategories as $category) {
	if($name == trim(strtolower($category->getName()))) {
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

// Deuxième appel à getListCategories pour prendre en compte la catégorie nouvellement créée
$listCategories = $manager->getListCategories();

?>

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


