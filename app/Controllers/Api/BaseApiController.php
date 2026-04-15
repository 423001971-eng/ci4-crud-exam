<?php

namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\BaseResource;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Base controller for API controllers
 * 
 * Provides JSON response helpers and exposes $apiUser from ApiAuthFilter
 */
class BaseApiController extends BaseResource
{
    use ResponseTrait;

    /**
     * @param \CodeIgniter\\HTTP\\RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
        $this->apiUser = $GLOBALS['apiUser'] ?? null;
    }

    /**
     * API user set by ApiAuthFilter
     */
    public ?array $apiUser = null;

    /**
     * OK (200) JSON response
     */
    protected function ok($data = null, string $message = 'OK'): ResponseInterface
    {
        $payload = ['status' => 'success'];
        if ($message) $payload['message'] = $message;
        if ($data !== null) $payload['data'] = $data;

        return $this->respond($payload);
    }

    /**
     * Created (201) JSON response
     */
    protected function created($data, string $message = 'Created'): ResponseInterface
    {
        $payload = ['status' => 'success', 'message' => $message, 'data' => $data];
        return $this->respondCreated($payload);
    }

    /**
     * Bad Request (400) JSON response
     */
    protected function badRequest(string $message = 'Bad Request'): ResponseInterface
    {
        return $this->failValidationErrors([$message]);
    }

    /**
     * Forbidden (403) JSON response
     */
    protected function forbidden(string $message = 'Forbidden'): ResponseInterface
    {
        return $this->failForbidden($message);
    }

    /**
     * Not Found (404) JSON response
     */
    protected function notFound(string $message = 'Not Found'): ResponseInterface
    {
        return $this->failNotFound($message);
    }
}
