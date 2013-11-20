<?php

class Gallery {

	private $_id;
	private $_name;
	private $_description;

	public function __construct($donnees) {
		$this->setName($donnees['name']);
		$this->setDescription($donnees['description']);
		$this->setId($donnees['id']);
	}

	public function getId() {
		return $this->_id;
	}

	public function getName() {
		return $this->_name;
	}

	public function getDescription() {
		return $this->_description;
	}

	public function setId($id) {
		$this->_id = $id;
	}

	public function setName($name) {
		$this->_name = $name;
	}

	public function setDescription($description) {
		$this->_description = $description;
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

}

?>