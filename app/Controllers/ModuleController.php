<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Module;
use App\Models\Session;

class ModuleController extends Controller
{
    public function welcome()
    {
        return $this->view('modules.welcome');
    }
    public function index()
    {
        $modules = (new Module($this->getDB()))->all();
        $sessions = (new Session($this->getDB()))->all();

        return $this->view('modules.index', [
            'modules' => $modules,
            'sessions' => $sessions,
        ]);
    }

    public function create()
    {
        return $this->view('modules.create', [
            'sessions' => (new Session($this->getDB()))->all(),
        ]);
    }

    public function createPost()
    {
        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate($data);
        if ($errors) {
            return $this->view('modules.create', [
                'previousData' => $data,
                'errors' => $errors,
                'sessions' => (new Session($this->getDB()))->all()
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
        $module = (new Module($this->getDB()))->findById($id);
        return $this->view('modules.update', [
            'module' => $module,
            'sessions' => (new Session($this->getDB()))->all(),
        ]);
    }

    public function updatePost(int $id)
    {

        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('modules.update', [
                'errors' => $errors,
                'module' => (new Module($this->getDB()))->findById($id),
                'session' => (new Session($this->getDB()))->findById($id),
            ]);
        }

        $module = new Module($this->getDB());
        $result = $module->update($id, $_POST);

        if ($result) {
            return header('Location: /modules');
        }
    }


    public function delete(int $id)
    {
        $module = new Module($this->getDB());
        $result = $module->delete($id);

        if ($result) {
            return header('Location: /modules');
        }
    }
}
