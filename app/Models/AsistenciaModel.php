<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $table = 'asistencia';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'fecha_clase',
        'estado',
        'estudiante_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    // Relación con estudiante
    public function estudiante()
    {
        return $this->select('asistencia.*, estudiante.nombre_estudiante, estudiante.codigo')
            ->join('estudiante', 'estudiante.id = asistencia.estudiante_id');
    }
}
