<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        return $this->view('roles.index', [
            'roles' => (new Role($this->getDB()))->all()
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('roles.create');
    }

    public function createPost()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $role = new Role($this->getDB());
        $errors = $role->validate($data);

        if ($errors) {
            return $this->view('roles.create', [
                'previousData' => $data,
                'errors' => $errors,
            ]);
        }

        $role = new Role($this->getDB());
        $result = $role->create($data);
        if ($result) {
            return header('Location: /roles');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $role = (new Role($this->getDB()))->findById($id);
        return $this->view('roles.update', [
            'role' => $role,
        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $user = new Role($this->getDB());
        $errors = $user->validate($data);

        if ($errors) {
            return $this->view('roles.update', [
                'errors' => $errors,
                'role' => (new Role($this->getDB()))->findById($id)
            ]);
        }

        $role = new Role($this->getDB());
        $result = $role->update($id, $data);

        if ($result) {
            return header('Location: /roles');
        }
    }

    public function delete(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $role = new Role($this->getDB());
        $result = $role->delete($id);

        if ($result) {
            return header('Location: /roles');
        }
    }
}
