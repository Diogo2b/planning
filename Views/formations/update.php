<h1><?= $formation->name ?></h1>

<form action="/formations/update/<?= $formation->id ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de formation</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $formation->name ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="season">Saison de formation</label>
        <input type="text" class="form-control" name="season" id="season" value="<?= $formation->season ?>">
        <?php
        if (isset($errors) && array_key_exists('season', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['season'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>