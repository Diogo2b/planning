<?php
$fields = ['name', 'session_id'];
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
    <div class="form-group">
        <label for="session_id">Session</label>
        <select class="form-control" id="session_id" name="session_id">
            <option value="" selected hidden>-- Veuillez choisir une session --</option>
            <?php foreach ($sessions as $session) : ?>
                <?php
                $isSelected = '';
                if ((isset($resource) && $resource->session_id === $session->id) || (isset($session_id) && (int)$session_id === $session->id)) {
                    $isSelected = 'selected';
                }
                ?>
                <option value="<?= $session->id ?>" <?= $isSelected ?>>
                    <?= $session->start ?>h-<?= $session->end ?>h
                </option>
            <?php endforeach ?>
        </select>

        <?php
        if (isset($errors) && array_key_exists('session_id', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['session_id'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($resource) ? 'Enregistrer les modifications' : 'Créer la ressource' ?></button>
</form>