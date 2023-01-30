<?php if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) : ?>
  <!-- condition si c'est un admin il auras le menu de dragables -->
  <p>

    <strong>Evénements Disponibles</strong>
  </p>
  <?php foreach ($modules as $module) : ?>

    <div class='calendrier fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
      <div id="fc-event-main" class='event fc-event-main' data-id="<?= $module->id ?>"><?= $module->name ?></div>
    </div>

  <?php endforeach ?>

<?php endif ?>