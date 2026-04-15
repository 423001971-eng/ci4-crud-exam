<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Simple Students API Controller
 * 
 * GET /api/v1/students - List all students
 * GET /api/v1/students/{id} - Get one student
 * 
 * Protected by api_auth filter. Simple version!
 * Returns users where role = 'student'
 */

class StudentsController extends Controller
{
    /**
     * Get list of all students
     */
    public function index(): ResponseInterface
    {
        // Use UserModel to get students (already filters role='student')
        $userModel = new UserModel();
        $students = $userModel->getStudents();

        // Simple success response
        return $this->response
            ->setJSON([
                'status' => 'success',
                'message' => 'Students list retrieved',
                'data' => $students  // Model already sanitizes password etc.
            ]);
    }

    /**
     * Get single student by ID
     */
    public function show(int $id): ResponseInterface
    {
        // Get student by ID (filters role='student')
        $userModel = new UserModel();
        $student = $userModel->getStudentById($id);

        if (!$student) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Student not found',
                    'data' => null
                ]);
        }

        // Success response
        return $this->response
            ->setJSON([
                'status' => 'success',
                'message' => 'Student retrieved',
                'data' => $student
            ]);
    }
}
?>

