<?php if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) : ?>
  <!-- condition si c'est un admin il aura le menu de dragables -->
  <p>

    <strong>Cours disponible</strong>
  </p>
  <?php foreach ($modules as $module) : ?>

    <div class='calendrier fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event' style="background-color:<?= $module->color ?>;border: none;height: 30px;">
      <div class='event fc-event-main module' data-name="<?= $module->name ?>" data-id="<?= $module->id ?>" data-color="<?= $module->color ?>" style="background-color:<?= $module->color ?>;border: none;"><?= $module->name ?></div>
    </div>

  <?php endforeach ?>

<?php endif ?>