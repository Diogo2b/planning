<?php
$fields = ['name', 'total_hours', 'user_id'];
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
        <label for="total_hours">Nombre d'heures total du module</label>
        <input type="text" class="form-control" name="total_hours" id="total_hours" value="<?= $module->total_hours ?? $total_hours ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('total_hours', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['total_hours'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="user_id">Intervenant</label>
        <select class="form-control" id="user_id" name="user_id">
            <option value="" selected hidden>-- Veuillez choisir un Intervenant --</option>
            <?php foreach ($users as $user) : ?>
                <?php
                $isSelected = '';
                if ((isset($module) && $module->user_id === $user->id) || (isset($user_id) && (int)$user_id === $user->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $user->id ?>" <?= $isSelected ?>>
                    <?= $user->lastname ?> <?= $user->firstname ?>
                </option>
            <?php endforeach ?>
        </select>

        <?php
        if (isset($errors) && array_key_exists('user_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['user_id'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($module) ? 'Enregistrer les modifications' : 'Créer le module' ?></button>
</form>