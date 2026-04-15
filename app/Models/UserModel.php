<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'password', 'role_id',
        'student_id', 'course', 'year_level', 
        'section', 'phone', 'address', 'profile_image'
    ];

    protected $useTimestamps = false;

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    public function getStudents(): array
    {
        return $this->db->table('users u')
            ->select('u.*, r.name AS role_name')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('r.name', 'student')
            ->where('u.deleted_at IS NULL')
            ->orderBy('u.name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getStudentById(int $id): ?array
    {
        return $this->db->table('users u')
            ->select('u.*, r.name AS role_name')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('u.id', $id)
            ->where('r.name', 'student')
            ->where('u.deleted_at IS NULL')
            ->get()
            ->getRowArray() ?: null;
    }
}

