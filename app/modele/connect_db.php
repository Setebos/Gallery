<?php

include("ressources/config.php");

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

try {
     $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"], $options);
  }
  catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
  }
