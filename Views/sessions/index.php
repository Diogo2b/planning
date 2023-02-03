<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions</title>
</head>

<body>

    <h1>Administration des Sessions</h1>
    <a href="sessions/create" class="btn btn-success my-3">Créer une nouvelle session</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Debut de session</th>
                <th scope="col">Fin de session</th>
                <th scope="col">Salle</th>
                <th scope="col">Formation</th>
                <th scope="col">Module</th>
                <th scope="col">Intervenant</th>


                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sessions as $session) : ?>
                <?php

                $date_start = new DateTime($session->start);
                $date_start_french = $date_start->format('d-m-Y H:i');
                $date_end = new DateTime($session->end);
                $date_end_french = $date_end->format('d-m-Y H:i')
                ?>
                <tr>
                    <th scope="row"><?= $session->id ?></th>
                    <td><?= $date_start_french ?></td>
                    <td><?= $date_end_french ?></td>
                    <?php foreach ($salles as $salle) : ?>
                        <?php if ($session->salle_id === $salle->id) { ?>
                            <td><?= $salle->name ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <?php foreach ($formations as $formation) : ?>
                        <?php if ($session->formation_id === $formation->id) { ?>
                            <td><?= $formation->name ?> Saison:<?= $formation->season ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <?php foreach ($modules as $module) : ?>
                        <?php if ($session->module_id === $module->id) { ?>
                            <td><?= $module->name ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <?php foreach ($users as $user) : ?>
                        <?php if ($session->user_id === $user->id) { ?>
                            <td><?= $user->firstname ?> <?= $user->lastname ?></td>
                        <?php  } ?>
                    <?php endforeach ?>


                    <td>
                        <a href="/sessions/update/<?= $session->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/sessions/delete/<?= $session->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>