<?php 

//fonction createUser. But : ajouter les données encodées par l'utilisateur dans la table des utilisateurs 

function createUser($pdo) 
{
    try {
        //définition de la requête d'insertion en utilisant la notion de paramètre 
        $query = 'insert into utilisateurs (nomUser, prenomUser, loginUser, passwordUser, emailUser, role)
        values (:nomUser, prenomUser, loginUser, passwordUser, emailUser, role) ';
        //préparation de la requête 
        $ajouterUser = $pdo->prepare($query) ;
        //éxecution en attribuant les valeurs récupérées dans le formulaire aux paramètres 
        $ajouterUser->execute( [
            'nomUser' => $_POST["nom"],
            'prenomnomUser' => $_POST["prenom"],
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'role' => 'user'
        ]);
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }
}


//fonction connectUser. But : rechercher les données de l'utilisateur dans la base de données pour les mémoriser dans la variable session  

function connectUser($pdo)
{
    try {

        //définition de la requête select en utilisant la notion de paramètre
        $query = 'select * from utilisateurs where loginUser = :loginUser and passWordUser';

        //préparation de la requête 
        $connectUser = $pdo->prepare($query);

        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres 
        $connectUser->execute([
            'loginUser' => $_POST["login"],
            'passWorUser' => $_POST["mot_de_passe"]
        ]);

        //stockage des données trouvées dans la variable $user 
        $user = $connectUser->fetch();

        if(!$user) {

            return false;   
        }

        else {

            //ajout de celle-ci à la variable session
            $_SESSION["user"] = $user;
            return true;
        }
        
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die ($message);
    }
}

// fonction verifEmptyData. But : remplir et envoyer un tableau associatif $messageError dont les clés sont les noms des champs avec un message rappelant que le champ concerné est vide, ou renvoyer false si on n'a pas rencontré d'erreurs.

function verifEmptyData()
{
    // parcours du tableau $_POST en recherchant les éléments vides ou munis d'espaces
    foreach ($_POST as $key => $value) {

        //str-replace remplace une chaine par une autre dans une chaine de caractères donnée, ici un espace par le vide dans $value.
        if (empty(str_replace(' ', '', $value))) {

            //on remplit un tableau associatif $messageError dont les clés sont les noms des champs avec un message rappelant que le champs concerné est vide.
            $messageError[$key] = "Votre" . $key . " est vide.";
        }
    }

    // si le tableau $messageError est vide, on renverra false, sinon, on renvoie le tableau
    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}


//fonction updateUser. But : modifier les données encodées par l'utilisateur dans la table des utilisateurs.

function updateUser($pdo)
{
    try {
        //définition de la requête de mise à jour en utilisant la notion de paramètre 
        //san oublier le critère ! pour ne pas modifier toutes les lignes de la table utilisateurs !

        $query = 'update utilisateur set nomUser = :nomUser, prenomUser :prenomUser, passWordUser = :passWordUser, emailUser = :emailUser where id = id';
        //préparation de la requête
        $ajouteUser = $pdo-> prepare($query);
        
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres 
        $ajouteUser->execute([
            'nomUser' => $_POST['nom'],
            'prenomUser' => $_POST['prenom'],
            'passWordUser' => $_POST['mot_de_passe'],
            'emailUser' => $_POST['email'],
            'id' => $_SESSION ["user"] ->id //récupération de l'id de l'utilisateur en session actuellement connecté
        ]);   
            
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }
}


//fonction updateSession. But : recharger les données actualisées de l'utilisateur dans la table des utilisateurs

function updateSession($pdo)
{
    try {
        $query = 'select * from utilisateurs where id = :id';
        $selectUser = $pdo->prepare($query);
        $selectUser-> execute ([
            'id' => $_SESSION["user"]->id //récupération de l'id de l'utilisateur en session actuellement connecté
        ]);

        $user = $selectUser->fetch(); // pas fetchAll car on ne veut qu'une ligne 
        $_SESSION["user"] = $user;

    } catch (PDOEXCEPTION $e) {
        $message = $e-> getMessage();
        die($message);
    }
}