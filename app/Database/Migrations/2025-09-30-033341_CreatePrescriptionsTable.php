<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePrescriptionsTables extends Migration
{
    public function up()
    {
        // 1. Tabel Header Resep (Prescriptions) - Mencatat Transaksi Utama
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'patient_id' => [ // Siapa yang diresepkan
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'doctor_id' => [ // Dokter yang meresepkan/merekomendasikan
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'user_id' => [ // Admin/Apoteker yang mencatat/menjual
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'Admin/User yang mencatat resep',
            ],
            'prescription_date' => [
                'type' => 'DATETIME',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'status' => [ // Status transaksi: DRAFT, COMPLETED, CANCELLED, etc.
                'type' => 'ENUM',
                'constraint' => ['DRAFT', 'COMPLETED', 'CANCELLED'],
                'default' => 'DRAFT',
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
        // Foreign Keys (Asumsi tabel patients, doctors, users sudah ada)
        $this->forge->addForeignKey('patient_id', 'patients', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('doctor_id', 'doctors', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('prescriptions');

        // 2. Tabel Detail Item Resep (Prescription Items) - Mencatat Obat yang Diberikan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'prescription_id' => [ // Kunci ke header transaksi
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'drug_id' => [ // Obat yang diresepkan (Asumsi tabel drugs sudah ada)
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'dosage_instruction' => [ // Aturan minum
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'price_per_unit' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('prescription_id', 'prescriptions', 'id', 'CASCADE', 'CASCADE'); // Jika header dihapus, detail ikut dihapus
        $this->forge->addForeignKey('drug_id', 'drugs', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('prescription_items');
    }

    public function down()
    {
        $this->forge->dropTable('prescription_items');
        $this->forge->dropTable('prescriptions');
    }
}
