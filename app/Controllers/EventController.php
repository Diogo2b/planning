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
    protected $table = 'modules';
    public function contrainte_heure(): array
    {


        return $this->query("SELECT * FROM {$this->table}  WHERE total_hours>0 AND formation_id = '" . $_POST['event'] . "'  ");
    }


    public function index()
    {

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
    public function loadEventCalendar()
    {
        if($this->isAdmin()){
        $role=1;
        $events = (new Event($this->getDB()))->index_session();
       
    }

        else if ($this->isEleve()){
            $role=2;
            $events = (new Event($this->getDB()))->index_session_eleve();
            error_log(json_encode($events));
            
        }   
        echo json_encode(array('role'=> $role,'events'=>$events));
    }

}
