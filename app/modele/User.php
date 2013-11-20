<?php

class Gallery {

    private $_id;
    private $_login;
    private $_password;

    public function __construct($donnees) {
        $this->setLogin($donnees['login']);
        $this->setPassword($donnees['password']);
        $this->setId($donnees['id']);
    }

    public function getId() {
        return $this->_id;
    }

    public function getLogin() {
        return $this->_login;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function setLogin($login) {
        $this->_login = $login;
    }

    public function setPassword($password) {
        $this->_password = $password;
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
