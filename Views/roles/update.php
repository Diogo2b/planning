<h1><?= $params['role']->name ?></h1>

<?php if (isset($_SESSION['errors'])) : ?>

    <?php foreach ($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach ($errorsArray as $error) : ?>
            <div class="alert alert-danger">
                <li><?= $error ?></li>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>

<?php endif ?>





<form action="/roles/update/<?= $role->id ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom du rôle</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $role->name ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer utilisateur</button>
</form>