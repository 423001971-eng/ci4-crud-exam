<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\ApiTokenModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Simple API Authentication Controller
 * 
 * POST /api/login - Simplified login (sample token for exam)
 * POST /api/v1/auth/token - Full auth token
 * DELETE /api/v1/auth/token - Revoke token
 */
class AuthController extends Controller
{
    // Token expires in 24 hours
    private const TOKEN_EXPIRE_HOURS = 24;

    /**
     * Simplified login endpoint for exam - returns sample token
     */
    public function login()
    {
        // This is a simplified version for your exam
        $data = [
            'status' => 200,
            'token'  => 'sample_token_12345', // In a real app, this is generated
            'message' => 'Login Successful'
        ];
        return $this->response->setJSON($data);
    }

    /**
     * Create new auth token
     * Accept JSON or form: {"email": "...", "password": "..."}
     */
    public function createToken(): ResponseInterface
    {
        // Get email and password from JSON or POST form
        $email = $this->request->getJsonVar('email') ?? $this->request->getPost('email');
        $password = $this->request->getJsonVar('password') ?? $this->request->getPost('password');

        // Simple validation
        if (empty($email) || empty($password)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Email and password are required.'
                ]);
        }

        // Find user by email
        $userModel = new UserModel();
        $user = $userModel->findByEmail($email);

        // Check user exists and password matches
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ]);
        }

        // Generate secure random token (64 chars hex)
        $token = bin2hex(random_bytes(32));

        // Set expiration time (24 hours from now)
        $expires_at = date('Y-m-d H:i:s', time() + (self::TOKEN_EXPIRE_HOURS * 3600));

        // Save token to database
        $tokenModel = new ApiTokenModel();
        $tokenModel->insert([
            'user_id' => $user['id'],
            'token' => $token,
            'expires_at' => $expires_at,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Success response
        return $this->response
            ->setStatusCode(201)  // Created
            ->setJSON([
                'status' => 'success',
                'message' => 'Token created successfully',
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'expires_at' => $expires_at,
                    'user' => [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email']
                    ]
                ]
            ]);
    }

    /**
     * Delete/revoke the current token
     * Expects: Authorization: Bearer <token>
     */
    public function deleteToken(): ResponseInterface
    {
        // Get token from Authorization header (Bearer token)
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (strpos($authHeader, 'Bearer ') !== 0) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Bearer token required'
                ]);
        }

        // Extract token (remove "Bearer " prefix)
        $token = trim(substr($authHeader, 7));

        // Delete token from database
        $tokenModel = new ApiTokenModel();
        $tokenModel->deleteByToken($token);

        // Success - token revoked
        return $this->response
            ->setJSON([
                'status' => 'success',
                'message' => 'Token revoked successfully',
                'data' => null
            ]);
    }
}
?>

