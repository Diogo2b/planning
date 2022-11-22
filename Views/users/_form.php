<?php
$fields = ['lastname', 'firstname', 'password', 'email', 'phone_number', 'adress', 'city'];
foreach ($fields as $field) {
    if (isset($previousData) && $previousData[$field]) {
        $$field = $previousData[$field];
    }
}
?>

<form action="<?= isset($user) ? "/users/update/{$user->id}" : "/users/create" ?>" method="POST">
    <div class="form-group">
        <label for="lastname">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $user->lastname ?? $lastname ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('lastname', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['lastname'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="firstname">Prénom d'utilisateur</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $user->firstname ?? $firstname ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('firstname', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['firstname'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="text" class="form-control" name="password" id="password" value="<?= $user->password ?? $password ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('password', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['password'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
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
        <label for="phone_number">Télephone</label>
        <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?= $user->phone_number ?? $phone_number ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('phone_number', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['phone_number'] ?></li>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="adress">Adresse Postale</label>
        <input type="text" class="form-control" name="adress" id="adress" value="<?= $user->adress ?? $adress ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('adress', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['adress'] ?></li>
            </div>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" class="form-control" name="city" id="city" value="<?= $user->city ?? $city ?? '' ?>">
        <?php
        if (isset($errors) && array_key_exists('city', $errors)) {
        ?>
            <div class="alert alert-danger">
                <li><?php echo $errors['city'] ?></li>
            </div>
        <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= isset($user) ? 'Enregistrer les modifications' : "Créer l'utilisateur" ?></button>
</form>