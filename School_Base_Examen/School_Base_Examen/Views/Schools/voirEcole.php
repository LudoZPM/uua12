<h1><?= $school->schoolNom ?></h1>
<img src="<?= $school->schoolImage ?>" alt="Image de l'école">
<div class="contenu flexible space-between">
    <div>
        <h2>Informations générales</h2>
        <p><?= $school->schoolAdresse ?></p>
        <p><span><?= $school->schoolVille ?></span> - <span><?= $school->schoolCodePostal ?></span></p>
        <p><?= phoneNumberFormatted($school->schoolNumero) ?></p>
    </div>
    <div>
        <h2>Options de l'école</h2>
        <table>
            <?php if (empty($options)) : ?>
                <tr>
                    <td>Il n'y a aucune option pour l'instant</td>
                </tr>
            <?php else : ?>
                <?php foreach ($options as $option) : ?>
                    <tr>
                        <td><?= $option->nom ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </table>
    </div>
</div>