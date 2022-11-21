<body>
    <h1>Administration des resources</h1>
    <a href="resources/create" class="btn btn-success my-3">Créer ressource</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resources as $resource) : ?>
                <tr>
                    <th scope="row"><?= $resource->id ?></th>
                    <td><?= $resource->name ?></td>

                    <td>
                        <a href="/resources/update/<?= $resource->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/resources/delete/<?= $resource->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>