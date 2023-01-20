<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src='../fullcalendar/dist/index.global.js'></script>
  <!-- <script src='[![](https://data.jsdelivr.com/v1/package/npm/@fullcalendar/interaction/badge)](https://www.jsdelivr.com/package/npm/@fullcalendar/interaction)'></script> -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <title>Document</title>


  <script>
    // import { Calendar } from '@fullcalendar/core';
    // import interactionPlugin, { Draggable } from '@fullcalendar/interaction';



    // $(document).ready(function () {
    //       load()});
    document.addEventListener('DOMContentLoaded', function() {
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;
      load()
      var draggableEl = document.getElementById('external-events');
      var calendarEl = document.getElementById('calendrier');
      var checkbox = document.getElementById('drop-remove');


      new Draggable(draggableEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {

          return {
            //Renvoyer l'ajax des events ici pour pouvoir les voirs

            title: eventEl.innerText,
            // start: eventEl.startStr,
            // end: eventEl.end,



          };

        }
      })




      function load() {
        loadModuleDraggable()
        loadEventCalendar()
      } // }
      function loadModuleDraggable() {
        var loadEventCalendars = $('#select_form').val()
        $.ajax({
          url: '/event',
          dataType: 'HTML',
          type: 'POST',
          data: {
            event: loadEventCalendars
          },
          success: function(response) {

            let events = $("#external-events").html(response)

          },
          error: function() {
            alert("Erroreeeeeee !");
          }
        })
      }

      function loadEventCalendar() {
        var loadEventCalendars = $('#select_form').val();


        $.ajax({
          url: '/calendriers',
          dataType: 'JSON',
          type: 'POST',
          data: {
            events: loadEventCalendars
          },
          success: function(response) {
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendrier');

            ;

            var calendar = new Calendar(calendarEl, {
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',

              },

              slotMinTime: '08:00',
              slotMaxTime: '18:00',
              weekends: false,
              initialView: 'timeGridWeek',
              editable: true,
              droppable: true,
              displayEventEnd: true,
              defaultTimedEventDuration: '04:00',
              timeZone: 'locale',
              eventReceive: function(info) {

                ende = info.event.start
                ende.setHours(info.event.start.getHours() + 4)
                info.event.setEnd(ende)
                console.log(info.event.endStr)
                let end_receive = info.event.endStr
                let start_receive = info.event.startStr



                $.ajax({
                  url: '/modal',
                  dataType: 'HTML',
                  type: 'POST',
                  data: {

                    end: end_receive,
                    start: start_receive
                  },
                  success: function(response) {
                    $('.modal-content').html(response);
                    $('#MaModal').modal('show');

                    // console.log(start_receive)

                  },
                  error: function() {
                    alert("Errore dans l'ajax d'eventReceiv !");
                  }
                })


              },
              eventDrop: function(info) {

                console.log(info.event.startStr)
                console.log(info.event.endStr)

              },
              eventResize: function(info) {

              }


            });

            Object.values(response).forEach(response => {

              calendar.addEvent({
                title: ['title'],
                start: response['start'],
                end: response['end'],

              })

            });

            calendar.render();

          },


          error: function(error) {
            alert('error ajax loadeventcalendar');

          }
        });
      }

    })


    function create_session() {
      let selector_profs = $("#select_prof").val();
      let selector_salle = $("#select_salle").val();
      let selector_class = $("#select_form").val();
      let start_receive = $("#start_selector").val();
      let end_receive = $("#end_selector").val();
      const module = $("#fc-event-main");
      let id_module_receive = module.data('id');

      $.ajax({
        url: '/modal_CreatePost',
        dataType: 'JSON',
        type: 'POST',
        data: {
          profs: selector_profs,
          salle: selector_salle,
          classe: selector_class,
          id_module: id_module_receive,
          end: end_receive,
          start: start_receive
        },
        success: function(response) {
          $('.modal-content').html(response);
          $('#MaModal').modal('show');

          // console.log(start_receive)

        },
        error: function() {
          alert("Errore dans de création !");
        }
      })


    }
  </script>
</head>

<body>

  <div class="input-group mb-3 col-4">
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

  <div class="d-inline-flex col-12">

    <!-- //Zone d'evenement draggable -->
    <div id='external-events' class='col-2'>
    </div>
    <!-- //Zone de calendrier -->
    <div id='calendrier' class='col-8'>
    </div>
    <!-- //Modal sur callBack EventReceiv -->
    <div class="modal fade " id="MaModal" backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
      </div>
    </div>




</body>

</html>