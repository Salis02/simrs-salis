<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReservationModel;

class ReservationController extends BaseController
{
    protected $reservationModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $filter = $this->request->getGet();
        $status = $filter['status'] ?? null;
        $date = $filter['date'] ?? null;

        $data = [
            'title' => 'Kelola Reservasi',
            'reservations' => $this->reservationModel->getReservationsWithDetails($status, $date),
            'filter' => $filter
        ];

        return view('admin/reservations/index', $data);
    }

    public function updateStatus($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');

         if (empty($status)) {
        return $this->errorResponse('DEBUG: Status yang diterima kosong!');
    }
        if (!in_array($status, ['approved', 'rejected', 'completed', 'cancelled'])) {
            return $this->errorResponse('Status tidak valid');
        }

        $updateData = ['status' => $status];
        if ($notes) {
            $updateData['notes'] = $notes;
        }

        if ($this->reservationModel->update($id, $updateData)) {
            return $this->successResponse('Status reservasi berhasil diupdate');
        } else {
            return $this->errorResponse('Gagal mengupdate status reservasi');
        }
    }

    public function show($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $reservation = $this->reservationModel->getReservationsWithDetails();
        $reservation = array_filter($reservation, function($r) use ($id) {
            return $r['id'] == $id;
        });

        if (empty($reservation)) {
            return redirect()->to('/admin/reservations')->with('error', 'Reservasi tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Reservasi',
            'reservation' => reset($reservation)
        ];

        return view('admin/reservations/show', $data);
    }
}