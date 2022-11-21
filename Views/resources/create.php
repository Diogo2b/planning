<h1>Créer une nouvelle ressource</h1>

<form action="/resources/create" method="POST">
    <div class="form-group">
        <label for="name">Nom de resource</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>">
        <?php
        if (isset($errors) && array_key_exists('name', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['name'] ?></li>
            </div>
        <?php } ?>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer ressource</button>
</form>