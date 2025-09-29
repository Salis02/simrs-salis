<?php

namespace App\Controllers;

use App\Models\QueueModel;
use App\Models\PatientModel;

class QueueController extends BaseController
{
    protected $queueModel;
    protected $patientModel;

    public function __construct()
    {
        $this->queueModel = new QueueModel();
        $this->patientModel = new PatientModel();
    }

    public function takeQueue()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $data = $this->request->getJSON(true);
        
        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'patient_name' => 'required|min_length[3]|max_length[100]',
            'patient_phone' => 'required|min_length[10]|max_length[20]',
            'patient_address' => 'permit_empty',
            'patient_birth_date' => 'permit_empty|valid_date',
            'patient_gender' => 'required|in_list[male,female]',
        ]);

        if (!$validation->run($data)) {
            return $this->errorResponse('Data tidak valid', 400, $validation->getErrors());
        }

        try {
            // Check if it's within working hours
            $currentTime = date('H:i:s');
            $currentDate = date('Y-m-d');
            
            // You can set working hours for queue in config or database
            // For now, let's assume 08:00 - 16:00
            if ($currentTime < '08:00:00' || $currentTime > '16:00:00') {
                return $this->errorResponse('Antrian hanya bisa diambil pada jam kerja (08:00 - 16:00)');
            }

            // Find or create patient
            $patient = $this->patientModel->findOrCreateByPhone([
                'name' => $data['patient_name'],
                'phone' => $data['patient_phone'],
                'address' => $data['patient_address'] ?? '',
                'birth_date' => $data['patient_birth_date'] ?? null,
                'gender' => $data['patient_gender']
            ]);

            // Check if patient already has queue today
            $existingQueue = $this->queueModel->where('patient_id', $patient['id'])
                ->where('queue_date', $currentDate)
                ->where('status !=', 'cancelled')
                ->first();

            if ($existingQueue) {
                return $this->errorResponse('Anda sudah mengambil antrian hari ini');
            }

            // Get next queue number
            $queueNumber = $this->queueModel->getNextQueueNumber($currentDate);

            // Create queue
            $queueData = [
                'patient_id' => $patient['id'],
                'queue_number' => $queueNumber,
                'queue_date' => $currentDate,
                'status' => 'waiting'
            ];

            $queueId = $this->queueModel->insert($queueData);
            
            if ($queueId) {
                return $this->successResponse('Berhasil mengambil antrian', [
                    'queue_number' => $queueNumber,
                    'queue_date' => $currentDate,
                    'patient_name' => $patient['name']
                ]);
            } else {
                return $this->errorResponse('Gagal mengambil antrian');
            }

        } catch (\Exception $e) {
            return $this->errorResponse('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getQueueStatus()
    {
        $currentQueue = $this->queueModel->getCurrentQueue();
        $waitingCount = $this->queueModel->getWaitingCount();
        
        return $this->successResponse('Status antrian', [
            'current_queue' => $currentQueue,
            'waiting_count' => $waitingCount
        ]);
    }
}