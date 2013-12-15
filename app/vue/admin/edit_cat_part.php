<div class="new-cat">
  <div class="row">
    <div class="col-md-9">
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
          <input type="email" class="form-control" placeholder="Nom de la catégorie">
        </div>
        <button id="new-cat-submit" type="submit" class="btn btn-default btn-sm">+</button>
      </form>
    </div>
  </div>
</div>  
