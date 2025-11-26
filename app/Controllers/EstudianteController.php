<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EstudianteModel;

class EstudianteController extends ResourceController
{
    protected $modelName = 'App\Models\EstudianteModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->clase()->findAll());
    }

    public function show($id = null)
    {
        return $this->respond($this->model->find($id));
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        $this->model->insert($data);
        return $this->respondCreated($data);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $this->model->update($id, $data);
        return $this->respond($data);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}
