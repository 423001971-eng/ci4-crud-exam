<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'slug' => 'coordinator',
            'name' => 'Coordinator',
        ];

        // Using Query Builder
        $this->db->table('roles')->insert($data);
    }
}
