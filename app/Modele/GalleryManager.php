<?php

class GalleryManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createGallery(Gallery $gallery) {
		$q = $this->_db->prepare('INSERT INTO gallery SET name = :name, );

	}

	public function updateGallery() {

	}

	public function deleteGallery(Gallery $gallery) {

	}

	public function getGallery($id) {

		$id = (int) $id;

		$q = $this->_db->query('SELECT id, name, description FROM gallery WHERE id = '.$id);
    	$donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Gallery($donnees);
	}

	public function setDb(PDO $db) {
		$this->_db = $db;
	} 

}

?>