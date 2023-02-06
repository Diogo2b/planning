<?php

namespace App\Controllers;

use App\Models\Calendrier;
use App\Controllers\Controller;
use App\Models\Session;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Salle;
use App\Models\User;
use App\Models\Event;
use App\Models\Modal;



class ModalController extends Controller
{


//    Cette fonction permet l'ouverture d'un modale de création avec des données poussé en $_POST 
//    (appelé lors du callback 'eventReceive' du calendrier)
    public function create(){
        $profs = (new Modal($this->getDB()))->test_prof();
        $salles = (new Modal($this->getDB()))->test_salle();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        error_log('////////////////////');
        error_log(json_encode($_POST));
        error_log('////////////////////');
        
        return ($this->view2('modals.create', [
            'profs' => $profs,
            'salles' => $salles,
            'modules'=>$modules,
            'formations' => $formations,

            
            
        ]));  
    }
// Cette fonction poste en base de donnée dans la table sessions les données de la modal de création
    public function createPost(){
        $modals = (new Modal($this->getDB()))->create_post();
        $msg = "Votre cour a bien été ajouter";
        echo json_encode($msg);

    }
//Cette fonction ouvre la modal de modification (appelé lors du callback 'eventDrop')
    public function update(){
        $profs = (new Modal($this->getDB()))->test_prof();
        $salles = (new Modal($this->getDB()))->test_salle();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();
        $salles_actuel = (new Modal($this->getDB()))->test_salle_update();

        
        return ($this->view2('modals.update', [
            'profs' => $profs,
            'salles' => $salles,
            'modules'=>$modules,
            'formations' => $formations,
            'sessions' => $sessions
            

            
            
        ])); 
    } 
// Cette fonction met a jour les en base de donnée les données posté de la modal de modification
    public function updatePost(){
        $modals = (new Modal($this->getDB()))->update_post();
        $msg = "Votre cour a bien été modifié";
        echo json_encode($msg);

}
// Cette fonction ouvre la modal de suppression (appelé lors du callback 'eventClick')
public function delete(){
    $profs = (new Modal($this->getDB()))->test_prof();
    $salles = (new Modal($this->getDB()))->test_salle();
    $salles_actuel = (new Modal($this->getDB()))->test_salle_update();
    $sessions = (new Session($this->getDB()))->all();
    $modules = (new Module($this->getDB()))->all();
    $formations = (new Formation($this->getDB()))->all();
    $users = (new User($this->getDB()))->all();

    
    return ($this->view2('modals.delete', [
        'profs' => $profs,
        'salles' => $salles,
        'modules'=>$modules,
        'formations' => $formations,
        'sessions' => $sessions,
        'salles_actuel' => $salles_actuel

        
        
    ])); 
} 

//Cette fonction supprime un event 
public function DeletePost(){
    $modals = (new Modal($this->getDB()))->delete_post();
    $msg = "Votre cour a bien été supprimé";
    echo json_encode($msg);

}


}
    