<h1><?= $params['formation']->name ?></h1>

<?php if (isset($_SESSION['errors'])) : ?>

    <?php foreach ($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach ($errorsArray as $error) : ?>
            <div class="alert alert-danger">
                <li><?= $error ?></li>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>

<?php endif ?>

<?php $_SESSION['errors'] = [] ?>



<form action="/formations/update/<?= $formation->id ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de formation</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $formation->name ?>">
    </div>

    <div class="form-group">
        <label for="season">Saison de formation</label>
        <input type="text" class="form-control" name="season" id="season" value="<?= $formation->season ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>