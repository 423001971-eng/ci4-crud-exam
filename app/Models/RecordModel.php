<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordModel extends Model
{
    protected $table         = 'records';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['name', 'description', 'email', 'course'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
