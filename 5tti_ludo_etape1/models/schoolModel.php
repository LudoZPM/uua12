<?php

    function selectAllSchools ($pdo) 
    {

        try {

            //défintiion de la requête
            $query = 'select * from school';

            //préparation de l'éxécution de la requête 
            $selectSchool = $pdo->prepare($query);

            //éxecution
            $selectSchool->execute();

            //récupération des données dans l'objet fetch
            $schools = $selectSchool-> fetchAll();

            //renvoi des données 
            return $schools;

        } catch (PDOException $e) {
            $message = $e-> getMessage();
            die ($message);
        }
    }