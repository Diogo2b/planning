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


class EventController extends Controller
{
   

    // Cette fonction permet l'affichage des evenements dans la zone draggable
    public function index(){

        $events = (new Session($this->getDB()))->all();
        $sessions = (new Session($this->getDB()))->all();
        $modules = (new Module($this->getDB()))->contrainte_heure();
        $formations = (new Formation($this->getDB()))->all();
        $salles = (new Salle($this->getDB()))->all();
        $users = (new User($this->getDB()))->all();
        $calendrier = (new Calendrier($this->getDB()))->all();
      

        return json_encode($this->view2('events.index', [

            'modules' => $modules,
        ]));
    }

    // Cette fonction permet l'affichage des evenements dans le calendrier en fonction du type (role) d'user connecté
    public function loadEventCalendarController(){

        // Ci l'utilisateur est un admin il aura donc accès aux plannings de toutes les classes
        if($this->isAdmin()){
            $role=1;
            $events = (new Event($this->getDB()))->index_session();
        
                }

        // Ci l'utilisateur est un élève il aura donc accès au planning de sa classe
        if ($this->isEleve()){
                $role=2;
                $events = (new Event($this->getDB()))->index_session_eleve();
                error_log(json_encode($events));
                
            }
        // Ci l'utilisateur est un intervenant il aura donc accès a son planning 
        if ($this->isIntervenant()){
                $role=4;
                $events = (new Event($this->getDB()))->index_session_intervenant();
                error_log(json_encode($events));
                
            }

        echo json_encode(array('role'=> $role,'events'=>$events));
    }

}
