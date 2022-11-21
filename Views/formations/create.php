<?php

$fields = ['name', 'season'];
foreach ($fields as $field) {
    if ($params && $data[$field]) {
        $$field = $data[$field];
    }
}
?>
<h1>Créer une nouvelle formation</h1>


<form action="/formations/create" method="POST">
    <div class="form-group">
        <label for="name">Nom de formation</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="season">Saison</label>
        <input type="text" class="form-control" name="season" id="season" value="<?php echo isset($season) ? $season : '' ?>">
        <?php
        if (isset($errors) && array_key_exists('season', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['season'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer Formation</button>
</form>