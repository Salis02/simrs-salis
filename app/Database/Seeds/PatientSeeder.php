<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->date('Y-m-d', '2000-01-01'),
                'gender' => $faker->randomElement(['male', 'female']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('patients')->insertBatch($data);
    }
}