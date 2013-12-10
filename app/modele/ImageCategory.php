<?php

class ImageCategory {

	private $_image_id;
	private $_category_id;

	public function __construct($donnees) {
		$this->setImageId($donnees['image_id']);
		$this->setCategoryId($donnees['category_id']);
	}

	public function getImageId() {
		return $this->_image_id;
	}

	public function getCategoryId() {
		return $this->_category_id;
	}

	public function setImageId($image_id) {
		$this->_image_id = $image_id;
	}

	public function setCategoryId($category_id) {
		$this->_category_id = $category_id;
	}
}