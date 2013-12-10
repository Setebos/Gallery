<?php

class ImageManager {

	private $_db;

	public function __construct($db) {
		$this->setDb($db);
	}

	public function createImage(Image $image) {
		$q = $this->_db->prepare('INSERT INTO image SET title = :title, description = :description, position = :position, location = :location, gallery_id = :gallery_id');

		$q->bindValue(':title', $image->getTitle());
		$q->bindValue(':description', $image->getDescription());
		$q->bindValue(':position', $image->getPosition());
		$q->bindValue(':location', $image->getLocation());
		$q->bindValue(':gallery_id', $image->getGalleryId());

		$q->execute();
	}

	public function updateImage(Image $image) {
		$q = $this->_db->prepare('UPDATE image SET title = :title, description = :description, position = :position, location = :location, gallery_id = :gallery_id WHERE id = :id');

		$q->bindValue(':title', $image->getTitle());
		$q->bindValue(':description', $image->getDescription());
		$q->bindValue(':position', $image->getPosition());
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

	public function getPositions($id) {
		$listPositions = array();

		$q = $this->_db->query('SELECT position FROM image WHERE gallery_id = '.$id);

		while($donnees = $q->fetch()) {
			$listPositions[] = $donnees;
		}

		return $listPositions;
	}

	public function getImageByPosition($position, $idGallery) {
		$q = $this->_db->query('SELECT * FROM image WHERE position = '.$position.' AND gallery_id = '.$idGallery);

		$donnees = $q->fetch(PDO::FETCH_ASSOC);

    	return new Image($donnees);
    }
	
	public function getImagesByGallery($id) {
		$listImages = array();

		$q = $this->_db->query('SELECT * FROM image WHERE gallery_id = '.$id.' ORDER BY position ');

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listImages[] = new Image($donnees);
		}

		return $listImages;
	}

	public function getImagesByCategory($id) {
		$listImages = array();

		$q = $this->_db->query('SELECT * FROM image WHERE id IN (SELECT id FROM image JOIN image_category ON image_category.image_id = image.id WHERE category_id = '.$id.')');

		while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$listImages[] = new Image($donnees);
		}

		return $listImages;
	}


	public function getImagesByCategories($arrayCatIds) {
		$listImages = array();

		foreach($arrayCatIds as $id)
		{
		    $q = $this->_db->query('SELECT * FROM image WHERE id IN (SELECT id FROM image JOIN image_category ON image_category.image_id = image.id WHERE category_id = '.$id.')');

			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$listImages[] = new Image($donnees);
			}
		}

		return $listImages;
	}

	public function getImagesByCategoriesAndGallery($arrayCatIds, $idGallery) {
		$listImages = array();

		foreach($arrayCatIds as $id)
		{
		    $q = $this->_db->query('SELECT * FROM image WHERE gallery_id = '.$id.' AND WHERE id IN (SELECT id FROM image JOIN image_category ON image_category.image_id = image.id WHERE category_id = '.$id.')');

			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$listImages[] = new Image($donnees);
			}
		}

		return $listImages;
	}


	public function getImagesByResearch($searched_item){
		$listImages = array();

		$q = $this->_db->query('SELECT * FROM image WHERE title LIKE "%'.$searched_item.'%" OR description LIKE "%'.$searched_item.'%" ');

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