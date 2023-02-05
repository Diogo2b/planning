<?php
$fields = ['name', 'total_hours', 'formation_id', 'color'];
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
        <input type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" name="total_hours" id="total_hours" value="<?= $module->total_hours ?? $total_hours ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('total_hours', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['total_hours'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="formation_id">Formation</label>
        <select class="form-control" id="formation_id" name="formation_id">
            <option value="" selected hidden>-- Veuillez choisir la Formation --</option>
            <?php foreach ($formations as $formation) : ?>
                <?php
                $isSelected = '';
                if ((isset($module) && $module->formation_id === $formation->id) || (isset($formation_id) && (int)$formation_id === $formation->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $formation->id ?>" <?= $isSelected ?>>
                    <?= $formation->name ?>
                </option>
            <?php endforeach ?>
        </select>
        <?php
        if (isset($errors) && array_key_exists('formation_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['formation_id'] ?></li>
            </div>
        <?php } ?>
        <label for="color">Couleur du module</label>

        <select class="form-control" name="color" id="color">
            <option value="#f2d2c8" style="background-color: #f2d2c8; color: #000000;">Pastel Rose</option>
            <option value="#b3e7e8" style="background-color: #b3e7e8; color: #000000;">Pastel Bleu</option>
            <option value="#e8b3c8" style="background-color: #e8b3c8; color: #000000;">Pastel Violet</option>
            <option value="#c8e8b3" style="background-color: #c8e8b3; color: #000000;">Pastel Vert</option>
            <option value="#e8c8b3" style="background-color: #e8c8b3; color: #000000;">Pastel Jaune</option>
            <option value="#b3c8e8" style="background-color: #b3c8e8; color: #000000;">Pastel Turquoise</option>
            <option value="#c8b3e8" style="background-color: #c8b3e8; color: #000000;">Pastel Mauve</option>
            <option value="#e8e8b3" style="background-color: #e8e8b3; color: #000000;">Pastel Pêche</option>
            <option value="#c8e8e8" style="background-color: #c8e8e8; color: #000000;">Pastel Gris-Bleu</option>
            <option value="#b3e8c8" style="background-color: #b3e8c8; color: #000000;">Pastel Vert-Bleu</option>
            <option value="#e8c8e8" style="background-color: #e8c8e8; color: #000000;">Pastel Gris-Violet</option>
            <option value="#c8b3b3" style="background-color: #c8b3b3; color: #000000;">Pastel Rose-Gris</option>
            <option value="#b3c8c8" style="background-color: #b3c8c8; color: #000000;">Pastel Bleu-Gris</option>
            <option value="#e8e8e8" style="background-color: #e8e8e8; color: #000000;">Pastel Gris-Clair</option>
            <option value="#c8c8b3" style="background-color: #c8c8b3; color: #000000;">Pastel Jaune-Gris</option>
            <option value="#b3b3c8" style="background-color: #b3b3c8; color: #000000;">Pastel Turquoise-Gris</option>
            <option value="#e8c8c8" style="background-color: #e8c8c8; color: #000000;">Pastel Gris-Rose</option>
            <option value="#c8e8b3" style="background-color: #c8e8b3; color: #000000;">Pastel Vert-Jaune</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary custom-button2"><?= isset($module) ? 'Enregistrer les modifications' : 'Créer le module' ?></button>
</form>