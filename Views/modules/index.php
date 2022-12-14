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
    <a href="modules/create" class="btn btn-success my-3">Créer un nouveau module</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Nombre d'heures</th>
                <th scope="col">Session</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modules as $module) : ?>
                <tr>
                    <th scope="row"><?= $module->id ?></th>
                    <td><?= $module->name ?></td>
                    <td><?= $module->total_hours ?></td>
                    <?php foreach ($sessions as $session) : ?>
                        <?php if ($module->session_id === $session->id) { ?>
                            <td><?= $session->start ?>/<?= $session->end ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <td>
                        <a href="/modules/update/<?= $module->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/modules/delete/<?= $module->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>