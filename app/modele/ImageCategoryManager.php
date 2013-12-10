<?php

class ImageCategoryManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createImageCategory(ImageCategory $imageCategory) {
		$q = $this->_db->prepare('INSERT INTO image_category SET image_id = :image_id, category_id = :category_id');

		$q->bindValue(':image_id', $imageCategory->getImageId());
		$q->bindValue(':category_id', $imageCategory->getCategoryId());

		$q->execute();
	}

	public function setDb(PDO $db) {
		$this->_db = $db;
	} 
}