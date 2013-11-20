<?php
// var_dump($_SESSION);
    session_start();
    $_SESSION=array();
    session_destroy(); 
    // var_dump($_SESSION);
    include_once('app/vue/home.php');
