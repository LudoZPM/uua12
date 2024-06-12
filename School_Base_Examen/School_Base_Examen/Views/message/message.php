<h1>bienvenue dans message</h1>


<h3>Utilisateurs disponible: </h3>
<li>

<?php foreach ($utilisateurs as $utilisateur) : ?>
        
    <p>Discuter avec <a href="/conversation?utilisateurId=<?=$utilisateur->utilisateurId?>"><?=$utilisateur->nomUser?></a></p>

    <?php endforeach ?>
    <div>
        <select name="options[]" id="options-select" multiple required>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <a href="/conversation"><option value="<?= $utilisateur->utilisateurId ?>"><?=$utilisateur->nomUser?></option></a>
        <?php endforeach ?>
        </select>
        
    </div>
    <div>
        <button name="btnEnvoi" class="btn btn-primary">Envoyer</button>
    </div>
    


</li>