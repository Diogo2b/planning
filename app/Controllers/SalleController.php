<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Salle;
use App\Models\Site;

class SalleController extends Controller
{
    public function index()
    {
        $salles = (new Salle($this->getDB()))->all();
        $sites = (new Site($this->getDB()))->all();

        return $this->view('salles.index', [
            'salles' => $salles,
            'sites' => $sites,
        ]);
    }

    public function create()
    {
        return $this->view('salles.create', [
            'sites' => (new Site($this->getDB()))->all(),
        ]);
    }

    public function createPost()
    {
        $data = $_POST;
        $salle = new Salle($this->getDB());
        $errors = $salle->validate($data);
        if ($errors) {
            return $this->view('salles.create', [
                'previousData' => $data,
                'errors' => $errors,
                'sites' => (new Site($this->getDB()))->all()
            ]);
        }

        $salle = new Salle($this->getDB());
        $result = $salle->create($_POST);
        if ($result) {
            return header('Location: /salles');
        }
    }

    public function update(int $id)
    {
        $salle = (new Salle($this->getDB()))->findById($id);
        return $this->view('salles.update', [
            'salle' => $salle,
            'sites' => (new Site($this->getDB()))->all(),
        ]);
    }

    public function updatePost(int $id)
    {

        $data = $_POST;
        $salle = new Salle($this->getDB());
        $errors = $salle->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('salles.update', [
                'errors' => $errors,
                'salle' => (new Salle($this->getDB()))->findById($id),
                'site' => (new Site($this->getDB()))->findById($id),

            ]);
        }

        $salle = new Salle($this->getDB());
        $result = $salle->update($id, $_POST);

        if ($result) {
            return header('Location: /salles');
        }
    }


    public function delete(int $id)
    {
        $salle = new Salle($this->getDB());
        $result = $salle->delete($id);

        if ($result) {
            return header('Location: /salles');
        }
    }
}
