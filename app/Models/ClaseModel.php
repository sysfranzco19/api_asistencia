<?php

namespace App\Models;

use CodeIgniter\Model;

class ClaseModel extends Model
{
    protected $table = 'clase';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre_clase',
        'abreviado',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
