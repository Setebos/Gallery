<?php

include_once("app/modele/OptionManager.php");
include_once("app/modele/Option.php");


if(isset($_POST["show_entire_gallery"])) {
    $show_entire_gallery = htmlspecialchars($_POST["show_entire_gallery"]);
}
if(isset($_POST["diaporama_width"])) {
    $diaporama_width = htmlspecialchars($_POST["diaporama_width"]);
    if(!is_numeric($diaporama_width)) { // Valeur par défaut si l'utilisateur a rentré autre chose qu'un nombre
        $diaporama_width = 800;
    } else {
        if($diaporama_width < 300) { // Ajustement si l'utilisateur a choisi des valeurs en dehors de celles autorisées
            $diaporama_width = 300;
        }
        if($diaporama_width > 1000) {
            $diaporama_width = 1000;
        }
    }
    
}
if(isset($_POST["nb_images_per_line"])) {
    $nb_images_per_line = htmlspecialchars($_POST["nb_images_per_line"]);
    if(!is_numeric($nb_images_per_line)) { // Valeur par défaut si l'utilisateur a rentré autre chose qu'un nombre
        $nb_images_per_line = 3;
    }
    if($nb_images_per_line < 1) { // Ajustement si l'utilisateur a choisi des valeurs en dehors de celles autorisées
        $nb_images_per_line = 1;
    }
    if($nb_images_per_line > 8) {
        $nb_images_per_line = 8;
    }
}
if(isset($_POST["display_duration"])) {
    $display_duration = htmlspecialchars($_POST["display_duration"]);
    if(!is_numeric($display_duration)) { // Valeur par défaut si l'utilisateur a rentré autre chose qu'un nombre
        $display_duration = 2000;
    } else {
        if($display_duration < 1000) { // Ajustement si l'utilisateur a choisi des valeurs en dehors de celles autorisées
            $display_duration = 1000;
        }
        if($display_duration > 10000) {
            $display_duration = 10000;
        }
    }
    
}

$managerOption = new OptionManager($db);

$newOption = new Option(array(
    'id' => 1,
    'show_entire_gallery' => $show_entire_gallery,
    'diaporama_width' =>$diaporama_width,
    'nb_images_per_line' =>$nb_images_per_line,
    'display_duration' =>$display_duration,
));

    $option = $managerOption->getOption($id);
    $option = $managerOption->updateOption($newOption);




