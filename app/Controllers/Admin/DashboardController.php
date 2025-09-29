<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\QueueModel;
use App\Models\DoctorModel;
use App\Models\PatientModel;

class DashboardController extends BaseController
{
    protected $reservationModel;
    protected $queueModel;
    protected $doctorModel;
    protected $patientModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->queueModel = new QueueModel();
        $this->doctorModel = new DoctorModel();
        $this->patientModel = new PatientModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $today = date('Y-m-d');
        
        $data = [
            'title' => 'Dashboard Admin',
            'stats' => [
                'pending_reservations' => $this->reservationModel->where('status', 'pending')->countAllResults(),
                'today_reservations' => $this->reservationModel->where('reservation_date', $today)->countAllResults(),
                'today_queues' => $this->queueModel->where('queue_date', $today)->countAllResults(),
                'active_doctors' => $this->doctorModel->where('is_active', true)->countAllResults(),
                'total_patients' => $this->patientModel->countAllResults(),
            ],
            'recent_reservations' => $this->reservationModel->getReservationsWithDetails(null, null),
            'today_queues' => $this->queueModel->getTodayQueuesWithPatients($today),
            'current_queue' => $this->queueModel->getCurrentQueue($today)
        ];

        return view('admin/dashboard', $data);
    }
}