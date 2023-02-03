<h1>Administration des Utilisateurs</h1>
<a href="users/create" class="btn btn-primary custom-button2">Créer un nouveau utilisateur</a>
<?php if (isset($_GET['success'])) : ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
<?php endif ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>

            <th scope="col">Adresse mail</th>
            <th scope="col">Télephone</th>
            <th scope="col">Adresse Postale</th>
            <th scope="col">Ville</th>
            <th scope="col">Role</th>

            <th scope="col">Actions</th>

        </tr>
    </thead>
    <tbody>

        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->id ?></th>
                <td><?= $user->firstname ?></td>
                <td><?= $user->lastname ?></td>

                <td><?= $user->email ?></td>
                <td><?= $user->phone_number ?></td>
                <td><?= $user->adress ?></td>
                <td><?= $user->city ?></td>
                <?php foreach ($roles as $role) : ?>
                    <?php if ($user->role_id === $role->id) { ?>
                        <td><?= $role->name ?></td>
                    <?php  } ?>
                <?php endforeach ?>



                <td>
                    <a href="/users/update/<?= $user->id ?>" class="btn btn-primary custom-button2">Modifier</a>
                    <form action="/users/delete/<?= $user->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-primary custom-button">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>