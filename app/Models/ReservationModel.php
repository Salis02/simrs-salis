<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'patient_id', 'doctor_id', 'working_hour_id', 'reservation_date', 
        'reservation_time', 'status', 'notes'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'patient_id' => 'int',
        'doctor_id' => 'int',
        'working_hour_id' => 'int',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'patient_id' => 'required|integer',
        'doctor_id' => 'required|integer',
        'working_hour_id' => 'required|integer',
        'reservation_date' => 'required|valid_date',
        'reservation_time' => 'required',
        'status' => 'required|in_list[pending,approved,rejected,completed,cancelled]',
    ];

    public function getReservationsWithDetails($status = null, $date = null)
    {
        $builder = $this->db->table($this->table)
            ->select('reservations.*, patients.name as patient_name, patients.phone, doctors.name as doctor_name, doctors.specialization')
            ->join('patients', 'reservations.patient_id = patients.id')
            ->join('doctors', 'reservations.doctor_id = doctors.id')
            ->orderBy('reservations.reservation_date', 'DESC')
            ->orderBy('reservations.reservation_time', 'ASC');

        if ($status) {
            $builder->where('reservations.status', $status);
        }

        if ($date) {
            $builder->where('reservations.reservation_date', $date);
        }

        return $builder->get()->getResultArray();
    }

    public function getPendingReservations()
    {
        return $this->getReservationsWithDetails('pending');
    }

    public function getTodayReservations()
    {
        return $this->getReservationsWithDetails(null, date('Y-m-d'));
    }
}