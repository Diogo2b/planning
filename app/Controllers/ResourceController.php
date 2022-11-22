<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = (new Resource($this->getDB()))->all();

        return $this->view('resources.index', [
            'resources' => $resources,
        ]);
    }

    public function create()
    {
        return $this->view('resources.create');
    }

    public function createPost()
    {
        $data = $_POST;
        $errors = Resource::validate($_POST);


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
        $resource = (new Resource($this->getDB()))->findById($id);
        return $this->view('resources.update', [
            'resource' => $resource,
        ]);
    }

    public function updatePost(int $id)
    {

        $errors = Resource::validate($_POST);

        if ($errors) {
            return $this->view('resources.update', [
                'errors' => $errors,
                'resource' => (new Resource($this->getDB()))->findById($id)
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
        $resource = new Resource($this->getDB());
        $result = $resource->delete($id);

        if ($result) {
            return header('Location: /resources');
        }
    }
}
