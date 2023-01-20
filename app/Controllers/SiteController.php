<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Site;

class SiteController extends Controller
{
    public function welcome()
    {
        return $this->view('sites.welcome');
    }
    public function index()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $sites = (new Site($this->getDB()))->all();

        return $this->view('sites.index', [
            'sites' => $sites
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        return $this->view('sites.create');
    }

    public function createPost()
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $data = $_POST;
        $site = new Site($this->getDB());
        $errors = $site->validate($data);
        if ($errors) {
            return $this->view('sites.create', [
                'previousData' => $data,
                'errors' => $errors,
            ]);
        }

        $site = new Site($this->getDB());
        $result = $site->create($_POST);
        if ($result) {
            return header('Location: /sites');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $site = (new Site($this->getDB()))->findById($id);
        return $this->view('sites.update', [
            'site' => $site,
        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();

        $this->checkSessionTimeout();
        $data = $_POST;
        $site = new Site($this->getDB());
        $errors = $site->validate($data);

        if ($errors) {
            return $this->view('sites.update', [
                'errors' => $errors,
                'site' => (new Site($this->getDB()))->findById($id)
            ]);
        }

        $site = new Site($this->getDB());
        $result = $site->update($id, $_POST);

        if ($result) {
            return header('Location: /sites');
        }
    }


    public function delete(int $id)
    {
        $this->isAdmin();
        $this->checkSessionTimeout();
        $site = new Site($this->getDB());
        $result = $site->delete($id);

        if ($result) {
            return header('Location: /sites');
        }
    }
}
