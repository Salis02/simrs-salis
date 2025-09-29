<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $workingHourModel;
    protected $queueModel;
    protected $patientModel;

    public function __construct()
    {
        $this->workingHourModel = new \App\Models\WorkingHourModel();
        $this->queueModel = new \App\Models\QueueModel();
        $this->patientModel = new \App\Models\PatientModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMRS - RS Salis Family',
            'available_doctors' => $this->workingHourModel->getAvailableDoctors(),
            'current_queue' => $this->queueModel->getCurrentQueue(),
            'waiting_count' => $this->queueModel->getWaitingCount(),
            'queue_date' => date('Y-m-d')
        ];

        return view('public/home', $data);
    }

    public function getAvailableSlots()
    {
        $workingHourId = $this->request->getGet('working_hour_id');
        
        if (!$workingHourId) {
            return $this->errorResponse('Working hour ID diperlukan');
        }

        $slots = $this->workingHourModel->getAvailableSlots($workingHourId);
        
        return $this->successResponse('Slot berhasil diambil', ['slots' => $slots]);
    }
}