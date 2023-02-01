<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <script src='../fullcalendar/dist/index.global.js'></script>
  <link rel="stylesheet" href="../public/css/styles_calendar.scss">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>  
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="iziToast.min.js" type="text/javascript"></script>
  <script src="../app/JS/function.js"></script>
  <link rel="stylesheet" href="iziToast.min.css">
  <title>Document</title>


  <script>

    document.addEventListener('DOMContentLoaded', function() {
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;
      load()
      var draggableEl = document.getElementById('external-events');
      var calendarEl = document.getElementById('calendrier');
      


      new Draggable(draggableEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {

          return {
            

            title: eventEl.innerText,
           



          };

        }
      })
    })



  </script>
</head>

<body>
<!-- //Selecteur de classe (affiché uniquement lorsque l'utilisateur connecté a le role id égal a 1(admin).) -->
  <div class="classe_selecteur" style=<?php echo ($_SESSION['role_id'] === 1) ? 'display:block' : 'display:none';?>>
    <select class="form-select" onchange="load()" id="select_form">
      <?php if ($formations->id === $module->formation_id) { ?>
        <?php
        $i = 0;
        foreach ($formations as $formation) : $i++; ?>
          <option id="formation<?= $i ?>" value="<?= $formation->id ?>"><?= $formation->name ?></option>
        <?php endforeach ?>
      <?php } ?>
    </select>
  </div>
  <input type="text"  id="select_user" style="display:none" value ="<?= $_SESSION['auth']?>">
    <!-- //Zone d'evenement draggable -->
    <div id='external-events' class="container_event" >
    </div>
    <!-- //Zone de calendrier -->
    <div id='calendrier'>
    </div>
    <!-- //Modal sur callBack EventReceiv -->
    <div class=" modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="MaModal" backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modalContainer modal-content">
        </div>
      </div>
    </div>
</body>

</html>