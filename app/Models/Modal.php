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

// Cette fonction permet d'afficher seulement les intervenants disponibles.
    public function test_prof(){
        // tableaux d'utilisateur disponible.
        $user_dispo = array();


        // tableaux d'utilisateur non disponible.
        $user_index = array();


        // récupération de tout les intervenants.
        $users = $this->query("SELECT * FROM `users` WHERE `role_id`=4");


        // récupération de touts les intervenant qui ne sont pas dispo. en utilisant la date de début/fin d'une session
        //  (qui sont attribué a un intervenant)
        $user_noDisponible = $this->query("SELECT * FROM `sessions`   
        WHERE   sessions.start  = '".$_POST['start']."' AND  sessions.end  = '".$_POST['end']."' 
        ");



        // Foreach pour push tout les intervenants non disponible dans le talbeau $user_index
        foreach($user_noDisponible as $noDispo){

            array_push($user_index ,$noDispo->user_id );
        }


        // Foreach pour tester  chaque id d'user qui ne sont pas dans le tableau d'user indisponible
        // pour enssuite les push dans un tableau d'utilisateur disponible
        foreach($users as $user){

            if(!in_array($user->id, $user_index)){

                $user_dispo[] = $user;

            }

        }
            return $user_dispo;

        }


    
    
    
    
    
        public function test_salle(){

            // tableaux d'utilisateur disponible.
            $salle_dispo = array();


            // tableaux d'utilisateur indisponible.
            $salle_index = array();


             // récupération de toutes les salles.
            $salles = $this->query("SELECT * FROM `salles`");


            // récupération de toutes les salles qui ne sont pas dispo. en utilisant la date de début/fin d'une session
            //  (qui sont attribué a une salle)
            $salle_noDisponible = $this->query("SELECT * FROM `sessions`  
            WHERE   sessions.start  = '".$_POST['start']."' AND  sessions.end  = '".$_POST['end']."' 
            ");


            // Foreach pour push tout les salles non disponible dans le talbeau $salle_index
            foreach($salle_noDisponible as $noDispo){
    
                array_push($salle_index , $noDispo->salle_id );
    
            }
            
            // Foreach pour tester  chaque id d'user qui ne sont pas dans le tableau d'user indisponible
            // pour enssuite les push dans un tableau d'utilisateur disponible
    
            foreach($salles as $salle){
    
                if(!in_array($salle->id, $salle_index)){
    
                    $salle_dispo[] = $salle;
    
                }

        }

                return $salle_dispo;
        
    }

// Cette fonction permet la création d'un event en prenant en compte la décrémentation d'heure dans la table module.
    public function create_post() {
    
        $db=$this->db->getPDO();   
        $stmt = $db->prepare("INSERT INTO sessions (title,start, end, salle_id, formation_id, module_id, user_id, color) VALUES (:title,:start, :end, :salle, :classe, :id_module, :profs, :color)");
        $stmt->bindParam(':start', $_POST['start']);
        $stmt->bindParam(':end', $_POST['end']);
        $stmt->bindParam(':salle', $_POST['salle']);
        $stmt->bindParam(':classe', $_POST['classe']);
        $stmt->bindParam(':id_module', $_POST['id_module']);
        $stmt->bindParam(':profs', $_POST['profs']);
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':color', $_POST['color']);
        $stmt->execute();

        $stmt = $db->prepare("UPDATE modules SET total_hours = total_hours - (TIMESTAMPDIFF(HOUR, :start, :end)) WHERE id = :id_module");
        $stmt->bindParam(':start', $_POST['start']);
        $stmt->bindParam(':end', $_POST['end']);
        $stmt->bindParam(':id_module', $_POST['id_module']);
        $stmt->execute();


    }


// Cette fonction permet de mettre a jour les données d'un event
    public function update_post(){
        $event_updated = $this->query("UPDATE sessions 
        SET start = '".$_POST['start']."', end = '".$_POST['end']."', salle_id = '".$_POST['salle']."', user_id = '".$_POST['profs']."' 
        WHERE id = '".$_POST['id']."'
        ");
    }

 // Cette fonction permet de la suppression d'un event en prenant en compte l'incrémentation d'heure dans la table module.
    public function delete_post(){
        $db=$this->db->getPDO();  
        $stmt = $db->prepare("DELETE FROM sessions WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();
        $stmt = $db->prepare("UPDATE modules SET total_hours = total_hours + (TIMESTAMPDIFF(HOUR, :start, :end)) WHERE id = :id_module");
        $stmt->bindParam(':start', $_POST['start']);
        $stmt->bindParam(':end', $_POST['end']);
        $stmt->bindParam(':id_module', $_POST['id_module']);
        $stmt->execute();

    }

}