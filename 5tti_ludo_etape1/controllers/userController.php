<?php

$uri = $_SERVER["REQUEST_URI"];
var_dump($uri);

if($uri === "/connexion") {
    //vérifier si l'utilisateur a cliqué sur le bouton du formulaire 
    
    if (isset($_POST['btnEnvoi'])) {
        //pour récupérer l'erreur si l'utilisateur fait une faute de frappe ou se trompe dans ses identifiants
        $erreur = false;
        //tentative de connexion et récupération des données de l'utilisateur et ouverture d'une session
       
        if (connectUser($pdo)) {
            //redirection vers la page d'accueil
            header("location:/");
        }  

        else{
            
            //cas d'erreur 
            $erreur = true;
        }
    }
    $title = "Connexion";
    $template = "views/users/connexion.php"; //chemin vers la vue demandée
    require_once("views/base.php"); // appel de la page qui sera remplie avec la vue demandée

}

elseif ($uri === "/deconnexion") {

    //nettoyage de la session et retour à l'accueil
    session_destroy();

    //redirection vers la page d'accueil
    header("location:/");

}

elseif ($uri === "/inscription") {
    if (isset($_POST ['btnEnvoi'])) {

        //vérification des données encodées
        $messageError = verifEmptyData();

        //s'il n'y a pas d'erreurs
        if (!$messageError) {

            //ajout de l'utilisateur à la base de données 
            createUser($pdo);

            //redirection vers la page de connexion
            header('location:/connexion');


        }
        
    }

    $title = "Inscription";
    $template = "views/users/inscriptionOrEditProfile.php";
    require_once("views/base.php"); // appel de la page qui sera remplie avec la vue demandée
}

else if ($uri === "/updateProfil") {

        if (isset($_POST['btnEnvoi'])) {
            //vérification des données encodées 
            $messageError = verifEmptyData();
            
            //S'il n' y a pas d'erreur        
            if(!$messageError) {

                //modifiction des données de l'utilisateur dans la base de données 
                updateUser($pdo);
                
                //mise à jour de la variable session 
                updateSession($pdo);

                //redireciton vers la page profil
                header('locartion:/profil');

            }
        }

    $title = "Mise à jour du profil";
    $template = "views/users/inscriptionOrEditProfile.php"; //chemin vers la vue demandée 
    require_once("views/base.php"); // appel de la page qui sera remplie avec la vue demandée
}

