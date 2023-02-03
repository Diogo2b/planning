<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afloschool</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'styles.css' ?>">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light  ">
        <a class="navbar-brand" href="login">
            <img src="assets\logoAfloschool.png" alt="logo" style="height: 50px; float: left; margin-right: 10px;">
            <span class="aflo-text" style="color: #45544e;white-space: nowrap;">Aflo</span>
            <span class="school-text" style="color: #9c0101;white-space: nowrap;">School</span>
        </a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) : ?>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <li class="nav-item">
                        <a class="nav-link" href="/formations">Formations</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/modules">Modules</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/resources">Ressources</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/users">Utilisateurs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/roles">Rôles</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/sites">Sites</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/salles">Salles</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/sessions">Sessions</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/calendriers">Planning</a>
                    </li>
                <?php endif ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" onclick="logout()">Se déconnecter</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>
</body>

</html>