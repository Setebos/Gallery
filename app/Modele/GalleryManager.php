<?php

class GalleryManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createGallery(Gallery $gallery) {
		$q = $this->_db->prepare('INSERT INTO gallery SET name = :name, description = :description');

		$q->bindValue(':name', $gallery->getName());
		$q->bindValue(':description', $gallery->getDescription());

		$q->execute();
	}

	public function updateGallery(Gallery $gallery) {
		$q = $this->_db->prepare('UPDATE gallery SET name = :name, description = :description WHERE id = :id');

		$q->bindValue(':name', $gallery->getName());
		$q->bindValue(':description', $gallery->getDescription());
		$q->bindValue(':id', $gallery->getId());

		$q->execute();
	}

	public function deleteGallery(Gallery $gallery) {
		$this->_db->exec('DELETE FROM gallery WHERE id = '.$gallery->getId());
	}

	public function getGallery($id) {
		$id = (int) $id;

		$q = $this->_db->query('SELECT id, name, description FROM gallery WHERE id = '.$id);
    	$donnees = $q->fetch(PDO::FETCH_ASSOC);

    	return new Gallery($donnees);
	}

	public function getListGalleries() {
		$listGalleries = array();

		$q = $this->_db->query('SELECT * FROM gallery');

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listGalleries[] = new Gallery($donnees);
		}

		return $listGalleries;
	}

	public function setDb(PDO $db) {
		$this->_db = $db;
	} 

}

?>