<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Module;

use App\Models\User;

class ModuleController extends Controller
{
    public function welcome()
    {
        $this->isAdmin();
        return $this->view('modules.welcome');
    }
    public function index()
    {
        $this->isAdmin();
        $modules = (new Module($this->getDB()))->all();

        $users = (new User($this->getDB()))->all();

        return $this->view('modules.index', [
            'modules' => $modules,

            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('modules.create', [
            'users' => (new User($this->getDB()))->all(),
        ]);
    }

    public function createPost()
    {
        $this->isAdmin();
        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate($data);
        if ($errors) {
            return $this->view('modules.create', [
                'previousData' => $data,
                'errors' => $errors,
                'user' => (new User($this->getDB()))->all()
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
        $module = (new Module($this->getDB()))->findById($id);
        return $this->view('modules.update', [
            'module' => $module,
            'users' => (new User($this->getDB()))->all(),
        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();

        $data = $_POST;
        $module = new Module($this->getDB());
        $errors = $module->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('modules.update', [
                'errors' => $errors,
                'module' => (new Module($this->getDB()))->findById($id),
                'user' => (new User($this->getDB()))->findById($id),
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
        $this->isAdmin();
        $module = new Module($this->getDB());
        $result = $module->delete($id);

        if ($result) {
            return header('Location: /modules');
        }
    }
}
