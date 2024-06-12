<div class="flex space-evenly wrap">
    <form method="post" action="">
        <fieldset>
            <legend>Se connecter</legend>
            <div class="mb-3">
                <label for="Login" class="form-label">Login</label>
                <input type="text" placeholder="Login" class="form-control" id="login" aria-describedby="emailHelp" name="login" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Mot de passe</label>
                <input type="password" placeholder="Mot de passe" class="form-control" id="password" name="mot_de_passe" required>
            </div>
            <div>
                <button name="btnEnvoi" class="btn btn-primary">Envoi</button>
            </div>
        </fieldset>
        <div>
            <h4 class="text-danger">Pas encore inscrit ?</h4>
            <a href="inscriptionOrEditProfil.php" class="btn btn-secondary">Cliquez ici !</a>
        </div>
    </form>
</div>
<!-- en cas d'erreur : message -->
<?php if(isset($erreur)) : ?>
    <?php if($erreur) : ?>
        <div class=alert><p>Tapez des identifiants corrects ! </p></div>
    <?php endif ?>
<?php endif ?>