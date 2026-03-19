<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'name', 'email', 'password', 'role_id',
        'student_id', 'course', 'year_level', 
        'section', 'phone', 'address', 'profile_image'];


    protected $useTimestamps    = false; 
    
}