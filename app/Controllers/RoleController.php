<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = (new Role($this->getDB()))->all();

        return $this->view('roles.index', compact('roles'));
    }

    public function create()
    {
        return $this->view('roles.create');
    }

    public function createPost()
    {
        $errors = Role::validate($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return header('Location: /roles/create');
        }

        $role = new Role($this->getDB());
        $result = $role->create($_POST);
        if ($result) {
            return header('Location: /roles');
        }
    }

    public function update(int $id)
    {
        $role = (new Role($this->getDB()))->findById($id);
        return $this->view('roles.update', compact('role'));
    }

    public function updatePost(int $id)
    {
        $errors = Role::validate($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return header('Location: /roles/update/' . $id);
        }

        $role = new Role($this->getDB());
        $result = $role->update($id, $_POST);

        if ($result) {
            return header('Location: /roles');
        }
    }


    public function delete(int $id)
    {
        $role = new Role($this->getDB());
        $result = $role->delete($id);

        if ($result) {
            return header('Location: /roles');
        }
    }
}
