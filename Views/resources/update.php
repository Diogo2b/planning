<h1><?= $resource->name ?></h1>

<form action="<?= "/resources/update/{$resource->id}" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de ressource</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $resource->name ?>">
    </div>
    <?php
    if (isset($errors) && array_key_exists('name', $errors)) {
    ?>
        <div class="alert alert-danger">
            <li><?php echo $errors['name'] ?></li>
        </div>
    <?php } ?>

    <button type="submit" class="btn btn-info">Enregistrer les modifications</button>
</form>