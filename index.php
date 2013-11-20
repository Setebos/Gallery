<?php 

include('app/modele/connect_db.php');

if  (!isset($_GET['section']) OR $_GET['section'] == 'index')
{                    
  include_once("app/vue/home.php");
}
if  ($_GET['section'] == 'login')
{                    
  include_once("app/vue/login.php");
}

if  ($_GET['section'] == 'login_controller')
{                    
  include_once("app/controleur/login_controller.php");
}

// else
// {
//   if($_GET['do']=="affichage")
//   {
//     require("action/class_example.php");
//     new Example();
//   }
// }
