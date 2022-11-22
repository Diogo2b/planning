<?php
$fields = ['name', 'total_hours'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($module) ? "/modules/update/{$module->id}" : "/modules/create" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom du module</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $module->name ?? $name ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="total_">Nombre d'heures total du module</label>
        <input type="text" class="form-control" name="total_hours" id="total_hours" value="<?= $module->total_hours ?? $total_hours ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('total_hours', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['total_hours'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($module) ? 'Enregistrer les modifications' : 'Créer le module' ?></button>
</form>