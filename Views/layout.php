<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afflokat Planning</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
</head>

<body>
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success">Vous êtes connecté!</div>
    <?php endif ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Afflokat Planning</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/formations">Formations</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/modules">Modules</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/resources">Ressources</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Utilisateurs</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/roles">Rôles</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/sites">Sites</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/salles">Salles</a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/sessions">Sessions</a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a class="nav-link" href="/calendriers">Planning</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Se déconnecter</a>
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