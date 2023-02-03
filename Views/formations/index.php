<?php
// session_start();
// if (!isset($_SESSION['auth'])) {
//     header("Location: login");
//     exit;
// }
?>

<h1>Administration des Formations</h1>
<a href="formations/create" class="btn btn-primary custom-button">Créer une nouvelle Formation</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Saison</th>
            <th scope="col">Site</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($formations as $formation) : ?>
            <tr>
                <th scope="row"><?= $formation->id ?></th>
                <td><?= $formation->name ?></td>
                <td><?= $formation->season ?></td>
                <?php foreach ($sites as $site) : ?>
                    <?php if ($formation->site_id === $site->id) { ?>
                        <td><?= $site->name ?></td>
                    <?php  } ?>
                <?php endforeach ?>
                <td>
                    <a href="/formations/update/<?= $formation->id ?>" class="btn btn-primary custom-button2">Modifier</a>
                    <form action="/formations/delete/<?= $formation->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-primary custom-button">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>