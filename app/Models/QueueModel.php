<?php

namespace App\Models;

use CodeIgniter\Model;

class QueueModel extends Model
{
    protected $table = 'queues';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'patient_id',
        'queue_number',
        'queue_date',
        'status',
        'served_at',
        'completed_at',
        'notes'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'patient_id' => 'int',
        'queue_number' => 'int',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'patient_id' => 'required|integer',
        'queue_date' => 'required|valid_date',
        'status' => 'required|in_list[waiting,serving,completed,cancelled]',
    ];

    public function getNextQueueNumber($date = null)
    {
        $date = $date ?: date('Y-m-d');

        $lastQueue = $this->where('queue_date', $date)
            ->orderBy('queue_number', 'DESC')
            ->first();

        return $lastQueue ? $lastQueue['queue_number'] + 1 : 1;
    }

    public function getTodayQueuesWithPatients($date = null)
    {
        $date = $date ?: date('Y-m-d');

        return $this->db->table($this->table)
            ->select('queues.*, patients.name as patient_name, patients.phone')
            ->join('patients', 'queues.patient_id = patients.id')
            ->where('queues.queue_date', $date)
            ->orderBy('queues.queue_number', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getCurrentQueue($date = null)
    {
        $date = $date ?: date('Y-m-d');

        return $this->db->table($this->table)
            ->select('queues.*, patients.name as patient_name')
            ->join('patients', 'queues.patient_id = patients.id')
            ->where('queues.queue_date', $date)
            ->where('queues.status', 'serving')
            ->get()
            ->getRowArray();
    }

    public function getWaitingCount($date = null)
    {
        $date = $date ?: date('Y-m-d');

        return $this->where('queue_date', $date)
            ->where('status', 'waiting')
            ->countAllResults();
    }
}
