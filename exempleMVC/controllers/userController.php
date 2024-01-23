<?php

$uri = $_SERVER["REQUEST_URI"];
var_dump($uri);
if($uri === "/connexion") {
    var_dump("coucou");
    $title = "Connexion";
    $template = "views/users/connexion.php";
    require_once("views/base.php");

}

elseif ($uri === "/deconnexion") {
    //voir plus tard

}

elseif ($uri === "/inscription") {
    $title = "Inscription";
    $template = "views/users/inscriptionOrEditProfile.php";
    require_once("views/base.php");
}


