<?php

function checkConversation($pdo){
    try{
        $query = 'SELECT * FROM utilisateur_conversation natural join conversation where utilisateurId = :utilisateurIdConnected and conversationId in (SELECT conversationId FROM utilisateur_conversation where utilisateurId = :utilisateurId) and conversationType = "binaire";';
        $execute = $pdo->prepare($query);
        $execute->execute([
            'utilisateurIdConnected' => $_SESSION["user"]->utilisateurId,
            'utilisateurId' => $_GET["utilisateurId"]
        ]);
        $conversation = $execute->fetch();
        
        return $conversation;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function createConversation($pdo){
    try{
        $query = "insert into conversation(conversationType) values('binaire')";
        $execute = $pdo->prepare($query);
        $execute->execute();

        
        $query = "insert into utilisateur_conversation(conversationId, utilisateurId) values((select MAX(conversationId) from conversation), :utilisateurId)";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'utilisateurId' => $_GET["utilisateurId"]
        ]);

        $query = "insert into utilisateur_conversation(conversationId, utilisateurId) values((select MAX(conversationId) from conversation), :utilisateurId)";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);
    }catch(PDOException $e){
        die($e->getMessage());
    }
}



function createConversationGroupe($pdo){
    try{
        $query = "insert into conversation(conversationType) values('groupe')";
        $execute = $pdo->prepare($query);
        $execute->execute();
        
        
        $query = "insert into utilisateur_conversation(conversationId, utilisateurId) values((select MAX(conversationId) from conversation), :utilisateurId)";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'utilisateurId' => $_SESSION["user"]->utilisateurId
        ]);

        foreach($_POST["options"] as $users){

            $query = "insert into utilisateur_conversation(conversationId, utilisateurId) values((select MAX(conversationId) from conversation), :utilisateurId)";
            $execute = $pdo->prepare($query);
            $execute->execute([
                'utilisateurId' => $users
            ]);
        }
        $query = "select MAX(conversationId) as convID from conversation";
        $execute = $pdo->prepare($query);
        $execute->execute();
        $max = $execute->fetch();
        return $max;

    }catch(PDOException $e){
        die($e->getMessage());
    }
}



function addMessage($pdo){
    try{
        $query = "insert into message(messageText, messageDate, messageHeure, utilisateurId, conversationId) values(:messageText, :messageDate, :messageHeure, :utilisateurId, :conversationId)";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'messageText' => $_POST["message"],
            'messageDate' => date("Y-m-d"),
            'messageHeure' => date("h:i:s"),
            'utilisateurId' => $_SESSION["user"]->utilisateurId,
            'conversationId' => $_GET["conversationId"]
        ]);

    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function getMessages($pdo){
    try{
        $query = "select * from message WHERE conversationId = :conversationId order by messageDate, messageHeure;";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'conversationId' => $_GET["conversationId"]
        ]);
        $messages = $execute->fetchAll();
        return $messages;
    }catch(PDOException $e){
        die($e->getMessage());
    }
}

function deleteMessage($pdo){
    $query = "select * from message where messageId = :messageId";
    $execute = $pdo->prepare($query);
    $execute->execute([
        'messageId' => $_GET["messageId"]
    ]);
    $messages = $execute->fetch();

    if($messages->messageText === "Message supprimé par son rédacteur"){
        $query = "delete from message where messageId = :messageId";
        $execute = $pdo->prepare($query);
        $execute->execute([
            'messageId' => $_GET["messageId"]
        ]);
    } else{
        $query = 'update message set messageText = "Message supprimé par son rédacteur" where messageId = :messageId';
        $execute = $pdo->prepare($query);
        $execute->execute([
            'messageId' => $_GET["messageId"]
        ]);
    }

}