<?php
  include("ressources/config.php");
  include_once("app/modele/UserManager.php");

  $login = $_POST['login'];
  $password = $_POST['password'];

  $manager = new UserManager($db);

  $resultat_login = $manager->login($login, $password);

  $ok = array();

  if (!$resultat_login) {
    $ok = array(
        'valid' => false,
        'redirect' => null
    ); 
    echo json_encode($ok);
  }
  else {
      session_start();
      $_SESSION['id'] = $resultat_login['id'];
      $_SESSION['login'] = $login;
      $ok = array(
        'valid' => true,
        'redirect' => 'index.php?section=admin_index'
      ); 
      echo json_encode($ok);

  }
