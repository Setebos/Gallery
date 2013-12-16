<?php 
// var_dump($_SESSION);
include('app/modele/connect_db.php');

  if (isset($_POST['id'])) {
    var_dump($_POST['id']);
  }

// PUBLIC //////////////////////////////////////////////////////////////////////////////////////

if  (!isset($_GET['section']) OR $_GET['section'] == 'home')
{                    
  include_once("app/controleur/home_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'login')
{                    
  // include_once("app/vue/login.php");
  include_once("app/controleur/home_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'login_controller')
{                    
  include_once("app/controleur/login_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'logout_controller')
{                
  include_once("app/controleur/logout_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'autocomplete')
{                
  include_once("app/controleur/autocomplete.php");
}


// ADMIN //////////////////////////////////////////////////////////////////////////////////////

if  (isset($_GET['section']) AND $_GET['section'] == 'admin_index')
{                
  include_once("app/controleur/admin/admin_index_controller.php");
}


if  (isset($_GET['section']) AND $_GET['section'] == 'new_gallery')
{                
  include_once("app/vue/admin/new_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'create_gallery')
{                
  include_once("app/controleur/admin/create_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'admin_ajax_image')
{                
  include_once("app/controleur/admin/ajax_image_controller.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'delete_gallery')
{                
  include_once("app/controleur/admin/delete_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'edit_gallery')
{                
  include_once("app/controleur/admin/edit_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'update_gallery')
{                
  include_once("app/controleur/admin/update_gallery.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'new_image')
{                
  include_once("app/controleur/admin/new_image.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'upload_image')
{                
  include_once("app/controleur/admin/upload_image.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'reposition_image')
{                
  include_once("app/controleur/admin/reposition_image.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'new_category')
{                
  include_once("app/controleur/admin/new_category.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'create_category')
{                
  include_once("app/controleur/admin/create_category.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'create_category_from_header')
{                
  include_once("app/controleur/admin/create_category_from_header.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'delete_category')
{                
  include_once("app/controleur/admin/delete_category.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'edit_image')
{                
  include_once("app/controleur/admin/edit_image.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'update_image')
{                
  include_once("app/controleur/admin/update_image.php");
}

if  (isset($_GET['section']) AND $_GET['section'] == 'check_form')
{                
  include_once("app/controleur/admin/check_form.php");
}

