<?php

namespace App\Controllers;


use App\Models\Role;
use App\Models\User;
use App\Models\Formation;
use App\Controllers\Controller;



class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
        // $data = $_POST;
        // $user = (new User($this->getDB()))->getByEmail($_POST['email']);
        $user = (new User($this->getDB()))->getByEmail($_POST['email'], true);

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        // dd($_POST);
        // $errors = $user->validate($data);
        if ($user === false) {
            // echo ("Cet utilisateur n'existe pas");
            echo '<div class="alert alert-danger"> Utilisateur introuvable </div>';
            // if ($errors) {
            //     return $this->view('auth.login', [
            //         'errors' => $errors,
            //     ]);
            // }
            return $this->view('auth.login');
        }

        if (password_verify($_POST['password'], $user->password) === false) {
            echo '<div class="alert alert-danger"> Mot de passe incorrect </div>';
            return $this->view('auth.login');
        } else {

            $_SESSION['auth'] = (int) $user->id;
            $_SESSION['role_id'] = (int) $user->role_id;


            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $csrf_token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

                if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
                    //traitement d'erreur, par exemple, redirection vers une page d'erreur
                    echo '<div class="alert alert-success"> Vous êtes connecté! </div>';
                    return header('Location: /calendriers');
                }
                echo '<div class="alert alert-alert"> UPS!!! </div>';
                return header('Location: /calendriers');
                // return $this->view('calendriers.index');
                unset($_POST);
            }
        }
    }



    public function logout()
    {

        unset($_POST);
        session_destroy();

        return header('Location: /');
    }


    public function index()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $users = (new User($this->getDB()))->all();
        $roles = (new Role($this->getDB()))->all();
        $formations = (new Formation($this->getDB()))->all();

        return $this->view('users.index', [
            'users' => $users,
            'roles' => $roles,
            'formations' => $formations,
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $formations = (new Formation($this->getDB()))->all();
        return $this->view('users.create', [

            'roles' => (new Role($this->getDB()))->all(),
            'formations' => $formations,


        ]);
    }

    public function createPost()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $user = new User($this->getDB());
        $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $data['password'] = $hashed_password;
        $errors = $user->validate($data);
        $formations = (new Formation($this->getDB()))->all();

        if ($errors) {
            return $this->view('users.create', [
                'previousData' => $data,
                'errors' => $errors,
                'roles' => (new Role($this->getDB()))->all(),
                'formations' => $formations

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
        $this->checkSessionTimeout();
        $user = (new User($this->getDB()))->findById($id);


        return $this->view('users.update', [
            'user' => $user,
            'roles' => (new Role($this->getDB()))->all(),
            'formations' => (new Formation($this->getDB()))->all(),

        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;

        $user = new User($this->getDB());
        $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $data['password'] = $hashed_password;
        $errors = $user->validate(['id' => $id, ...$data]);
        if ($errors) {
            return $this->view('users.update', [
                'errors' => $errors,
                'user' => $user->findById($id),
                'roles' => (new Role($this->getDB()))->all(),
                'formations' => (new Formations($this->getDB()))->all(),

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
        $this->checkSessionTimeout();
        $user = new User($this->getDB());
        $result = $user->delete($id);

        if ($result) {
            return header('Location: /users');
        }
    }
}
