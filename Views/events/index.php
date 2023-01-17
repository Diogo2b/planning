<p>
<strong>Draggable Events</strong>
</p>
    <?php foreach ($modules as $module) : ?>
        
  <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
    <div id="fc-event-main" class='fc-event-main' data-id="<?= $module->id?>"><?= $module->name ?></div>
  </div>
  
  <?php endforeach ?>
  <p>
    <input type='checkbox' id='drop-remove' />
    <label for='drop-remove'>remove after drop</label>
  </p>
</div>

