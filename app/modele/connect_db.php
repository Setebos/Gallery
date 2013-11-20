<?php

include("ressources/config.php");

try {
     $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
  }
  catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
  }
