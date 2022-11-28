<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        $formations = (new Formation($this->getDB()))->all();

        return $this->view('formations.index', [
            'formations' => $formations
        ]);
    }

    public function create()
    {
        return $this->view('formations.create');
    }

    public function createPost()
    {
        $data = $_POST;
        $formation = new Formation($this->getDB());
        $errors = $formation->validate($data);
        if ($errors) {
            return $this->view('formations.create', [
                'previousData' => $data,
                'errors' => $errors,
            ]);
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
        return $this->view('formations.update', [
            'formation' => $formation,
        ]);
    }

    public function updatePost(int $id)
    {

        $data = $_POST;
        $formation = new Formation($this->getDB());
        $errors = $formation->validate($data);

        if ($errors) {
            return $this->view('formations.update', [
                'errors' => $errors,
                'formation' => (new Formation($this->getDB()))->findById($id)
            ]);
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
