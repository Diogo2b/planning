<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Formation;
use App\Models\Site;

class FormationController extends Controller
{
    public function index()
    {
        $this->isAdmin();
        $formations = (new Formation($this->getDB()))->all();
        $sites = (new Site($this->getDB()))->all();

        return $this->view('formations.index', [
            'formations' => $formations,
            'sites' => $sites,
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('formations.create', [
            'sites' => (new Site($this->getDB()))->all(),
        ]);
    }

    public function createPost()
    {
        $this->isAdmin();
        $data = $_POST;
        $formation = new Formation($this->getDB());
        $errors = $formation->validate($data);
        if ($errors) {
            return $this->view('formations.create', [
                'previousData' => $data,
                'errors' => $errors,
                'sites' => (new Site($this->getDB()))->all()
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
        $this->isAdmin();
        $formation = (new Formation($this->getDB()))->findById($id);
        return $this->view('formations.update', [
            'formation' => $formation,
            'sites' => (new Site($this->getDB()))->all(),
        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();

        $data = $_POST;
        $formation = new Formation($this->getDB());
        $errors = $formation->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('formations.update', [
                'errors' => $errors,
                'formation' => (new Formation($this->getDB()))->findById($id),
                'site' => (new Site($this->getDB()))->findById($id),

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
        $this->isAdmin();
        $formation = new Formation($this->getDB());
        $result = $formation->delete($id);

        if ($result) {
            return header('Location: /formations');
        }
    }
}
