<?php
$fields = ['start', 'end', 'salle_id', 'formation_id', 'module_id', 'user_id'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($session) ? "/sessions/update/{$session->id}" : "/sessions/create" ?>" method="POST">
    <div class="form-group">
        <label for="start">Debut de session</label>
        <input type="datetime-local" min="datetime-local" class="" format="YYYY-MM-DD HH:mm" name="start" id="start" value="<?= $session->start ?? $start ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('start', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['start'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="end">Fin de session</label>
        <input type="datetime-local" min="datetime-local" class="form-control" format="YYYY-MM-DD HH:mm" name="end" id="end" value="<?= $session->end ?? $end ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('end', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['end'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="salle_id">Salle</label>
        <select class="form-control" id="salle_id" name="salle_id">
            <option value="" selected hidden>-- Veuillez choisir une salle --</option>
            <?php foreach ($salles as $salle) : ?>
                <?php
                $isSelected = '';
                if ((isset($session) && $session->salle_id === $salle->id) || (isset($salle_id) && (int)$salle_id === $salle->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $salle->id ?>" <?= $isSelected ?>>
                    <?= $salle->name ?>
                </option>
            <?php endforeach ?>
        </select>

        <?php
        if (isset($errors) && array_key_exists('salle_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['salle_id'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="formation_id">Formation</label>
        <select class="form-control" id="formation_id" name="formation_id">
            <option value="" selected hidden>-- Veuillez choisir un formation --</option>
            <?php foreach ($formations as $formation) : ?>
                <?php
                $isSelected = '';
                if ((isset($session) && $session->formation_id === $formation->id) || (isset($formation_id) && (int)$formation_id === $formation->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $formation->id ?>" <?= $isSelected ?>>
                    <?= $formation->name ?> Saison:<?= $formation->season ?>
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
    </div>
    <div class="form-group">
        <label for="module_id">Module</label>
        <select class="form-control" id="module_id" name="module_id">
            <option value="" selected hidden>-- Veuillez choisir un module --</option>
            <?php foreach ($modules as $module) : ?>
                <?php
                $isSelected = '';
                if ((isset($session) && $session->module_id === $module->id) || (isset($module_id) && (int)$module_id === $module->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $module->id ?>" <?= $isSelected ?>>
                    <?= $module->name ?>
                </option>
            <?php endforeach ?>
        </select>

        <?php
        if (isset($errors) && array_key_exists('module_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['module_id'] ?></li>
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
                if ((isset($session) && $session->user_id === $user->id) || (isset($user_id) && (int)$user_id === $user->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $user->id ?>" <?= $isSelected ?>>
                    <?= $user->firstname ?> <?= $user->lastname ?>
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
    <button type="submit" class="btn btn-primary custom-button"><?= isset($session) ? 'Enregistrer les modifications' : 'Créer le session' ?></button>
</form>