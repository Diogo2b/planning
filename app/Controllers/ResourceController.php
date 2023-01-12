<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Resource;


class ResourceController extends Controller
{
    public function index()
    {
        $this->isAdmin();
        $resources = (new Resource($this->getDB()))->all();

        return $this->view('resources.index', [
            'resources' => $resources,

        ]);
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('resources.create', []);
    }

    public function createPost()
    {
        $this->isAdmin();
        $data = $_POST;
        $resource = new Resource($this->getDB());
        $errors = $resource->validate($data);


        if ($errors) {
            return $this->view('resources.create', [
                'previousData' => $data,
                'errors' => $errors,

            ]);
        }

        $resource = new Resource($this->getDB());
        $result = $resource->create($_POST);
        if ($result) {
            return header('Location: /resources');
        }
    }

    public function update(int $id)
    {
        $this->isAdmin();
        $resource = (new Resource($this->getDB()))->findById($id);
        return $this->view('resources.update', [
            'resource' => $resource,

        ]);
    }

    public function updatePost(int $id)
    {
        $this->isAdmin();
        $data = $_POST;
        $resource = new Resource($this->getDB());

        $errors = $resource->validate(['id' => $id, ...$data]);

        if ($errors) {
            return $this->view('resources.update', [
                'errors' => $errors,
                'resource' => (new Resource($this->getDB()))->findById($id),


            ]);
        }

        $resource = new Resource($this->getDB());
        $result = $resource->update($id, $_POST);

        if ($result) {
            return header('Location: /resources');
        }
    }


    public function delete(int $id)
    {
        $this->isAdmin();
        $resource = new Resource($this->getDB());
        $result = $resource->delete($id);

        if ($result) {
            return header('Location: /resources');
        }
    }
}
