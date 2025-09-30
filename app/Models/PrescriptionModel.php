<?php

namespace App\Models;

use CodeIgniter\Model;

class PrescriptionModel extends Model
{
    protected $table = 'prescriptions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = [
        'patient_id', 'doctor_id', 'user_id', 'prescription_date', 'notes', 'total_amount', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'patient_id' => 'required|integer',
        'doctor_id' => 'required|integer',
        'user_id' => 'required|integer',
        'prescription_date' => 'required|valid_date',
        'total_amount' => 'required|numeric|greater_than_equal_to[0]',
        'status' => 'required|in_list[DRAFT,COMPLETED,CANCELLED]',
        'notes' => 'permit_empty',
    ];

    /**
     * Join dengan Patient, Doctor, dan User untuk tampilan di Index (Laporan)
     * CATATAN: Fungsi ini mengasumsikan model Patient, Doctor, dan User sudah ada.
     */
    public function getFullPrescriptionData()
    {
        return $this->select('prescriptions.*, 
                              patients.name as patient_name, 
                              doctors.name as doctor_name, 
                              users.username as user_name') // Asumsi UserModel memiliki kolom username
                    ->join('patients', 'patients.id = prescriptions.patient_id')
                    ->join('doctors', 'doctors.id = prescriptions.doctor_id')
                    ->join('users', 'users.id = prescriptions.user_id')
                    ->orderBy('prescriptions.prescription_date', 'DESC')
                    ->findAll();
    }
}
