<h1><?= $role->name ?></h1>

<form action="/roles/update/<?= $role->id ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom du rôle</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $role->name ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer utilisateur</button>
</form>