<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'email', 'password', 'student_id', 'course', 'year_level', 'section', 'phone', 'address', 'profile_image'];

    // FIX: Set this to false
    protected $useTimestamps    = false; 
    
    // If you set it to true, you MUST have created_at and updated_at columns in your DB
}