<?php

class Option  implements JsonSerializable{

    private $_id;
    private $_show_entire_gallery;
    private $_diaporama_width;
    private $_nb_images_per_line;
    private $_display_duration;

    public function __construct($donnees) {
        $this->setShowEntireGallery($donnees['show_entire_gallery']);
        $this->setDiaporamaWidth($donnees['diaporama_width']);
        $this->setNbImagesPerLine($donnees['nb_images_per_line']);
        $this->setDisplayDuration($donnees['display_duration']);
        $this->setId($donnees['id']);
    }

    public function getId() {
        return $this->_id;
    }

    public function getShowEntireGallery() {
        return $this->_show_entire_gallery;
    }

    public function getDiaporamaWidth() {
        return $this->_diaporama_width;
    }

    public function getNbImagesPerLine() {
        return $this->_nb_images_per_line;
    }

    public function getDisplayDuration() {
        return $this->_display_duration;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function setShowEntireGallery($bool) {
        $this->_show_entire_gallery = $bool;
    }

    public function setDiaporamaWidth($val) {
        $this->_diaporama_width = $val;
    }

    public function setNbImagesPerLine($val) {
        $this->_nb_images_per_line = $val;
    }

    public function setDisplayDuration($val) {
        $this->_display_duration = $val;
    }

    public function hydrate(array $donnees)
    {
      foreach ($donnees as $key => $value)
      {
        // On récupère le nom du setter correspondant à l'attribut.
        $method = 'set'.ucfirst($key);
            
        // Si le setter correspondant existe.
        if (method_exists($this, $method))
        {
          // On appelle le setter.
          $this->$method($value);
        }
      }
    }

    public function jsonSerialize() {
        $data = array(
            'id' => $this->getId(), 
            'show_entire_gallery' => $this->getShowEntireGallery(),
            'diaporama_width' => $this->getDiaporamaWidth(),
            'nb_images_per_line' => $this->getNbImagesPerLine(),
            'display_duration' => $this->getDisplayDuration()
            );
        return $data;
    }

}

?>
