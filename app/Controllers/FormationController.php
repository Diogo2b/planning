<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        $formations = (new Formation($this->getDB()))->all();

        return $this->view('formations.index', compact('formations'));
    }

    public function create()
    {
        return $this->view('formations.create');
    }

    public function createPost()
    {
        $errors = Formation::validate($_POST);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            return header('Location: /formations/create');
        }

        $formation = new Formation($this->getDB());
        $result = $formation->create($_POST);
        if ($result) {
            return header('Location: /formations');
        }
    }

    public function update(int $id)
    {
        $formation = (new Formation($this->getDB()))->findById($id);
        return $this->view('formations.update', compact('formation'));
    }

    public function updatePost(int $id)
    {
        $errors = Formation::validate($_POST);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            return header('Location: /formations/update/' . $id);
        }

        $formation = new Formation($this->getDB());
        $result = $formation->update($id, $_POST);

        if ($result) {
            return header('Location: /formations');
        }
    }


    public function delete(int $id)
    {
        $formation = new Formation($this->getDB());
        $result = $formation->delete($id);

        if ($result) {
            return header('Location: /formations');
        }
    }
}
