<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Module;

use App\Models\Formation;

class ModuleController extends Controller
{
    public function welcome()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        return $this->view('modules.welcome');
    }
    public function index()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $modules = (new Module($this->getDB()))->all();

        $formations = (new Formation($this->getDB()))->all();

        return $this->view('modules.index', [
            'modules' => $modules,

            'formations' => $formations,
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        return $this->view('modules.create', [
            'formations' => (new Formation($this->getDB()))->all(),
        ]);
    }

    public function createPost()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate($data);
        if ($errors) {
            return $this->view('modules.create', [
                'previousData' => $data,
                'errors' => $errors,
                'formation' => (new Formation($this->getDB()))->all()
            ]);
        }

        $module = new Module($this->getDB());
        $result = $module->create($_POST);
        if ($result) {
            return header('Location: /modules');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $module = (new Module($this->getDB()))->findById($id);
        return $this->view('modules.update', [
            'module' => $module,
            'formations' => (new Formation($this->getDB()))->all(),
        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('modules.update', [
                'errors' => $errors,
                'module' => (new Module($this->getDB()))->findById($id),
                'formation' => (new Formation($this->getDB()))->findById($id),
            ]);
        }

        $module = new Module($this->getDB());
        $result = $module->update($id, $_POST);

        if ($result) {
            return header('Location: /modules');
        }
    }
    public function contrainte_heure(): array
    {

        return $this->query("SELECT * FROM {$this->table}  WHERE total_hours>0 AND formation_id = '" . $_POST['event'] . "'  ");
    }


    public function delete(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $module = new Module($this->getDB());
        $result = $module->delete($id);

        if ($result) {
            return header('Location: /modules');
        }
    }
}
