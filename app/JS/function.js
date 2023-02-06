// fonction de création de session, cette fonction est appelé lorsque l'ont appuis
//  sur le bouton de type submit de la modal de création 
//  ( qui elle est appelé par la fonction modal_create sur le callback eventReceive).

function create_session(){

      
      let selector_profs = $("#select_prof").val();
      let selector_salle = $("#select_salle").val();
      let selector_class = $("#select_form").val();
      let start_receive = $("#start_selector").val();
      let end_receive = $("#end_selector").val();
      let hex_color= $('#color_selector').val()
      let id_selector= $('#id_selector').val()
     
      let title_module = $("#name_selector").val()
  console.log(title_module);
      $.ajax({
        url: '/modal_CreatePost',
        dataType: 'JSON',
        type: 'POST',
        data: {
          title: title_module,
          profs: selector_profs,
          salle: selector_salle,
          classe: selector_class,
          id_module: id_selector,
          end: end_receive,
          start: start_receive,
          color: hex_color
        },
        success: function(response) {
           

          alert(response)
          location.reload()

        },
        error: function() {
          alert("Errore dans de création !");
        }
      })


}




// fonction de supression de session, cette fonction est appelé lorsque l'ont appuis
//  sur le bouton de suprimer de la modal de supression
//  ( qui elle est appelé par la fonction modal_delette sur le callback eventClick).
function delete_session(){
    let start_receive=$("#start_selector").val();
    let end_receive=$("#end_selector").val();
    let id_module= $("#module_selector").val()
    let event_id=$("#id_selector").val();
    console.log(id_module);
    $.ajax({
                  url: '/modal_DeletePost',
                  dataType: 'JSON',
                  type: 'POST',
                  data: {
                   
                    id_module:id_module,
                    end:end_receive,
                    start:start_receive,
                    id: event_id
                  },
                  success: function (response) {
                    alert(response)
                    location.reload()

                   
                    
                  },
                  error: function() 
                  {
                      alert("Errore dans de modification !");
                  }
              })




}



// fonction de modification de session, cette fonction est appelé lorsque l'ont appuis
//  sur le bouton de modification de la modal de supression ou de modification
//  ( qui sont elles  appelé par la fonction modal_delette ou modal_update sur le callback eventClick ou eventDrop).
function update_session(){
    let selector_profs=$("#select_prof").val();
    let selector_salle=$("#select_salle").val();
    let selector_class=$("#select_form").val();
    let start_receive=$("#start_selector").val();
    let end_receive=$("#end_selector").val();
    
    let id_module_receive=$("#module_selector").val()
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

                  location.reload()
                  
                },
                error: function() 
                {
                    alert("Errore dans de modification !");
                }
            })


}


// Cette fonction permet de lancer deux fonctions, elle est utilisé sur le onchange d'un select pour 
// pouvoir mettre a jours les module draggable et les evenements du calendrier en même temps
function load() {
  loadModuleDraggable()
  loadEventCalendar()
}



// Fonction de chargement de module draggable, elle charge 
// tout les modules disponible pour la classe selectionné dans le selecteur

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



// Fonction d'initialisation d'un calendrier avec ces callback et de 
// chargement d'evenement en rapport avec le rôle de l'utilisateur.
function loadEventCalendar() {
  var loadEventCalendars = $('#select_form').val(); 
  let id_user = $('#select_user').val();
 
  $.ajax({
    url: '/calendriers',
    dataType: 'JSON',
    type: 'POST',
    data: {
      events: loadEventCalendars,
      user_id:id_user
    },
    success: function(response) {
      
      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('calendrier');
      var isEditable = response['role']
      
      

      

      var calendar = new Calendar(calendarEl, {
        
        buttonText:{
          today: 'Aujourd\'hui'
        
        },
        locale:'fr',
        height:'auto',
        width:'auto',
        html: true,
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
          
          let end_receive = info.event.endStr
          let start_receive = info.event.startStr
         let hex_color= $("#color_selector").val()
         
         let formation_site = $(".selector_formation").attr('data-site')
         console.log(formation_site)
         

         let nom_module = info.event.title;

         $( ".module" ).each(function() {
          
          if($( this ).attr('data-name') == nom_module ){
            id_module  = $( this ).attr('data-id');
            hex_color  = $( this ).attr('data-color');
            
          }
        });
        console.log(formation_site);

         

          $.ajax({
            url: '/modal',
            dataType: 'HTML',
            type: 'POST',
            data: {

              end: end_receive,
              start: start_receive,
              color: hex_color,
              name: nom_module,
              id_module: id_module,
              site:formation_site
              
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

          console.log(id_module_drop)

          $.ajax({
            url: '/event_update',
            dataType: 'HTML',
            type: 'POST',
            data: {
              user: drop_profs,
              salle: drop_salle,
              formation: drop_class,
              id_module: id_module_drop,
              end: end_drop,
              start: start_drop,
              id: id_event
            },
            success: function(response) {
              $('.modal-content').html(response);
              $('#MaModal').modal('show');


             

            },
            error: function() {
              alert("Errore dans Update-Event !");
            }
          })

        },
        eventResize: function(info) {
          info.revert()
        },
        eventClick: function(info) {

          let drop_profs = info.event.extendedProps.profs
          let drop_salle = info.event.extendedProps.salle
          let drop_class = info.event.extendedProps.formation
          let start_drop = info.event.startStr
          let end_drop = info.event.endStr
          let id_module_drop = info.event.extendedProps.module;
          let id_event = info.event.id
          
          console.log(id_module_drop)

          $.ajax({
            url: '/event_delete',
            dataType: 'HTML',
            type: 'POST',
            data: {
              user: drop_profs,
              salle: drop_salle,
              formation: drop_class,
              id_module: id_module_drop,
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
    //     eventRender: function(info) {
    //     element.find('.fc-event-title fc-sticky').html(info.title);
        
    // }
      


      });
        

      Object.values(response.events).forEach(response => {
        
        calendar.addEvent({
          title: "Nom du cour: "+response['title']+ "" + 
                 "Nom de la salle: " + response['name'] + "" + 
                 "Intervenant: " + response['lastname'] + " " + response['firstname'],   
          start: response['start'],
          end: response['end'],
          id: response['session_id'],
          backgroundColor: response['color'],
          extendedProps: {
            salle: response['salle_id'],
            profs: response['user_id'],
            module: response['module_id'],
            formation: response['formation_id']
          },

        });
        

      });

      calendar.render();

    },


    error: function(response) {
     alert(response)

    }
  });

 
}


// Cette fonction permet de rendre visible un selecteur 
// de formation dans la création d'utilisateur uniquement ci le role selectioné au préalable est le rôle élève
function formationSelect(){
  let formation_select=document.querySelector('#role_id').value;
  if (formation_select===2){
      document.querySelector('#formationSelector').style.display="block";
  
  }
  else{
      document.querySelector('#formationSelector').style.display="none"; 
  }
  }