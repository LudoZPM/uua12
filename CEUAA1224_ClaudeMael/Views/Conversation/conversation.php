<h1>Vos messages</h1>
<?php foreach($messages as $message) :?>

    <p><?=$message->messageText?> 
    <?php if($message->utilisateurId == $_SESSION["user"]->utilisateurId) :?>
        <a href="/deleteMessage?messageId=<?=$message->messageId?>">X</a>
        <?php endif?>
    </p>

<?php endforeach?>

<form method="post" action="">
    <legend>Ajouter un message</legend>
    <fieldset>
        
    <div>
    <label for="message">Votre message</label>
        <textarea name="message" id="textarea" cols="33" rows="5" required></textarea>
    </div>
    <div>
        <button name="btnEnvoi" class="btn btn-primary">Envoyer</button>
    </div>
    </fieldset>



</form>

