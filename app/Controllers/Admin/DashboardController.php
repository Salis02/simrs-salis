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

        // 1️⃣ Pendapatan hari ini
        $todaySales = $this->prescriptionModel
            ->selectSum('total_amount', 'today_sales')
            ->where('DATE(created_at)', $today)
            ->where('status', 'COMPLETED')
            ->first()['today_sales'] ?? 0;

        // 2️⃣ Pendapatan minggu ini
        $startOfWeek = date('Y-m-d', strtotime('monday this week'));
        $endOfWeek   = date('Y-m-d', strtotime('sunday this week'));
        $weeklySales = $this->prescriptionModel
            ->selectSum('total_amount', 'weekly_sales')
            ->where('DATE(created_at) >=', $startOfWeek)
            ->where('DATE(created_at) <=', $endOfWeek)
            ->where('status', 'COMPLETED')
            ->first()['weekly_sales'] ?? 0;

        // 3️⃣ Pendapatan bulan ini
        $startOfMonth = date('Y-m-01');
        $endOfMonth   = date('Y-m-t');
        $monthlySales = $this->prescriptionModel
            ->selectSum('total_amount', 'monthly_sales')
            ->where('DATE(created_at) >=', $startOfMonth)
            ->where('DATE(created_at) <=', $endOfMonth)
            ->where('status', 'COMPLETED')
            ->first()['monthly_sales'] ?? 0;

        $data = [
            'title' => 'Dashboard Admin',
            'stats' => [
                'pending_reservations' => $this->reservationModel->where('status', 'pending')->countAllResults(),
                'today_reservations' => $this->reservationModel->where('reservation_date', $today)->countAllResults(),
                'today_queues' => $this->queueModel->where('queue_date', $today)->countAllResults(),
                'active_doctors' => $this->doctorModel->where('is_active', true)->countAllResults(),
                'total_patients' => $this->patientModel->countAllResults(),
                'today_sales' => $todaySales,
                'weekly_sales' => $weeklySales,
                'monthly_sales' => $monthlySales,
            ],
            'recent_reservations' => $this->reservationModel->getReservationsWithDetails(null, null),
            'today_queues' => $this->queueModel->getTodayQueuesWithPatients($today),
            'current_queue' => $this->queueModel->getCurrentQueue($today)
        ];

        return view('admin/dashboard', $data);
    }
}
