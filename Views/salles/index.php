<?php
if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) {
?>
    <h1>Administration des Salles</h1>
    <a href="salles/create" class="btn btn-primary custom-button2">Créer une nouvelle Salle</a>

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
                        <a href="/salles/update/<?= $salle->id ?>" class="btn btn-primary custom-button2">Modifier</a>
                        <form action="/salles/delete/<?= $salle->id ?>" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-primary custom-button">Supprimer</button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
<?php
} else {

    echo '<div class="alert alert-danger"> vous devez être connecté  </div>';
    return $this->view('auth.login');
}
?>