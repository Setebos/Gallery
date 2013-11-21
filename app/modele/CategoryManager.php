<?php

class CategoryManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createCategory(Category $category) {
		$q = $this->_db->prepare('INSERT INTO category SET name = :name');

		$q->bindValue(':name', $category->getName());

		$q->execute();
	}

	public function updateCategory(Category $category) {
		$q = $this->_db->prepare('UPDATE category SET name = :name WHERE id = :id');

		$q->bindValue(':name', $category->getName());
		$q->bindValue(':id', $category->getId());

		$q->execute();
	}

	public function deleteCategory(Category $category) {
		$this->_db->exec('DELETE FROM category WHERE id = '.$category->getId());
	}

	public function getCategory($id) {
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, name FROM category WHERE id = '.$id);
    	$donnees = $q->fetch(PDO::FETCH_ASSOC);

    	return new Category($donnees);
	}

	public function getListCategories() {
		$listCategories = array();

		$q = $this->_db->query('SELECT * FROM category');

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listCategories[] = new Category($donnees);
		}

		return $listCategories;
	}

	public function setDb(PDO $db) {
		$this->_db = $db;
	} 

}

?>