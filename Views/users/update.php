<h1><?= $params['user']->firstname ?></h1>


<?php if (isset($_SESSION['errors'])) : ?>

    <?php foreach ($_SESSION['errors'] as $errorsArray) : ?>
        <?php foreach ($errorsArray as $error) : ?>
            <div class="alert alert-danger">
                <li><?= $error ?></li>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>

<?php endif ?>

<?php $_SESSION['errors'] = [] ?>



<form action="/users/update/<?= $user->id ?>" method="POST">
    <div class="form-group">
        <label for="lastname">Nom d'utilisateur</label>
        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $user->lastname ?>">
    </div>

    <div class="form-group">
        <label for="firstname">Prénom d'utilisateur</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $user->firstname ?>">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="text" class="form-control" name="password" id="password" value="<?= $user->password ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>">
    </div>

    <div class="form-group">
        <label for="phone_number">Télephone</label>
        <input type="number" class="form-control" name="phone_number" id="phone_number" value="<?= $user->phone_number ?>">
    </div>

    <div class="form-group">
        <label for="adress">Adresse Postale</label>
        <input type="text" class="form-control" name="adress" id="adress" value="<?= $user->adress ?>">
    </div>

    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" class="form-control" name="city" id="city" value="<?= $user->city ?>">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer utilisateur</button>
</form>