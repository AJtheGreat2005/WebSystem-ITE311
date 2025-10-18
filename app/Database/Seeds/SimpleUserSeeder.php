<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SimpleUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Admin User',
            'email' => 'admin@lms.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
        
        echo "Admin user created successfully!\n";
        echo "Email: admin@lms.com\n";
        echo "Password: admin123\n";
    }
}
