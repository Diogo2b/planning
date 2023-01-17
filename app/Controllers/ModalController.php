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


   
    public function index()
    {
        $profs = (new Modal($this->getDB()))->test_prof();
        $salles = (new Modal($this->getDB()))->test_salle();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();

        
        return ($this->view2('modals.index', [
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
}