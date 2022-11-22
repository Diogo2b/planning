<h1><?= $module->name ?></h1>

<form action="<?= "/modules/update/{$module->id}" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de module</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $module->name ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="total_hours">Nombre d'heures total du module</label>
        <input type="number" class="form-control" name="total_hours" id="total_hours" value="<?= $module->total_hours ?>">
        <?php
        if (isset($errors) && array_key_exists('total_hours', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['total_hours'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>