
    
      <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-bs-dismiss="modal" onclick="location.reload()"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="javascript:create_session();" method="POST">
            <label for="select_prof_delete">Intervenants</label>
            <select id="select_prof_delete"class="form-select" aria-label="Default select example">
            
            <?php foreach ($profs as $prof)  {

              echo "<option value='".$prof->id."'>".$prof->lastname." ".$prof->firstname."</option>";


            }
            
            ?>
            </select>
            <br>
            <label for="select_salle_delete">Salles</label>
            <select id="select_salle_delete"class="form-select" aria-label="Default select example">
            
            <?php foreach ($salles as $salle)  {

              // error_log(json_encode($salle->name));

              echo "<option value='".$salle->id."'>".$salle->name."</option>";
              
              
            }
            
            ?>
              
     
            </select>
            <br>
            
            <input id="start_selector_delete"name="start"type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3 " value=<?= $_POST['start']  ?>>

            <input id="end_selector_delete"name="end"type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['end']  ?>>
            
            <input id="id_selector_delete"name="id_event"type="text" class="form-control d-none"  aria-describedby="basic-addon3 " value=<?= $_POST['id']  ?>>
            <input type="submit" class="btn btn-primary" value="Modifier le cour " data-bs-dismiss="modal" >
            <input  class="btn btn-danger" value="Suprimer" data-bs-dismiss="modal" onclick="delete_session()" >

            
            
        </form>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Fermer</button>
      

        
        <!-- <a href="" class="btn btn-success my-3">Créer une nouvelle session</a> -->
      


