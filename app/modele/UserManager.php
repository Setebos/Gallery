<?php

class UserManager {

    private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

     public function login($login, $password) {
        $q = $this->_db->prepare('SELECT id FROM user WHERE login = :login AND password = :password');
        $q->bindValue(':login', $login);
        $q->bindValue(':password', $password);

        $q->execute();

        return $q->fetch();
    }


    public function setDb(PDO $db) {
        $this->_db = $db;
    } 

}


?>
