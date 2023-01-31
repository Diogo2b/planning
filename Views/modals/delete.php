
    <script src="../app/JS/function.js"></script>
      <div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">Gestion de cour</h5>
        <button type="button" class="close" data-bs-dismiss="modal" onclick="location.reload()"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="javascript:update_session();" method="POST">
            <label for="select_prof">Intervenants</label>
            <select id="select_prof"class="form-select" aria-label="Default select example">
            
            <?php foreach ($profs as $prof)  {

              echo "<option value='".$prof->id."'>".$prof->lastname." ".$prof->firstname."</option>";


            }
            
            ?>
            </select>
            <br>
            <label for="select_salle">Salles</label>
            <select id="select_salle"class="form-select" aria-label="Default select example">
            
            <?php foreach ($salles as $salle)  {

              // error_log(json_encode($salle->name));

              echo "<option value='".$salle->id."'>".$salle->name."</option>";
              
              
            }
            
            ?>
              
     
            </select>
            <br>
            <?php
              $datetime = new DateTime($_POST['start']);
              $new_date = $datetime->format('Y-m-d');
                   $today = date("Y-m-d");
                if($new_date >= $today){

                 
            ?>
            <input id="start_selector"name="start"type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3 " value=<?= $_POST['start']  ?>>

            <input id="end_selector"name="end"type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['end']  ?>>
            
            <input id="id_selector"name="id_event"type="text" class="form-control d-none"  aria-describedby="basic-addon3 " value=<?= $_POST['id']  ?>>
            <input  class="btn btn-primary" value="Modifier le cour " data-bs-dismiss="modal" onclick="update_session()"   >
            <input  class="btn btn-danger" value="Suprimer" data-bs-dismiss="modal" onclick="delete_session()" >

            <?php
                }
            ?>
            
        </form>
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Fermer</button>
      

        
        <!-- <a href="" class="btn btn-success my-3">Créer une nouvelle session</a> -->
      


