<h1><?= $module->name ?></h1>
<?php if (isset($_SESSION['errors'])) : ?>

    <?php foreach ($error as $errorsArray) : ?>
        <?php foreach ($errorsArray as $error) : ?>
            <div class="alert alert-danger">
                <li><?= $error ?></li>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>

<?php endif ?>

<?php $_SESSION['errors'] = [] ?>



<form action="<?= "/modules/update/{$module->id}" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de module</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $module->name ?>">
    </div>

    <div class="form-group">
        <label for="total_hours">Nombre d'heures total du module</label>
        <input type="number" class="form-control" name="total_hours" id="total_hours" value="<?= $module->total_hours ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>