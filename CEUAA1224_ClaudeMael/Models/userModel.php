<?php
/*
Fonction createUser
-------------------------
BUT : ajouter les données encodées par l'utilisateur dans la table des utilisateurs 
IN : $pdo reprenant toutes les informations de connexion
*/

function getUsers($pdo){
    try{
        $query = 'select * from utilisateurs where utilisateurId != ' . $_SESSION["user"]->utilisateurId;
        $execute = $pdo->prepare($query);
        $execute->execute();
        $users = $execute->fetchAll();
        return $users;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function createUser($pdo)
{
    try {
        //définition de la requête d'insertion en utilisant la notion de paramètre
        $query = 'insert into utilisateurs(nomUser, prenomUser, loginUser, passWordUser, emailUser, roleUser) 
        values (:nomUser, :prenomUser, :loginUser, :passWordUser, :emailUser, :role)';
        //préparation de la requête
        $ajouteUser = $pdo->prepare($query);
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres
        $ajouteUser->execute([
            'nomUser' => $_POST["nom"],
            'prenomUser' => $_POST["prenom"],
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'role' => 'user'
        ]);    
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);    }
}
/*
Fonction connectUser
-------------------------
BUT : rechercher les données de l'utilisateurs dans la base de données pour les mémoriser dans la variable session
IN : $pdo reprenant toutes les informations de connexion
OUT : vrai si $_Session a été remplie et donc la connexion est faite, faux sinon.
*/
function connectUser($pdo)
{
    try {
         //définition de la requête select en utilisant la notion de paramètre
        $query = 'select * from utilisateurs where loginUser = :loginUser and passWordUser = :passWordUser';
        //préparation de la requête
        $connectUser = $pdo->prepare($query);
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres
        $connectUser->execute([
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"]
        ]);
        //stokage des données trouvées dans la variable $user
        $user = $connectUser->fetch();
        if (!$user){
            return false;
        }
        else{
            //ajout de celle-ci à la variable session
            $_SESSION["user"] = $user;
            return true;
        }
        
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction updateUser
-------------------------
BUT : modifie les données encodées par l'utilisateur dans la table des utilisateurs 
IN : $pdo reprenant toutes les informations de connexion
*/
function updateUser($pdo)
{
    try {
        //définition de la requête de mise à jour en utilisant la notion de paramètre 
        //sans oublier le critère ! pour ne pas modifier toutes les lignes de la table utilisateurs !
        $query = 'update utilisateurs set nomUser = :nomUser, prenomUser = :prenomUser, passWordUser = :passWordUser,emailUser = :emailUser where utilisateurId = :utilisateurId';
        //préparation de la requête
        $majUser = $pdo->prepare($query);
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres
        $majUser->execute([
            'nomUser' => $_POST["nom"],
            'prenomUser' => $_POST["prenom"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'utilisateurId' => $_SESSION["user"]->utilisateurId // récupération de l'id de l'utilisateur en session actuellement connecté
        ]);    
    } catch (PDOEXCEPTION $e) {
        $message = $e->getMessage();
        die($message);    
    }
}
/*
Fonction updateSession
-------------------------
BUT : recharge les données actualisées de l'utilisateur dans la table des utilisateurs 
IN : $pdo reprenant toutes les informations du profil de l'utilisateur
*/
function updateSession($pdo)
{
    try {
        $query = 'select * from utilisateurs where utilisateurId = :utilisateurId';
        $selectUser = $pdo->prepare($query);
        $selectUser->execute([
            'utilisateurId' => $_SESSION["user"]->utilisateurId   // récupération de l'id de l'utilisateur en session actuellement connecté
        ]);
        $user = $selectUser->fetch(); // pas fetchAll car on ne veut qu'une ligne !
        $_SESSION["user"] = $user;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction DeleteUser
-------------------------
BUT : supprimer l'utilisateur connecté de la table des utilisateurs
IN : $pdo reprenant toutes les informations de connexion
*/
function DeleteUser($pdo)
{
    try {
        $query = 'delete from utilisateurs where utilisateurId = :utilisateurId';
        $delUser = $pdo->prepare($query);
        $delUser->execute([
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
 