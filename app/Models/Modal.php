<?php




namespace App\Models;

use App\Controllers\Controller;
use App\Models\Session;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Salle;
use App\Models\User;
use App\Validation\ValidatorFactory;

class Modal extends Model
{

    protected $table = 'users';


    public function test_prof(){

        $user_dispo = array();

        $user_index = array();

        $users = $this->query("SELECT * FROM `users` WHERE `role_id`=4");

        $user_noDisponible = $this->query("SELECT * FROM `sessions` 
        
        WHERE   sessions.start  = '".$_POST['start']."' AND  sessions.end  = '".$_POST['end']."' 
        ");

        foreach($user_noDisponible as $noDispo){

            array_push($user_index ,$noDispo->user_id );

        }

        foreach($users as $user){

            if(!in_array($user->id, $user_index)){

                $user_dispo[] = $user;

            }

        }
            return $user_dispo;

        }


        public function test_salle(){


            $salle_dispo = array();

            $salle_index = array();
    
            $salles = $this->query("SELECT * FROM `salles`");
    
            $salle_noDisponible = $this->query("SELECT * FROM `sessions` 
            
            WHERE   sessions.start  = '".$_POST['start']."' AND  sessions.end  = '".$_POST['end']."' 
            ");
    
            foreach($salle_noDisponible as $noDispo){
    
                array_push($salle_index , $noDispo->salle_id );
    
            }
    
            foreach($salles as $salle){
    
                if(!in_array($salle->id, $salle_index)){
    
                    $salle_dispo[] = $salle;
    
                }

        }

                return $salle_dispo;
        
    }

    public function create_post() {

            // $stmt= $this->query("INSERT INTO sessions (start, end, salle_id, formation_id, module_id, user_id) 
            // VALUES (:start, :end, :salle, :classe, :id_module, :profs)");
            // $stmt->bindParam(':start', $_POST['start']);
            // $stmt->bindParam(':end', $_POST['end']);
            // $stmt->bindParam(':salle', $_POST['salle']);
            // $stmt->bindParam(':classe', $_POST['classe']);
            // $stmt->bindParam(':id_module', $_POST['id_module']);
            // $stmt->bindParam(':profs', $_POST['profs']);
            // $stmt->execute();
            
       
    $tagg = 0;    

       $event_created = $this->query("INSERT INTO  sessions (start, end, salle_id, formation_id, module_id, user_id) 
VALUES ('".$_POST['start']."' , '".$_POST['end']."' , '".$_POST['salle']."' ,'".$_POST['classe']."' , '".$_POST['id_module']."' , '".$_POST['profs']."' )");

if ($tagg == 0){
    error_log('1');
    $last_event_supp = $this->query(" DELETE FROM sessions ORDER BY id DESC LIMIT 1");
    $tagg = 1;
}
if($tagg==1){
    error_log('2');
        $soustraction_heure = $this->query("UPDATE modules
        SET total_hours = total_hours - (TIMESTAMPDIFF(HOUR, '".$_POST['start']."', '".$_POST['end']."')/2)
        WHERE id='".$_POST['id_module']."'"); 
}
    

// $ajout_heure = $this->query("UPDATE modules SET total_hours = total_hours + 4 WHERE id = '".$_POST['id_module']."'");



        //validation des données
        // if(isset($_POST['start']) && !empty($_POST['start']) && 
        // isset($_POST['end']) && !empty($_POST['end']) &&
        // isset($_POST['salle']) && !empty($_POST['salle']) &&
        // isset($_POST['classe']) && !empty($_POST['classe']) &&
        // isset($_POST['module']) && !empty($_POST['module']) &&
        // isset($_POST['profs']) && !empty($_POST['profs'])){
        //     $start = filter_var($_POST['start'], FILTER_SANITIZE_STRING);
        //     $end = filter_var($_POST['end'], FILTER_SANITIZE_STRING);
        //     $salle = filter_var($_POST['salle'], FILTER_VALIDATE_INT);
        //     $classe = filter_var($_POST['classe'], FILTER_VALIDATE_INT);
        //     $module = filter_var($_POST['module'], FILTER_VALIDATE_INT);
        //     $profs = filter_var($_POST['profs'], FILTER_VALIDATE_INT);
        //     if($start === false || $end === false || $salle === false || $classe === false || $module === false || $profs === false){
        //         return false;
        //     }
        // } else {
        //     return false;
        // }
        // //échappement des données
        // $start = mysqli_real_escape_string($this->db, $start);
        // $end = mysqli_real_escape_string($this->db, $end);
        // $salle = mysqli_real_escape_string($this->db, $salle);
        // $classe = mysqli_real_escape_string($this->db, $classe);
        // $module = mysqli_real_escape_string($this->db, $module);
        // $profs = mysqli_real_escape_string($this->db, $profs);
        // //construction de la requête
        // $query = "INSERT INTO sessions (start, end, salle_id, formation_id, module_id, user_id) 
        // VALUES ('$start', '$end', '$salle', '$classe', '$module', '$profs')";
        // if(mysqli_query($this->db, $query)){
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }

    public function update_post()
    {
        $event_updated = $this->query("UPDATE sessions 
SET start = '".$_POST['start']."', end = '".$_POST['end']."', salle_id = '".$_POST['salle']."', formation_id = '".$_POST['classe']."', module_id = '".$_POST['id_module']."', user_id = '".$_POST['profs']."' 
WHERE id = '".$_POST['id']."'
");
    }

    public function delete_post(){
        $event_supp = $this->query(" DELETE FROM sessions WHERE id ='".$_POST['id']."'");
        $restauration_heure = $this->query("UPDATE modules SET total_hours = total_hours + 4 WHERE id = '".$_POST['id_module']."'");

    }

}