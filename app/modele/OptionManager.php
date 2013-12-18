<?php

class OptionManager {

    private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function getOption($id) {
        
        $id = (int) $id;

        $q = $this->_db->query('SELECT show_entire_gallery, diaporama_width, nb_images_per_line, display_duration 
            FROM gallery_options WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Option($donnees);
    }

    public function getOption_json($id) {
            return json_encode($this->getOption($id));
    }

     public function updateOption(Option $option) {
        $q = $this->_db->prepare('UPDATE gallery_options SET show_entire_gallery = :show_entire_gallery, diaporama_width = :diaporama_width, nb_images_per_line = :nb_images_per_line, display_duration = :display_duration WHERE id = :id');

        $q->bindValue(':show_entire_gallery', $option->getShowEntireGallery());
        $q->bindValue(':diaporama_width', $option->getDiaporamaWidth());
        $q->bindValue(':nb_images_per_line', $option->getNbImagesPerLine());
        $q->bindValue(':display_duration', $option->getDisplayDuration());
        $q->bindValue(':id', $option->getId());

        $q->execute();
    }


    public function setDb(PDO $db) {
        $this->_db = $db;
    } 

}


?>
