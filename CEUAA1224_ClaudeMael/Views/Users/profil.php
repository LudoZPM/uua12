<h1>Page profil</h1>
<div class="blocCentre">
    <p><span>Nom : </span><?= $_SESSION["user"]->nomUser ?></p>
    <p><span>Prénom : </span><?= $_SESSION["user"]->prenomUser ?></p>
    <p><span>Email : </span><?= $_SESSION["user"]->emailUser ?></p>
    <p><span>Login : </span><?= $_SESSION["user"]->loginUser ?></p>
    <p><span>Mot de passe : </span><?= $_SESSION["user"]->passWordUser ?></p>
    <div class="flexible space-between">   
        <div class="petitsLiens">
            <a href="updateProfil">Modifier</a>
        </div>
        <div class="petitsLiens">
            <a href="deleteProfil">Supprimer</a>
        </div>
    </div> 
</div>
