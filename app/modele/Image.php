<?php

class Image implements JsonSerializable {

	private $_id;
	private $_title;
	private $_description;
	private $_location;
	private $_location_miniature;
	private $_location_thumbnail;
	private $_position;
	private $_gallery_id;

	public function __construct($donnees) {
		$this->setTitle($donnees['title']);
		$this->setDescription($donnees['description']);
		$this->setLocation($donnees['location']);
		// $this->setLocation($donnees['location_miniature']);
		// $this->setLocation($donnees['location_thumbnail']);
		$this->setPosition($donnees['position']);
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

	public function getPosition() {
		return $this->_position;
	}

	public function getLocation() {
		return $this->_location;
	}

	public function getLocationMiniature() {
		return $this->_location_miniature;
	}

	public function getLocationThumbnail() {
		return $this->_location_thumbnail;
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

	public function setLocationThumbnail($locationThumbnail) {
		$this->_location_thumbnail = $locationThumbnail;
	}

	public function setLocationMiniature($locationMiniature) {
		$this->_location_miniature = $locationMiniature;
	}

	public function setPosition($position) {
		$this->_position = $position;
	}

	public function setGalleryId($gallery_id) {
		$this->_gallery_id = $gallery_id;
	}

	public function jsonSerialize() {
        $data = array(
        	'id' => $this->getId(), 
        	'title' => $this->getTitle(),
        	'description' => $this->getDescription(),
        	'location' => $this->getLocation(),
        	'gallery_id' => $this->getGalleryId()
        	);
        return $data;
    }

}

?>