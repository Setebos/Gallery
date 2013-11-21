<?php

class ImageManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createImage(Image $image) {
		$q = $this->_db->prepare('INSERT INTO image SET title = :title, description = :description, location = :location, gallery_id = :gallery_id');

		$q->bindValue(':title', $image->getTitle());
		$q->bindValue(':description', $image->getDescription());
		$q->bindValue(':location', $image->getLocation());
		$q->bindValue(':gallery_id', $image->getGalleryId());

		$q->execute();
	}

	public function updateImage(Image $image) {
		$q = $this->_db->prepare('UPDATE image SET title = :title, description = :description, location = :location, gallery_id = :gallery_id WHERE id = :id');

		$q->bindValue(':title', $image->getTitle());
		$q->bindValue(':description', $image->getDescription());
		$q->bindValue(':location', $image->getLocation());
		$q->bindValue(':gallery_id', $image->getGalleryId());
		$q->bindValue(':id', $image->getId());

		$q->execute();
	}

	public function deleteImage(Image $image) {
		$this->_db->exec('DELETE FROM image WHERE id = '.$image->getId());
	}

	public function getImage($id) {
		$id = (int) $id;

		$q = $this->_db->query('SELECT * FROM image WHERE id = '.$id);
    	$donnees = $q->fetch(PDO::FETCH_ASSOC);

    	return new Image($donnees);
	}

	public function getListImages() {
		$listImages = array();

		$q = $this->_db->query('SELECT * FROM image');

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listImages[] = new Image($donnees);
		}

		return $listImages;
	}

	public function getImagesByGallery($id) {
		$listImages = array();

		$q = $this->_db->query('SELECT * FROM image WHERE gallery_id = '.$id);

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listImages[] = new Image($donnees);
		}

		return $listImages;
	}

	public function setDb(PDO $db) {
		$this->_db = $db;
	} 

}

?>