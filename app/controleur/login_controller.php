<?php
  include("ressources/config.php");
  include_once("app/modele/UserManager.php");

  $login = $_POST['login'];
  $password = $_POST['password'];

  $manager = new UserManager($db);

  $resultat_login = $manager->login($login, $password);

  if (!$resultat_login) {
          echo 'Mauvais identifiant ou mot de passe !';
          include_once('app/controleur/home_controller.php');
  }
  else {
      session_start();
      $_SESSION['id'] = $resultat_login['id'];
      $_SESSION['login'] = $login;
      // var_dump($_SESSION);
      include_once('app/controleur/admin/admin_index_controller.php');
  }
