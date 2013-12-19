<?php

include_once("app/modele/OptionManager.php");
include_once("app/modele/Option.php");

// $id = $_POST["id"];



if(isset($_POST["show_entire_gallery"])) {
    $show_entire_gallery = htmlspecialchars($_POST["show_entire_gallery"]);
}
if(isset($_POST["diaporama_width"])) {
    $diaporama_width = htmlspecialchars($_POST["diaporama_width"]);
}
if(isset($_POST["nb_images_per_line"])) {
    $nb_images_per_line = htmlspecialchars($_POST["nb_images_per_line"]);
}
if(isset($_POST["display_duration"])) {
    $display_duration = htmlspecialchars($_POST["display_duration"]);
}

$managerOption = new OptionManager($db);

$newOption = new Option(array(
    'id' => 1,
    'show_entire_gallery' => $show_entire_gallery,
    'diaporama_width' =>$diaporama_width,
    'nb_images_per_line' =>$nb_images_per_line,
    'display_duration' =>$display_duration,
));

var_dump($newOption);

    $option = $managerOption->getOption($id);
    $option = $managerOption->updateOption($newOption);

    // header('Location: index.php?section=admin_index');  




