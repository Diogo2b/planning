<?php

namespace App\Models;

use App\Controllers\Controller;
use App\Models\Session;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Salle;
use App\Models\User;
use App\Validation\ValidatorFactory;

class Event extends Model
{

    protected $table = 'sessions';


    
    public function index_session() :array {

        return $this->query("SELECT * FROM {$this->table}  WHERE formation_id = '".$_POST['events']."'");

   }
    public function index_session_eleve():array  {
        return $this->query("SELECT * FROM `sessions`
        WHERE `formation_id` = (SELECT `formation_id` FROM `users_formation` WHERE `user_id` = '".$_POST['user_id']."')");
      
         
        

   }
    public function index_session_intervenant():array  {
        return $this->query("SELECT * FROM sessions WHERE user_id = '".$_POST['user_id']."'"
    );
      
         
        

   }


   public function delete_event(): array{

    $msg = "coucou";

    echo json_encode($msg);

   }

}