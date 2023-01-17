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

}