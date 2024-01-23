<?php

    $uri = $_SERVER["REQUEST_URI"];

    if ($uri === "/index.php" || $uri === "/") {
        $title = "Page d'accueil";
        $template = "views/pageAccueil.php";
        require_once("views/base.php");
    }