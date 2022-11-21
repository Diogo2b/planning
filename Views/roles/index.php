<h1>Administration des Rôles d'utilisateur</h1>
<a href="roles/create" class="btn btn-success my-3">Créer un nouveau Rôle d'utilisateur</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role) : ?>
            <tr>
                <th scope="row"><?= $role->id ?></th>
                <td><?= $role->name ?></td>


                <td>
                    <a href="/roles/update/<?= $role->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/roles/delete/<?= $role->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>