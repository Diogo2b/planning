<?php
$fields = ['name'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<h1>Créer un nouveau Rôle d'utilisateur</h1>
<form action="/roles/create" method="POST">

    <div class="form-group">
        <label for="name">Nom du rôle</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>

    </div>



    <button type="submit" class="btn btn-primary">Enregistrer le rôle</button>
</form>