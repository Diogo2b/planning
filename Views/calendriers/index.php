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
    })




      function load() {
        loadModuleDraggable()
        loadEventCalendar()
      } 
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
        let id_user = $('#select_user').val();
        console.log("//////////////////////");
        console.log(id_user);
        console.log("/////////////////////");
        $.ajax({
          url: '/calendriers',
          dataType: 'JSON',
          type: 'POST',
          data: {
            events: loadEventCalendars,
            user_id:id_user
          },
          success: function(response) {
            console.log(response['role']);
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendrier');
            var isEditable = response['role']
            var windowWidth = window.innerWidth;
            var windowHeight = window.innerHeight;
            (windowWidth < 765) ? console.log("ok") : console.log('pas ok')

            

            var calendar = new Calendar(calendarEl, {
              // headerToolbar: {
               
              //   left:'title',
              //   center: false ,
                

              // },
              buttonText:{
                today: 'Aujourd\'hui'
              
              },
              locale:'fr',
              height:'auto',
              width:'auto',
              // themeSystem: 'bootstrap5',
              allDaySlot: false,
              slotMinTime: '08:00',
              slotMaxTime: '18:00',
              weekends: false,
              initialView: ($(window).width() < 765) ? 'timeGridDay':'timeGridWeek',
              editable: (isEditable==1) ? true : false,
              droppable: true,
              displayEventEnd: true,
              defaultTimedEventDuration: '04:00',
              timeZone: 'locale',
              eventOverlap: false,
              eventReceive: function(info) {
                

                ende = info.event.start
                ende.setHours(info.event.start.getHours() + 4)
                info.event.setEnd(ende)
                console.log('aaa')
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
                  },
                  error: function() {
                    alert("Error dans l'ajax d'eventReceiv !");
                  }
                })


              },
              eventDrop: function event_update(info) {

                let drop_profs = info.event.extendedProps.profs
                let drop_salle = info.event.extendedProps.salle
                let drop_class = info.event.extendedProps.formation
                let start_drop = info.event.startStr
                let end_drop = info.event.endStr
                let id_module_drop = info.event.extendedProps.module;
                let id_event = info.event.id


                $.ajax({
                  url: '/event_update',
                  dataType: 'HTML',
                  type: 'POST',
                  data: {
                    user: drop_profs,
                    salle: drop_salle,
                    formation: drop_class,
                    module: id_module_drop,
                    end: end_drop,
                    start: start_drop,
                    id: id_event
                  },
                  success: function(response) {
                    $('.modal-content').html(response);
                    $('#MaModal').modal('show');


                    // console.log(start_receive)

                  },
                  error: function() {
                    alert("Errore dans Update-Event !");
                  }
                })

              },
              eventResize: function(info) {

              },
              eventClick: function(info) {

                let drop_profs = info.event.extendedProps.profs
                let drop_salle = info.event.extendedProps.salle
                let drop_class = info.event.extendedProps.formation
                let start_drop = info.event.startStr
                let end_drop = info.event.endStr
                let id_module_drop = info.event.extendedProps.module;
                let id_event = info.event.id
                console.log(end_drop)

                $.ajax({
                  url: '/event_delete',
                  dataType: 'HTML',
                  type: 'POST',
                  data: {
                    user: drop_profs,
                    salle: drop_salle,
                    formation: drop_class,
                    module: id_module_drop,
                    end: end_drop,
                    start: start_drop,
                    id: id_event
                  },
                  success: function(response) {
                    $('.modal-content').html(response);
                    $('#MaModal').modal('show');
                    $('#MaModal').data('bs.modal', null);
                    $('#MaModal').modal({
                      backdrop: 'static',
                      keyboard: true,
                      show: true
                    });
                  },
                  error: function() {
                    alert("Errore dans Update-Event !");
                  }



                })


              },
              windowResize: function(info){
                
              }


            });

            Object.values(response.events).forEach(response => {
              console.log(response.events)
              calendar.addEvent({
                title: response['title'],
                start: response['start'],
                end: response['end'],
                id: response['id'],
                extendedProps: {
                  salle: response['salle_id'],
                  profs: response['user_id'],
                  module: response['module_id'],
                  formation: response['formation_id']
                }
              })

            });

            calendar.render();

          },


          error: function(error) {
            console.log(error);

          }
        });

       
      }

    


function create_session(){

      
      let selector_profs = $("#select_prof").val();
      let selector_salle = $("#select_salle").val();
      let selector_class = $("#select_form").val();
      let start_receive = $("#start_selector").val();
      let end_receive = $("#end_selector").val();
      const module = $("#fc-event-main");
      let id_module_receive = module.data('id');
      let title_module = $("#fc-event-main").text()

      $.ajax({
        url: '/modal_CreatePost',
        dataType: 'JSON',
        type: 'POST',
        data: {
          title: title_module,
          profs: selector_profs,
          salle: selector_salle,
          classe: selector_class,
          id_module: id_module_receive,
          end: end_receive,
          start: start_receive
        },
        success: function(response) {
          // 

          alert(response)

        },
        error: function() {
          alert("Errore dans de création !");
        }
      })


}
function delete_session(){
              let start_receive=$("#start_selector").val();
              let end_receive=$("#end_selector").val();
              const module = $("#fc-event-main");
              let id_module_receive=module.data('id');
              let event_id=$("#id_selector").val()
              $.ajax({
                            url: '/modal_DeletePost',
                            dataType: 'JSON',
                            type: 'POST',
                            data: {
                             
                              id_module:id_module_receive,
                              end:end_receive,
                              start:start_receive,
                              id: event_id
                            },
                            success: function (response) {
                              alert(response)
                              location.reload()

                              // console.log(start_receive)
                              
                            },
                            error: function() 
                            {
                                alert("Errore dans de modification !");
                            }
                        })




}
function update_session(){
                let selector_profs=$("#select_prof").val();
                let selector_salle=$("#select_salle").val();
                let selector_class=$("#select_form").val();
                let start_receive=$("#start_selector").val();
                let end_receive=$("#end_selector").val();
                const module = $("#fc-event-main");
                let id_module_receive=module.data('id');
                let event_id=$("#id_selector").val()
                
                
                $.ajax({
                            url: '/modal_UpdatePost',
                            dataType: 'JSON',
                            type: 'POST',
                            data: {
                              profs:selector_profs,
                              salle:selector_salle,
                              classe:selector_class,
                              id_module:id_module_receive,
                              end:end_receive,
                              start:start_receive,
                              id: event_id
                            },
                            success: function (response) {
                              alert(response)

                              // console.log(start_receive)
                              
                            },
                            error: function() 
                            {
                                alert("Errore dans de modification !");
                            }
                        })

  
}

  </script>
</head>

<body>

  <div class="classe_selecteur">
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
  <!-- <div class="d-inline-flex col-12"> -->

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
    <!-- </div> -->




</body>

</html>