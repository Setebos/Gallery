<?php

class Image {

	private $_id;
	private $_title;
	private $_description;
	private $_location;
	private $_gallery_id;

	public function __construct($donnees) {
		$this->setTitle($donnees['title']);
		$this->setDescription($donnees['description']);
		$this->setLocation($donnees['location']);
		$this->setGalleryId($donnees['gallery_id']);
		$this->setId($donnees['id']);
	}

	public function getId() {
		return $this->_id;
	}

	public function getTitle() {
		return $this->_title;
	}

	public function getDescription() {
		return $this->_description;
	}

	public function getLocation() {
		return $this->_location;
	}

	public function getGalleryId() {
		return $this->_gallery_id;
	}

	public function setId($id) {
		$this->_id = $id;
	}

	public function setTitle($title) {
		$this->_title = $title;
	}

	public function setDescription($description) {
		$this->_description = $description;
	}

	public function setLocation($location) {
		$this->_location = $location;
	}

	public function setGalleryId($gallery_id) {
		$this->_gallery_id = $gallery_id;
	}

}

?>