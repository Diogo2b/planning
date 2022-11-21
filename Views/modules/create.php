<h1><?= $module->name ?? 'Créer un nouveau module' ?></h1>
<?php
if ($params && $params['data']["name"]) {
    $lastname = $params['data']["name"];
}

if ($params && $params['data']["total_hours"]) {
    $lastname = $params['data']["total_hours"];
}
?>


<?php if (isset($_SESSION['errors'])) : ?>
    <?php foreach ($_SESSION['errors'] as $error) : ?>
        <div class="alert alert-danger">
            <li><?= $error ?></li>
        </div>
    <?php endforeach ?>
<?php endif ?>

<?php $_SESSION['errors'] = [] ?>



<form action="/modules/create" method="POST">
    <div class="form-group">
        <label for="name">Nom du module</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>">
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
        <input type="text" class="form-control" name="total_hours" id="total_hours" value="<?php echo isset($total_hours) ? $total_hours : '' ?>">
        <?php
        if (isset($errors) && array_key_exists('total_hours', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['total_hours'] ?></li>
            </div>
        <?php } ?>

    </div>
    <button type="submit" class="btn btn-primary">Enregistrer mon Module</button>
</form>