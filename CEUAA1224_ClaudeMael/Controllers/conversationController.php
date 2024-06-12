<?php

require_once("Models/conversationModel.php");
if(isset($_GET["utilisateurId"]) && $uri === "/conversation?utilisateurId=" . $_GET["utilisateurId"]){
    if(isset($_SESSION["user"])){
        $check = checkConversation($pdo);
        if(!$check){
            createConversation($pdo);
        }
        $check = checkConversation($pdo);
        
        header('location:/conversation?conversationId=' . $check->conversationId);
    } else{
        header('location:/index.php');
    }
} elseif(isset($_GET["conversationId"]) && $uri === "/conversation?conversationId=" . $_GET["conversationId"]){
    if(isset($_SESSION["user"])){
        if(isset($_POST['btnEnvoi'])){
            if(!explode(" ", $_POST["message"]) == ""){
                addMessage($pdo);
            }
            header('location:/conversation?conversationId='. $_GET["conversationId"]);
        }
        $messages = getMessages($pdo);
        $title = "Conversation";
        $template = "Views/Conversation/conversation.php";
        require_once("Views/base.php");

    }
}elseif(isset($_GET["messageId"]) && $uri === "/deleteMessage?messageId=" . $_GET["messageId"]){
    if(isset($_SESSION["user"])){
        deleteMessage($pdo);
        header('location:/messages');
    }

}elseif($uri === "/messages"){
    if(isset($_SESSION["user"])){
        if(isset($_POST['btnEnvoi'])){
            $conversation = createConversationGroupe($pdo);
            header('location:/conversation?conversationId=' . $conversation->convID);
        }
        $users = getUsers($pdo);
        $title = "Mes messages";
        $template = "Views/Users/messages.php";
        require_once("Views/base.php");
    }
}