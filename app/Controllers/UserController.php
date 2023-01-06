<?php

namespace App\Controllers;


use App\Models\Role;
use App\Models\User;
use App\Controllers\Controller;



class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {


        $user = (new User($this->getDB()))->getByFirstname($_POST['firstname']);

        if ($user === false) {
            dump("Cet utilisateur n'existe pas");
            return $this->view('auth.login');
        }

        if (password_verify($_POST['password'], $user->password) === false) {
            dump("mot de passe incorrect");
            return $this->view('auth.login');
        }

        $_SESSION['auth'] = (int) $user->id;
        return header('Location: /users');
    }




    public function logout()
    {
        session_destroy();

        return header('Location: /');
    }


    public function index()
    {
        $this->isAdmin();

        $users = (new User($this->getDB()))->all();
        $roles = (new Role($this->getDB()))->all();


        return $this->view('users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $this->isAdmin();

        return $this->view('users.create', [

            'roles' => (new Role($this->getDB()))->all(),


        ]);
    }

    public function createPost()
    {
        $data = $_POST;

        $user = new User($this->getDB());
        $errors = $user->validate($data);

        if ($errors) {
            return $this->view('users.create', [
                'previousData' => $data,
                'errors' => $errors,
                'roles' => (new Role($this->getDB()))->all(),

            ]);
        }

        $user = new User($this->getDB());
        $result = $user->create($data);

        if ($result) {
            return header('Location: /users');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $user = (new User($this->getDB()))->findById($id);

        return $this->view('users.update', [
            'user' => $user,
            'roles' => (new Role($this->getDB()))->all(),

        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();
        $data = $_POST;

        $user = new User($this->getDB());
        $errors = $user->validate(['id' => $id, ...$data]);
        if ($errors) {
            return $this->view('users.update', [
                'errors' => $errors,
                'user' => $user->findById($id),
                'roles' => (new Role($this->getDB()))->all(),

            ]);
        }
        $result = $user->update($id, $data);

        if ($result) {
            return header('Location: /users');
        }
    }

    public function delete(int $id)
    {
        $this->isAdmin();
        $user = new User($this->getDB());
        $result = $user->delete($id);

        if ($result) {
            return header('Location: /users');
        }
    }
}
