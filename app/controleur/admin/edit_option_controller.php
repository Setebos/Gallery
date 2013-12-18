<?php

include_once("app/modele/OptionManager.php");
include_once("app/modele/Option.php");

$id = $_GET["id"];

$managerOption = new OptionManager($db);
$option = $managerOption->getOption($id);
