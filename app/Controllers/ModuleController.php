<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Module;

class ModuleController extends Controller
{
    public function welcome()
    {
        return $this->view('modules.welcome');
    }
    public function index()
    {
        $modules = (new Module($this->getDB()))->all();

        return $this->view('modules.index', [
            'modules' => $modules
        ]);
    }

    public function create()
    {
        return $this->view('modules.create');
    }

    public function createPost()
    {
        $data = $_POST;
        $errors = Module::validate($_POST);
        if ($errors) {
            return $this->view('modules.create', [
                'data' => $data,
                'errors' => $errors,
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
        ]);
    }

    public function updatePost(int $id)
    {
        $errors = Module::validate($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return header('Location: /modules/update/' . $id);
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
