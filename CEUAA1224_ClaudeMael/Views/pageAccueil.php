<!-- corps de la page d'accueil qui prendra place dans le main de base.php -->
<!-- Selon la page (accueil ou mes écoles) on affiche le titre qui convient-->
<?php if ($uri === "/mesEcoles") : ?>
    <h1>Vos écoles</h1>   
<?php else :?>
    <h1>Liste des écoles répertoriées</h1>
<?php endif ?>

<!-- Dans le cas où on est connecté, on affiche un lien permettant l'ajout d'une école -->
<?php if (isset($_SESSION["user"])) : ?>
    <a href="createSchool" class="lienModif">Ajouter une école</a>
<?php endif ?>

<div class="flexible wrap space-around">
    <?php foreach ($schools as $school) : ?>
        <div class="border card">
            <h2 class="center"><?= $school->schoolNom ?></h2>
            <div>
                <div class="flexible blocImageEcole">
                    <img src="<?= $school->schoolImage ?>" alt="photo de l'école" >
                </div>
                <div class="center">
                    <p><span><?=$school->schoolAdresse ?> - </span><span><?= $school->schoolCodePostal . " " . $school->schoolVille ?></span></p>
                    <h3><?=$school->schoolNumero ?></h3>
                    <!-- il reste encore à adapter le lien pour retrouver l'école active : Paramètre type GET faisant référence à l'ID ! -->
                    <a href="voirEcole?schoolId=<?=$school->schoolId ?>" class="btn btn-page">Voir l'école</a>
                    <!-- Dans le cas où on est connecté et qu'on a cliqué sur 'mes écoles', on affiche les écoles de l'utilisateur -->
                    <?php if ($uri === "/mesEcoles") : ?>
                        <div class="flexible space-between">
                            <p><a href="deleteEcole?schoolId=<?=$school->schoolId ?>" class="petitsLiens lienModif">Supprimer l'école</a></p>
                            <p><a href="updateEcole?schoolId=<?=$school->schoolId ?>" class="petitsLiens lienModif">Modifier l'école</a></p>
                         </div>
                    <?php endif ?>

                </div>
            </div>
        </div>  
    <?php endforeach ?>      
</div>