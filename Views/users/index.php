<h1>Administration des Utilisateurs</h1>
<a href="users/create" class="btn btn-success my-3">Créer un nouveau utilisateur</a>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Mot de passe</th>
            <th scope="col">Adresse mail</th>
            <th scope="col">Télephone</th>
            <th scope="col">Adresse Postale</th>
            <th scope="col">Ville</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->lastname ?></td>
                <td><?= $user->firstname ?></td>
                <td><?= $user->password ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->adress ?></td>
                <td><?= $user->city ?></td>

                <td>
                    <a href="/users/update/<?= $user->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/users/delete/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>