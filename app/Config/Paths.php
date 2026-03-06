<?php

namespace Config;

/**
 * Paths configuration for CodeIgniter 4
 *
 * Adjusts all folder paths relative to this file.
 */
class Paths
{
    public string $systemDirectory;
    public string $appDirectory;
    public string $writableDirectory;
    public string $testsDirectory;
    public string $viewDirectory;

    public function __construct()
    {
        // Base path: app folder (C:\xampp\htdocs\ci4-crud-exam\app)
        $base = realpath(__DIR__ . '/..');

        // ----------------------------
        // SYSTEM folder
        // ----------------------------
        // Vendor folder must exist: C:\xampp\htdocs\ci4-crud-exam\vendor
        $this->systemDirectory = realpath($base . '/../vendor/codeigniter4/framework/system');

        // ----------------------------
        // APP folder
        // ----------------------------
        $this->appDirectory = $base;

        // ----------------------------
        // WRITABLE folder
        // ----------------------------
        $this->writableDirectory = realpath($base . '/../writable');

        // ----------------------------
        // TESTS folder
        // ----------------------------
        $this->testsDirectory = realpath($base . '/../tests');

        // ----------------------------
        // VIEWS folder
        // ----------------------------
        $this->viewDirectory = $this->appDirectory . '/Views';
    }
}