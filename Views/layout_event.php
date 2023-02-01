<?php if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) : ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        <div class="container">
            <?= $content_event ?>
        </div>
    </body>

    </html>
    <?php endif ?>