<?php

include_once("app/modele/CategoryManager.php");
include_once("app/modele/Category.php");

if(isset($_POST["id"])) {
    $id = $_POST['id'];
}

$categoryManager = new CategoryManager($db);

$categoryManager->deleteCategory($id);

$listCategories = $categoryManager->getListCategories();
?>

    <div class="new-cat">
        <div class="row">
            <div class="col-md-8">
                <p> Catégories existantes </p>
                <ul class="list-inline">
                  <?php foreach ($listCategories as $category) {?>
                      <li class="cat-label">
                        <p id="<?= "cat" . $category->getId() ?>" class="cat-name cat-active"><?= $category->getName() ?></p>
                        <span id="<?= "del-cat" . $category->getId() ?>" class="span-del-cat">
                            X
                        </span>
                      </li>
                  <?php } ?>
                </ul>
            </div>
        <div class="col-md-3 well">
            <form class="form-inline" role="form">
                <p> Ajouter une catégorie </p>
              <div class="form-group">
                <input type="email" class="form-control categoryName" placeholder="Nom de la catégorie">
              </div>
              <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
              <br/><span class="validateCategoryName"></span>
            </form>
        </div>
    </div>
    </div>  
