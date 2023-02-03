<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modules</title>
</head>

<body>




    <h1>Administration des Modules</h1>
    <a href="modules/create" class="btn btn-primary custom-button2">Créer un nouveau module</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Nombre d'heures</th>
                <th scope="col">Formation</th>
                <th scope="col">Couleur</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $module) : ?>
                <tr>
                    <th scope="row"><?= $module->id ?></th>
                    <td><?= $module->name ?></td>
                    <td><?= $module->total_hours ?></td>
                    <?php foreach ($formations as $formation) : ?>
                        <?php if ($module->formation_id === $formation->id) { ?>
                            <td><?= $formation->name ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <td>
                        <span style="background-color: <?= $module->color ?>;color: <?= $module->color ?>!important;
                                    border-radius: 50px;color: white;text-align: center;font-weight: 400;line-height: 45px;display: block;width: 45px;">' ' </span>
                    </td>




                    <td>
                        <a href="/modules/update/<?= $module->id ?>" class="btn btn-primary custom-button2">Modifier</a>
                        <form action="/modules/delete/<?= $module->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-primary custom-button">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>