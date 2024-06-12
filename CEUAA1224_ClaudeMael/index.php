<?php       // non fermé car seulement du php
    //démarrage de l'objet SESSION
    session_start();
    // fichier de configuration
    require_once("Config/connectDataBase.php");
    
    require_once("Controllers/indexController.php");
    require_once("Controllers/userController.php");
    require_once("Controllers/schoolController.php");
    require_once("Controllers/conversationController.php");
    // on ajoutera par la suite le fichier des constantes.

   