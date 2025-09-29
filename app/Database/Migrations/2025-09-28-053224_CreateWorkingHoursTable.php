<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkingHoursTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'doctor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'start_time' => [
                'type' => 'TIME',
            ],
            'end_time' => [
                'type' => 'TIME',
            ],
            'duration_per_patient' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 60, // dalam menit
            ],
            'max_patients' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 10,
            ],
            'is_available_for_reservation' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('doctor_id', 'doctors', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('working_hours');
    }

    public function down()
    {
        $this->forge->dropTable('working_hours');
    }
}