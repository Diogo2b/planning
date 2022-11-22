<?php
$fields = ['name', 'season'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($formation) ? "/formations/update/{$formation->id}" : "/formations/create" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de formation</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $formation->name ?? $name ?? '' ?>">
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
        <input type="text" class="form-control" name="season" id="season" value="<?= $formation->season ?? $season ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('season', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['season'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($formation) ? 'Enregistrer les modifications' : 'Créer la formation' ?></button>
</form>