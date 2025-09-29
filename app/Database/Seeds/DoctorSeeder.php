<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Dr. Ahmad Hidayat, Sp.PD',
                'specialization' => 'Penyakit Dalam',
                'phone' => '081234567890',
                'email' => 'ahmad.hidayat@example.com',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Dr. Siti Nurhaliza, Sp.A',
                'specialization' => 'Anak',
                'phone' => '081234567891',
                'email' => 'siti.nurhaliza@example.com',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Dr. Budi Santoso, Sp.OG',
                'specialization' => 'Kandungan',
                'phone' => '081234567892',
                'email' => 'budi.santoso@example.com',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Dr. Maya Dewi, Sp.M',
                'specialization' => 'Mata',
                'phone' => '081234567893',
                'email' => 'maya.dewi@example.com',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Dr. Rizki Pratama, Sp.JP',
                'specialization' => 'Jantung',
                'phone' => '081234567894',
                'email' => 'rizki.pratama@example.com',
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('doctors')->insertBatch($data);
    }
}