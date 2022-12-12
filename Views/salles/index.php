    <h1>Administration des Salles</h1>
    <a href="salles/create" class="btn btn-success my-3">Créer une nouvelle Salle</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Site</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salles as $salle) : ?>
                <tr>
                    <th scope="row"><?= $salle->id ?></th>
                    <td><?= $salle->name ?></td>

                    <?php foreach ($sites as $site) : ?>
                        <?php if ($salle->site_id === $site->id) { ?>
                            <td><?= $site->name ?></td>
                        <?php  } ?>
                    <?php endforeach ?>
                    <td>
                        <a href="/salles/update/<?= $salle->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/salles/delete/<?= $salle->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>