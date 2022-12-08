<?php
$fields = ['name', 'season', 'site'];
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
    <div class="form-group">
        <label for="site_id">Site</label>
        <select class="form-control" id="site_id" name="site_id">
            <option value="" selected hidden>-- Veuillez choisir un site --</option>
            <?php foreach ($sites as $site) : ?>
                <?php
                $isSelected = '';
                if ((isset($user) && $user->site_id === $site->id) || (isset($site_id) && (int)$site_id === $site->id)) {
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
    <button type="submit" class="btn btn-primary"><?= isset($formation) ? 'Enregistrer les modifications' : 'Créer la formation' ?></button>
</form>