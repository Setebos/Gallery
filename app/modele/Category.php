<?php

class Category implements JsonSerializable{

	private $_id;
	private $_name;

	public function __construct($donnees) {
		$this->setName($donnees['name']);
		$this->setId($donnees['id']);
	}

	public function getId() {
		return $this->_id;
	}

	public function getName() {
		return $this->_name;
	}

	public function setId($id) {
		$this->_id = $id;
	}

	public function setName($name) {
		$this->_name = $name;
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
        	'name' => $this->getName()
        	);
        return $data;
    }

}

?>