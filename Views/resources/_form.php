<?php
$fields = ['name'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($resource) ? "/resources/update/{$resource->id}" : "/resources/create" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de ressource</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $resource->name ?? $name ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($resource) ? 'Enregistrer les modifications' : 'Créer la ressource' ?></button>
</form>