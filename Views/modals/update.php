<script src="../app/JS/function.js"></script>
<div class="modal-header" >
        <h5 class="modal-title" id="exampleModalLabel">Modifier le cour</h5>
        <button type="button" class="close" data-bs-dismiss="modal"  aria-label="Close">
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
            <input id="start_selector"name="start"type="text" class="form-control d-none"  aria-describedby="basic-addon3 " value=<?= $_POST['start']  ?>>

            <input id="end_selector"name="end"type="text" class="form-control d-none" aria-describedby="basic-addon3" value=<?= $_POST['end']  ?>>

            <input id="id_selector"name="id_event"type="text" class="form-control d-none"  aria-describedby="basic-addon3 " value=<?= $_POST['id']  ?>>
            
            <input id="module_selector" name="name" type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['id_module']  ?>>

            
            <input class="btn btn-primary custom-button" type="submit" value="Modifier" data-bs-dismiss="modal"  >
            
            <?php
                }
            ?>
            
            
        </form>
        
       
      
