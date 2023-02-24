
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
            <select id="select_prof"class="form-select" aria-label="Default select example" >
            <?php echo "<option value='".$salles_actuel['user_id']."'>".$salles_actuel['firstname']."  ".$salles_actuel['lastname']."</option>"; ?>
            <?php foreach ($profs as $prof)  {

              echo "<option value='".$prof->id."'>".$prof->lastname." ".$prof->firstname."</option>";


            }
            
            ?>
            </select>
            <br>
            <label for="select_salle">Salles</label>
            <select id="select_salle"class="form-select" aria-label="Default select example" >
            <?php
              error_log(json_encode($salles_actuel));
            ?>
            <?php echo "<option value='".$salles_actuel['salle_id']."'>".$salles_actuel['name']."</option>"; ?>
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
            
            <input id="id_selector" name="name" type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['id']  ?>>
            
            <input id="module_selector" name="name" type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['id_module']  ?>>

            <input  class="btn btn-primary custom-button2" value="Modifier" data-bs-dismiss="modal" onclick="update_session()"   >
            <input  class="btn btn-danger custom-button" value="Suprimer" data-bs-dismiss="modal" onclick="delete_session()" >

            <?php
                }
            ?>
            
        </form>
    
      

        
        <!-- <a href="" class="btn btn-success my-3">Créer une nouvelle session</a> -->
      


