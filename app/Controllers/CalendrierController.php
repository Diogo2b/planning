<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Calendrier;
use App\Models\Formation;
use App\Models\Site;

class CalendrierController extends Controller
{


    public function index()
    {


        $calendrier = (new Calendrier($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();


        return $this->view('calendriers.index', [
            'calendrier' => $calendrier,
            'formations' => $formations
        ]);

        return;
    }
}
