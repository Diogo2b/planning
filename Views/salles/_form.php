<?php
$fields = ['name', 'site_id'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($salle) ? "/salles/update/{$salle->id}" : "/salles/create" ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom de salle</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $salle->name ?? $name ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="site_id">Site</label>
        <select class="form-control" id="site_id" name="site_id">
            <option value="" selected hidden>-- Veuillez choisir un site --</option>
            <?php foreach ($sites as $site) : ?>
                <?php
                $isSelected = '';
                if ((isset($salle) && $salle->site_id === $site->id) || (isset($site_id) && (int)$site_id === $site->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $site->id ?>" <?= $isSelected ?>>
                    <?= $site->name ?>
                </option>
            <?php endforeach ?>
        </select>

        <?php
        if (isset($errors) && array_key_exists('site_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['site_id'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary custom-button2"><?= isset($salle) ? 'Enregistrer les modifications' : 'Créer la salle' ?></button>
</form>