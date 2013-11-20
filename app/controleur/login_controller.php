<?php
  include("ressources/config.php");
  include_once("app/modele/UserManager.php");

  $login = $_POST['login'];
  $password = $_POST['password'];

  $manager = new UserManager($db);

  $resultat_login = $manager->login($login, $password);

  if (!$resultat_login) {
          echo 'Mauvais identifiant ou mot de passe !';
          include_once('app/vue/index.php');
  }
  else {
      session_start();
      $_SESSION['id'] = $resultat_login['id'];
      $_SESSION['login'] = $login;
      include_once('app/vue/admin/index.php');
  }

?>
