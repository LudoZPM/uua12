<?php
require_once("Models\userModel.php");
require_once("Models\messageModel.php");
if(isset($_GET["utilisateurId"]) && $uri === "/conversation?utilisateurId=" . $_GET["utilisateurId"]){
    if(isset($_SESSION["user"])){
        $check = verifConversation($pdo);
        if(!$verif){
            createConversation($pdo);
        }
        $verif = verifConversation($pdo);
        
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
}
if ($uri === "/message") {
    // récupérer toutes les données de la table school
    
        $utilisateurs = SelectAllUser($pdo);
        $title = "Mes messages";
        $template = "Views\message\message.php";
        require_once("Views/base.php");
}           //appel de la page de base qui sera remplie avec la vue demandée

if ($uri === "/conversation") {
    // récupérer toutes les données de la table school
    
        $conversation = selectConversation($pdo) ;
        $title = "Mes conersations";
        $template = "Views\conversation\conversation.php";
        require_once("Views/base.php");
} 
