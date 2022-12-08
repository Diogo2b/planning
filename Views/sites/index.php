<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sites</title>
</head>

<body>




    <h1>Administration des Sites</h1>
    <a href="sites/create" class="btn btn-success my-3">Créer un nouveau site</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>

                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sites as $site) : ?>
                <tr>
                    <th scope="row"><?= $site->id ?></th>
                    <td><?= $site->name ?></td>

                    <td>
                        <a href="/sites/update/<?= $site->id ?>" class="btn btn-warning">Modifier</a>
                        <form action="/sites/delete/<?= $site->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>