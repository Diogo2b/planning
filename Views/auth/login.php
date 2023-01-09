<h1>Se connecter</h1>
<form action="/login" method="POST">
    <div class="form-group">
        <label for="email">Mail d'utilisateur</label>
        <input type="text" class="form-control" name="email" id="email" value="<?= $user->email ?? $email ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('email', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['email'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" value="<?= $user->password ?? $password ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('password', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['password'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>