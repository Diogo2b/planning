<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Session;

class SessionController extends Controller
{
    public function welcome()
    {
        return $this->view('sessions.welcome');
    }
    public function index()
    {
        $sessions = (new Session($this->getDB()))->all();

        return $this->view('sessions.index', [
            'sessions' => $sessions
        ]);
    }

    public function create()
    {
        return $this->view('sessions.create');
    }

    public function createPost()
    {
        $data = $_POST;
        $session = new Session($this->getDB());
        $errors = $session->validate($data);
        if ($errors) {
            return $this->view('sessions.create', [
                'previousData' => $data,
                'errors' => $errors,
            ]);
        }

        $session = new Session($this->getDB());
        $result = $session->create($_POST);
        if ($result) {
            return header('Location: /sessions');
        }
    }

    public function update(int $id)
    {
        $session = (new Session($this->getDB()))->findById($id);
        return $this->view('sessions.update', [
            'session' => $session,
        ]);
    }

    public function updatePost(int $id)
    {

        $data = $_POST;
        $session = new Session($this->getDB());
        $errors = $session->validate($data);

        if ($errors) {
            return $this->view('sessions.update', [
                'errors' => $errors,
                'session' => (new Session($this->getDB()))->findById($id)
            ]);
        }

        $session = new Session($this->getDB());
        $result = $session->update($id, $_POST);

        if ($result) {
            return header('Location: /sessions');
        }
    }


    public function delete(int $id)
    {
        $session = new Session($this->getDB());
        $result = $session->delete($id);

        if ($result) {
            return header('Location: /sessions');
        }
    }
}
