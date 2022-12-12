<?php
$fields = ['start', 'end'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($session) ? "/sessions/update/{$session->id}" : "/sessions/create" ?>" method="POST">
    <div class="form-group">
        <label for="start">Debut de session</label>
        <input type="text" class="form-control" name="start" id="start" value="<?= $session->start ?? $start ?? '' ?>">
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
        <input type="text" class="form-control" name="end" id="end" value="<?= $session->end ?? $end ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('end', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['end'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($session) ? 'Enregistrer les modifications' : 'Créer le session' ?></button>
</form>