    <h1>Administration des Formations</h1>
    <a href="formations/create" class="btn btn-success my-3">Créer une nouvelle Formation</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Saison</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formations as $formation) : ?>
                <tr>
                    <th scope="row"><?= $formation->id ?></th>
                    <td><?= $formation->name ?></td>
                    <td><?= $formation->season ?></td>
                    <td>
                        <a href="/formations/update/<?= $formation->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/formations/delete/<?= $formation->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>