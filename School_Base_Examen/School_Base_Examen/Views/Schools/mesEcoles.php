<h1>Mes Ecoles</h1>
<?php if (isset($_SESSION["user"])) : ?><a href="createSchool">Ajouter une école</a><?php endif ?>
<div class="flexible wrap justify-content-center">
    <?php foreach ($schools as $school) : ?>
        <div class="bordure center blocAffichage">
            <h2><?= $school->schoolNom ?></h2>
            <img src="<?= $school->schoolImage ?>" alt="Photo de l'école">
            <p><span><?= $school->schoolAdresse ?> - </span><span><?= $school->schoolVille ?></span></p>
            <p><?= phoneNumberFormatted($school->schoolNumero) ?></p>
            <p><a href="voirEcole?schoolId=<?= $school->schoolId ?>">Voir l'école</a></p>
            <?php if ($uri === "/mesEcoles") : ?>
                <p><a href="deleteEcole?schoolId=<?= $school->schoolId ?>">Supprimer l'école</a></p>
                <p><a href="updateEcole?schoolId=<?= $school->schoolId ?>">Modifier l'école</a></p>
            <?php endif ?>
        </div>
    <?php endforeach ?>
</div>