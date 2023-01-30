<script src="../app/JS/function.js"></script>
<div class="modal-header ">
  <h5 class="modal-title" id="exampleModalLabel">Création de cour</h5>
  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modalCreate d-flex align-items-center justify-content-center p-3">
  <form action="javascript:create_session();" method="POST">
    <label for="select_prof">Intervenants</label>
    <select id="select_prof" class="form-select" aria-label="Default select example">

      <?php foreach ($profs as $prof) {

        echo "<option value='" . $prof->id . "'>" . $prof->lastname . " " . $prof->firstname . "</option>";
      }

      ?>
    </select>
    <br>
    <label for="select_salle">Salles</label>
    <select id="select_salle" class="form-select" aria-label="Default select example">

      <?php foreach ($salles as $salle) {

        // error_log(json_encode($salle->name));

        echo "<option value='" . $salle->id . "'>" . $salle->name . "</option>";
      }

      ?>
      <!-- coucou -->
      
    </select>
    <br>

    <input id="start_selector" name="start" type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3 " value=<?= $_POST['start']  ?>>

    <input id="end_selector" name="end" type="text" class="form-control d-none" id="basic-url" aria-describedby="basic-addon3" value=<?= $_POST['end']  ?>>

    <input type="submit" class="btn btn-primary" value="Créer le session " data-bs-dismiss="modal">


    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="location.reload()">Fermer</button>
  </form>




  <!-- <a href="" class="btn btn-success my-3">Créer une nouvelle session</a> -->