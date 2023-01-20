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


   
    public function create()
    {
        $profs = (new Modal($this->getDB()))->test_prof();
        $salles = (new Modal($this->getDB()))->test_salle();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        
        return ($this->view2('modals.create', [
            'profs' => $profs,
            'salles' => $salles,
            'modules'=>$modules,
            'formations' => $formations,

            
            
        ]));  
    }

    public function createPost()
    {
        $modals = (new Modal($this->getDB()))->create_post();
        $msg = "Votre cour a bien été ajouter";
        echo json_encode($msg);

    }

    public function update()
    {
        $profs = (new Modal($this->getDB()))->test_prof();
        $salles = (new Modal($this->getDB()))->test_salle();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        
        return ($this->view2('modals.update', [
            'profs' => $profs,
            'salles' => $salles,
            'modules'=>$modules,
            'formations' => $formations,
            'sessions' => $sessions

            
            
        ])); 
    } 
    
    public function updatePost()
    {
        $modals = (new Modal($this->getDB()))->update_post();
        $msg = "Votre cour a bien été ajouté";
        echo json_encode($msg);

}


public function delete()
{
    $profs = (new Modal($this->getDB()))->test_prof();
    $salles = (new Modal($this->getDB()))->test_salle();
    $sessions = (new Session($this->getDB()))->all();
    $modules = (new Module($this->getDB()))->all();
    $formations = (new Formation($this->getDB()))->all();
    $users = (new User($this->getDB()))->all();

    
    return ($this->view2('modals.delete', [
        'profs' => $profs,
        'salles' => $salles,
        'modules'=>$modules,
        'formations' => $formations,
        'sessions' => $sessions

        
        
    ])); 
} 
public function DeletePost()
{
    $modals = (new Modal($this->getDB()))->delete_post();
    $msg = "Votre cour a bien été supprimé";
    echo json_encode($msg);

}


}
    