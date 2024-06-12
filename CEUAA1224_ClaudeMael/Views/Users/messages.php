<ul>

    <?php foreach($users as $user) :?>
        <p>Discuter avec <a href="/conversation?utilisateurId=<?=$utilisateurs->utilisateurId?>"><?=$utilsateurs->nomUser?></a></p>
    <?php endforeach?>

</ul>
    <form method="post" action="">
    <div>
        <select name="options[]" id="options-select" multiple required>
        <?php foreach ($users as $user) : ?>
            <option value="<?= $user->utilisateurId ?>"><?=$user->nomUser?></option>
        <?php endforeach ?>
        </select>
    </div>
    <div>
        <button name="btnEnvoi" class="btn btn-primary">Envoyer</button>
    </div>

</form>