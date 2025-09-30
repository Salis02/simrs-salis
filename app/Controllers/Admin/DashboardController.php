<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use App\Models\QueueModel;
use App\Models\DoctorModel;
use App\Models\PatientModel;
use App\Models\PrescriptionModel;

class DashboardController extends BaseController
{
    protected $reservationModel;
    protected $queueModel;
    protected $doctorModel;
    protected $patientModel;
    protected $prescriptionModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->queueModel = new QueueModel();
        $this->doctorModel = new DoctorModel();
        $this->patientModel = new PatientModel();
        $this->prescriptionModel = new PrescriptionModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $today = date('Y-m-d');
        $salesResult = $this->prescriptionModel
            ->selectSum('total_amount', 'today_sales')
            ->where('DATE(prescription_date)', $today)
            ->first();

        $todaySales = $salesResult['today_sales'] ?? 0;
        $data = [
            'title' => 'Dashboard Admin',
            'stats' => [
                'pending_reservations' => $this->reservationModel->where('status', 'pending')->countAllResults(),
                'today_reservations' => $this->reservationModel->where('reservation_date', $today)->countAllResults(),
                'today_queues' => $this->queueModel->where('queue_date', $today)->countAllResults(),
                'active_doctors' => $this->doctorModel->where('is_active', true)->countAllResults(),
                'total_patients' => $this->patientModel->countAllResults(),
                'today_sales' => $todaySales,
            ],
            'recent_reservations' => $this->reservationModel->getReservationsWithDetails(null, null),
            'today_queues' => $this->queueModel->getTodayQueuesWithPatients($today),
            'current_queue' => $this->queueModel->getCurrentQueue($today)
        ];

        return view('admin/dashboard', $data);
    }
}
