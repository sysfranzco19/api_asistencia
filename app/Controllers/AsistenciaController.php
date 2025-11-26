<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AsistenciaModel;

class AsistenciaController extends ResourceController
{
    protected $modelName = 'App\Models\AsistenciaModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->estudiante()->findAll());
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
    public function registrarQR()
    {
        $data = $this->request->getJSON(true);

        if (!isset($data['qr_code'])) {
            return $this->failValidationError('El campo qr_code es requerido.');
        }

        $qrValue = $data['qr_code'];

        // 1. Buscar estudiante por código o por ID
        $estudianteModel = new \App\Models\EstudianteModel();
        
        // Si tu QR contiene directamente el ID (ejemplo: 23)
        $estudiante = $estudianteModel->where('id', $qrValue)->first();

        // Si tu QR contiene un código especial, usa:
        // $estudiante = $estudianteModel->where('codigo', $qrValue)->first();

        if (!$estudiante) {
            return $this->failNotFound('Estudiante no encontrado para el QR: ' . $qrValue);
        }

        // 2. Verificar si ya tiene asistencia registrada hoy
        $asistenciaModel = new \App\Models\AsistenciaModel();
        $fechaHoy = date('Y-m-d');

        $yaMarcado = $asistenciaModel
            ->where('estudiante_id', $estudiante['id'])
            ->where('fecha_clase', $fechaHoy)
            ->first();

        if ($yaMarcado) {
            return $this->respond([
                'status' => 'warning',
                'message' => 'El estudiante ya marcó asistencia hoy.',
                'estudiante' => $estudiante,
                'asistencia' => $yaMarcado
            ]);
        }

        // 3. Registrar asistencia
        $saveData = [
            'fecha_clase' => $fechaHoy,
            'estado' => 'Presente',
            'estudiante_id' => $estudiante['id'],
        ];

        $asistenciaModel->insert($saveData);

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Asistencia registrada correctamente.',
            'estudiante' => $estudiante,
            'asistencia' => $saveData
        ]);
    }

}
