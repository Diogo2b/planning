<?php




namespace App\Models;
use Database\DBConnection;
use PDO;
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
    $db=$this->db->getPDO();   
    $stmt = $db->prepare("INSERT INTO sessions (start, end, salle_id, formation_id, module_id, user_id) VALUES (:start, :end, :salle, :classe, :id_module, :profs)");
    $stmt->bindParam(':start', $_POST['start']);
    $stmt->bindParam(':end', $_POST['end']);
    $stmt->bindParam(':salle', $_POST['salle']);
    $stmt->bindParam(':classe', $_POST['classe']);
    $stmt->bindParam(':id_module', $_POST['id_module']);
    $stmt->bindParam(':profs', $_POST['profs']);
    $stmt->execute();

    $stmt2 = $db->prepare("UPDATE modules SET total_hours = total_hours - (TIMESTAMPDIFF(HOUR, :start, :end)) WHERE id = :id_module");
    $stmt2->bindParam(':start', $_POST['start']);
    $stmt2->bindParam(':end', $_POST['end']);
    $stmt2->bindParam(':id_module', $_POST['id_module']);
    $stmt2->execute();


    }

    public function update_post()
    {
        $event_updated = $this->query("UPDATE sessions 
        SET start = '".$_POST['start']."', end = '".$_POST['end']."', salle_id = '".$_POST['salle']."', formation_id = '".$_POST['classe']."', module_id = '".$_POST['id_module']."', user_id = '".$_POST['profs']."' 
        WHERE id = '".$_POST['id']."'
        ");
    }

    public function delete_post(){
        $db=$this->db->getPDO();  
        $stmt = $db->prepare("DELETE FROM sessions WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $stmt2 = $db->prepare("UPDATE modules SET total_hours = total_hours + (TIMESTAMPDIFF(HOUR, :start, :end)) WHERE id = :id_module");
        $stmt2->bindParam(':start', $_POST['start']);
        $stmt2->bindParam(':end', $_POST['end']);
        $stmt2->bindParam(':id_module', $_POST['id_module']);
        $stmt2->execute();

    }
//e
}