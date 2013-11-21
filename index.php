<?php 
// var_dump($_SESSION);
include('app/modele/connect_db.php');

if  (!isset($_GET['section']) OR $_GET['section'] == 'home')
{                    
  include_once("app/controleur/home_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'login')
{                    
  include_once("app/vue/login.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'login_controller')
{                    
  include_once("app/controleur/login_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'logout_controller')
{                
  include_once("app/controleur/logout_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'new_gallery')
{                
  include_once("app/vue/admin/new_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'admin_index')
{                
  include_once("app/vue/admin/index.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'create_gallery')
{                
  include_once("app/controleur/admin/create_gallery.php");
}