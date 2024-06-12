<?php

/*
Fonction selectAllSchools
-------------------------
BUT : aller rechercher les caractéristiques de toutes les écoles dans la base de données 
IN : $pdo reprenant toutes les informations de connexion
OUT : objet pdo contenant toutes les écoles de la base de données
*/

function selectAllSchools($pdo)
{
    try {
        //définition de la requête
        $query = 'select * from school';
        //préparation de l'exécution de la requête
        $selectSchool = $pdo->prepare($query);
        //exécution
        $selectSchool->execute();
        //récupération des données dans l'objet fetch
        $schools = $selectSchool->fetchAll();
        //renvoi des données
        return $schools;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction deleteAllSchoolsFromUsers
----------------------------------
BUT : supprimer toutes les écoles liées à l'utilisateur connecté dans la table school
IN : $pdo reprenant toutes les informations de connexion
*/
function deleteAllSchoolsFromUser($pdo)
{
    try {
        //requête avec critère et paramètre !
        $query = 'delete from school where utilisateurId = :utilisateurId';
        $deleteAllSchoolsFromId = $pdo->prepare($query);
        $deleteAllSchoolsFromId->execute([
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction selectMySchools
----------------------------------
BUT : aller rechercher les caractéristiques des écoles de l'utilisateur connecté dans la base de données 
IN : $pdo reprenant toutes les informations de connexion
OUT : objet pdo contenant les écoles de l'utilisateur connecté de la base de données
*/
function selectMySchools($pdo)
{
    try {
        //requête avec critère et paramètre !
        $query = 'select * from school where utilisateurId = :utilisateurId';
        $selectSchool = $pdo->prepare($query);
        $selectSchool->execute([
            //le paramètre est l'id de l'utilisateur connecté
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);
        $schools = $selectSchool->fetchAll();
        return $schools;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction selectAllOptions
----------------------------------
BUT : aller rechercher les caractéristiques de toutes les options disponibles dans la base de données 
IN : $pdo reprenant toutes les informations de connexion
OUT : objet pdo contenant la liste de toutes les options existantes de la base de données
*/
function selectAllOptions($pdo)
{

    try {

        $query = 'SELECT * FROM optionscolaire';
        $selectOptions = $pdo->prepare($query);
        $selectOptions->execute();
        $options = $selectOptions->fetchAll();
        return $options;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

/*
Fonction createSchool
-------------------------
BUT : ajouter les données d'une école encodées par l'utilisateur dans la table school 
IN : $pdo reprenant toutes les informations de connexion
*/
function createSchool($pdo)
{
    try {
        $query = 'insert into school (schoolNom, schoolAdresse, schoolVille, schoolCodePostal, schoolNumero, schoolImage, utilisateurId) values (:schoolNom, :schoolAdresse, :schoolVille, :schoolCodePostal, :schoolNumero, :schoolImage, :utilisateurId)';
        $addSchool = $pdo->prepare($query);
        $addSchool->execute([
            'schoolNom' => $_POST["nom"],
            'schoolAdresse' => $_POST["adresse"],
            'schoolVille' => $_POST["ville"],
            'schoolCodePostal' => $_POST["code_postal"],
            'schoolNumero' => $_POST["numero_telephone"],
            'schoolImage' => $_POST["image"],
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction ajouterOptionEcole
---------------------------
BUT : ajouter les données d'une école encodées par l'utilisateur dans la table school 
IN : $pdo reprenant toutes les informations de connexion
     $schoolId identifiant de la dernière école ajoutée à la table des écoles
     $optionId identifiant de l'option à ajouter
*/
function ajouterOptionEcole($pdo,$schoolId,$optionId)
{
    try {
        $query='insert into option_ecole (schoolId, optionScolaireId) values (:schoolId, :optionScolaireId)';
        $deleteAllSchoolsFromId = $pdo->prepare($query);
        $deleteAllSchoolsFromId->execute([
            'schoolId' => $schoolId,
            'optionScolaireId' => $optionId     
        ]);
    } catch (\PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction selectOneSchool
-------------------------
BUT : aller rechercher les caractéristiques de l'école active dans la base de données 
IN : $pdo reprenant toutes les informations de connexion
OUT : objet pdo contenant toutes les informations concernant l'écoles active
*/

function selectOneSchool($pdo)
{
    try {
        $query = 'select * from school where schoolId = :schoolId';
        $selectSchool = $pdo->prepare($query);
        $selectSchool->execute([
            'schoolId' => $_GET["schoolId"] //récupération du paramètre se trouvant dans l'adresse
        ]);
        $school = $selectSchool->fetch();   //récupération d'un enregistrement (pas fetchAll)
        return $school;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction selectOptionsActiveSchool
----------------------------------
BUT : aller rechercher  dans la base de données les caractéristiques des options de l'école affichée 
IN : $pdo reprenant toutes les informations de connexiondi
OUT : objet pdo contenant la liste des options de l'école affichée 
*/
function selectOptionsActiveSchool($pdo)
{
    try {
        $query = 'select * from optionscolaire where optionScolaireId in (select optionScolaireId from option_ecole where schoolId = :schoolId);';
        $selectOptions = $pdo->prepare($query);
        $selectOptions->execute([
            'schoolId' => $_GET["schoolId"]
        ]);
        $options = $selectOptions->fetchAll();
        return $options;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction updateSchool
-------------------------
BUT : mettre à jour les données de l'école active dans la table school 
IN : $pdo reprenant toutes les informations de connexion
*/
function updateSchool($dbh)
{
    try {
        $query = 'update school set schoolNom = :schoolNom, schoolAdresse = :schoolAdresse, schoolVille = :schoolVille, 
        schoolCodePostal = :schoolCodePostal, schoolNumero = :schoolNumero, schoolImage = :schoolImage where schoolId = :schoolId';
        $updateSchoolFromId = $dbh->prepare($query);
        $updateSchoolFromId->execute([
            'schoolNom' => $_POST["nom"],
            'schoolAdresse' => $_POST["adresse"],
            'schoolVille' => $_POST["ville"],
            'schoolCodePostal' => $_POST["code_postal"],
            'schoolNumero' => $_POST["numero_telephone"],
            'schoolImage' => $_POST["image"],
            'schoolId' => $_GET["schoolId"]     //école active
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction deleteOptionSchool
-------------------------
BUT : supprimer les options de l'école active dans la table options
IN : $pdo reprenant toutes les informations de connexion
*/
function deleteOptionSchool($dbh)
{
    try {
        $query = 'delete from option_ecole where schoolId = :schoolId';
        $deleteAllSchoolsFromId = $dbh->prepare($query);
        $deleteAllSchoolsFromId->execute([
            'schoolId' => $_GET["schoolId"]     //école active
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
/*
Fonction deleteOneSchool
-------------------------
BUT : supprimer une école dans la table school
IN : $pdo reprenant toutes les informations de connexion
*/
function deleteOneSchool($pdo)
{
    try {
        $query = 'delete from school where schoolId = :schoolId';
        $deleteAllSchoolsFromId = $pdo->prepare($query);
        $deleteAllSchoolsFromId->execute([
            'schoolId' => $_GET["schoolId"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}