<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkingHourModel extends Model
{
    protected $table = 'working_hours';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'doctor_id', 'date', 'start_time', 'end_time', 'duration_per_patient', 
        'max_patients', 'is_available_for_reservation'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'doctor_id' => 'int',
        'duration_per_patient' => 'int',
        'max_patients' => 'int',
        'is_available_for_reservation' => 'boolean'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'doctor_id' => 'required|integer',
        'date' => 'required|valid_date',
        'start_time' => 'required',
        'end_time' => 'required',
        'duration_per_patient' => 'required|integer|greater_than[0]',
        'max_patients' => 'required|integer|greater_than[0]',
    ];

    public function getAvailableDoctors($date = null)
    {
        $date = $date ?: date('Y-m-d');
        
        return $this->db->table($this->table)
            ->select('working_hours.*, doctors.name, doctors.specialization')
            ->join('doctors', 'working_hours.doctor_id = doctors.id')
            ->where('working_hours.date >=', $date)
            ->where('working_hours.is_available_for_reservation', true)
            ->where('doctors.is_active', true)
            ->orderBy('working_hours.date', 'ASC')
            ->orderBy('working_hours.start_time', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getAvailableSlots($workingHourId)
    {
        $workingHour = $this->find($workingHourId);
        if (!$workingHour) return [];

        // Get reserved slots
        $reservedSlots = $this->db->table('reservations')
            ->select('reservation_time')
            ->where('working_hour_id', $workingHourId)
            ->where('status !=', 'cancelled')
            ->where('status !=', 'rejected')
            ->get()
            ->getResultArray();

        $reserved = array_column($reservedSlots, 'reservation_time');

        // Generate available slots
        $slots = [];
        $startTime = strtotime($workingHour['start_time']);
        $endTime = strtotime($workingHour['end_time']);
        $duration = $workingHour['duration_per_patient'] * 60; // convert to seconds

        while ($startTime < $endTime) {
            $timeSlot = date('H:i:s', $startTime);
            if (!in_array($timeSlot, $reserved)) {
                $slots[] = $timeSlot;
            }
            $startTime += $duration;
        }

        return $slots;
    }
}