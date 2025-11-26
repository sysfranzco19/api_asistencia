<?php

namespace App\Models;

use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'codigo',
        'nombre_estudiante',
        'clase_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    // Relación con clase
    public function clase()
    {
        return $this->select('estudiante.*, clase.nombre_clase, clase.abreviado')
            ->join('clase', 'clase.id = estudiante.clase_id');
    }
}
