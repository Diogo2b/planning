<h1>Administration des Rôles d'utilisateur</h1>
<a href="roles/create" class="btn btn-primary custom-button2">Créer un nouveau Rôle d'utilisateur</a>

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
                    <a href="/roles/update/<?= $role->id ?>" class="btn btn-primary custom-button2">Modifier</a>
                    <form action="/roles/delete/<?= $role->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-primary custom-button">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>