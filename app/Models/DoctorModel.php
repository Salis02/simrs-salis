<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name', 'specialization', 'phone', 'email', 'is_active'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'is_active' => 'boolean'
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'specialization' => 'required|min_length[3]|max_length[100]',
        'phone' => 'permit_empty|max_length[20]',
        'email' => 'permit_empty|valid_email|max_length[100]',
    ];

    public function getActiveDoctors()
    {
        return $this->where('is_active', true)->findAll();
    }

    public function getDoctorWithWorkingHours($doctorId, $date = null)
    {
        $builder = $this->db->table($this->table)
            ->select('doctors.*, working_hours.date, working_hours.start_time, working_hours.end_time, working_hours.duration_per_patient, working_hours.max_patients, working_hours.is_available_for_reservation')
            ->join('working_hours', 'doctors.id = working_hours.doctor_id', 'left')
            ->where('doctors.id', $doctorId)
            ->where('doctors.is_active', true);

        if ($date) {
            $builder->where('working_hours.date', $date);
        }

        return $builder->get()->getResultArray();
    }
}