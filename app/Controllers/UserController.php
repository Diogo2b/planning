<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = (new User($this->getDB()))->all();

        return $this->view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return $this->view('users.create');
    }

    public function createPost()
    {
        $data = $_POST;
        $errors = User::validate($data);

        if ($errors) {
            return $this->view('users.create', [
                'data' => $data,
                'errors' => $errors,
            ]);
        }

        $user = new User($this->getDB());
        $result = $user->create($_POST);
        if ($result) {
            return header('Location: /users');
        }
    }

    public function update(int $id)
    {
        $user = (new User($this->getDB()))->findById($id);
        return $this->view('users.update', [
            'user' => $user,
        ]);
    }

    public function updatePost(int $id)
    {
        $errors = User::validate($_POST);

        if ($errors) {
            $_SESSION['errors'] = $errors;
            return header('Location: /users/update/' . $id);
        }

        $user = new User($this->getDB());
        $result = $user->update($id, $_POST);

        if ($result) {
            return header('Location: /users');
        }
    }


    public function delete(int $id)
    {
        $user = new User($this->getDB());
        $result = $user->delete($id);

        if ($result) {
            return header('Location: /users');
        }
    }
}
