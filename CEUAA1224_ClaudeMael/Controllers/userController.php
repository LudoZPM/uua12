<?php   // code php qui décide de ce qu'il faut donner comme valeur à la variable $template

//appel aux modèles
require_once("Models/userModel.php");

// récupération du chemin désiré
$uri = $_SERVER["REQUEST_URI"];

if ($uri === "/connexion") {
    
    // vérifier si l'utilisateur a cliqué sur le bouton du formulaire
    if(isset($_POST['btnEnvoi'])){
        // pour récupérer l'erreur si l'utilisateur fait une faute de frappe ou se trompe dans ses identifiants
        $erreur=false;
        // tentative de connexion et récupération des données de l'utilisateur et ouverture d'une session
        if(connectUser($pdo)){
            // redirection vers mes écoles
            header("location:/mesEcoles");
        }
        else{
            //cas d'erreur
            $erreur=true;
        }
    }
    $title = "Connexion";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/connexion.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === "/deconnexion") {      // on anticipe pour la suite
    // nettoyage de la session et retour à l'accueil
    session_destroy();
    header("location:/");
}
elseif ($uri ==="/inscription") {
    if(isset($_POST['btnEnvoi'])){
        // vérification des données encodées
        $messageError = verifEmptyData();
        // s'il n'y a pas d'erreur
        if(!$messageError){
            // ajout de l'utiliateur à la base de données
            createUser($pdo);
            //redirection vers la page de connexion
            header('location:/connexion');
        }
    }
    $title = "Inscription";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/inscriptionOrEditProfile.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri ==="/profil") {
    $title = "Profil";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/profil.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri ==="/updateProfil") {
    if(isset($_POST['btnEnvoi'])){
        // vérification des données encodées

        $messageError = verifEmptyData();
        // s'il n'y a pas d'erreur
        if(!$messageError){
            // Modification des données de l'utiliateur dans la base de données
            updateUser($pdo);
            var_dump('coucou');
            // Mise à jour de la variable session
            updateSession($pdo);
            //redirection vers la page de profil
            header('location:/profil');
        }
    }
    $title = "Mise à jour du profil";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/inscriptionOrEditProfile.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === "/deleteProfil") {
    deleteAllSchoolsFromUser($pdo);             //supprimer toutes les informations de la table école liées à l'utilisateur connecté
    deleteUser($pdo);                              //supprimer l'utilisateur de la table des utilisateurs
    header("location:/deconnexion");            //le déconnecter
}


function verifEmptyData()
{
    foreach ($_POST as $key => $value) {
        if($key != 'btnEnvoi')
        {
            if (empty(str_replace(' ', '', $value))) {
                $messageError[$key] = "Votre " . $key . " est vide.";
            }
        }    
    }
    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}