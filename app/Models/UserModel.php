<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    
    // THIS IS THE MISSING PART:
    protected $allowedFields    = ['name', 'email', 'password']; 

    // Optional: but good for your exam
    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
}