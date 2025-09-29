<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WorkingHourSeeder extends Seeder
{
    public function run()
    {
        $doctors = $this->db->table('doctors')->get()->getResultArray();
        
        $data = [];
        
        // Generate working hours for next 30 days
        for ($day = 0; $day < 30; $day++) {
            $date = date('Y-m-d', strtotime("+$day days"));
            
            // Skip Sundays
            if (date('w', strtotime($date)) == 0) continue;
            
            foreach ($doctors as $doctor) {
                // Random schedule for each doctor
                $schedules = [
                    ['08:00:00', '12:00:00'],
                    ['13:00:00', '17:00:00'],
                    ['08:00:00', '11:00:00'],
                    ['14:00:00', '18:00:00'],
                ];
                
                $randomSchedule = $schedules[array_rand($schedules)];
                
                // Not all doctors work every day
                if (rand(1, 100) > 70) continue;
                
                $data[] = [
                    'doctor_id' => $doctor['id'],
                    'date' => $date,
                    'start_time' => $randomSchedule[0],
                    'end_time' => $randomSchedule[1],
                    'duration_per_patient' => rand(30, 60), // 30-60 minutes per patient
                    'max_patients' => rand(8, 15),
                    'is_available_for_reservation' => rand(0, 1), // Some slots for reservation, some for walk-in
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        $this->db->table('working_hours')->insertBatch($data);
    }
}