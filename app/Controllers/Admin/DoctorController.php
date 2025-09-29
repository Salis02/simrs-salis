<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DoctorModel;

class DoctorController extends BaseController
{
    protected $doctorModel;

    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $data = [
            'title' => 'Kelola Dokter',
            'doctors' => $this->doctorModel->findAll()
        ];

        return view('admin/doctors/index', $data);
    }

    public function create()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            
            if ($this->doctorModel->insert($data)) {
                return redirect()->to('/admin/doctors')->with('success', 'Dokter berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->doctorModel->errors());
            }
        }

        return view('admin/doctors/create', [
            'title' => 'Tambah Dokter',
              'action' => site_url('/admin/doctors/create'),
              'doctor' => null
        ]);
    }

    public function edit($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $doctor = $this->doctorModel->find($id);
        if (!$doctor) {
            return redirect()->to('/admin/doctors')->with('error', 'Dokter tidak ditemukan');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            
            if ($this->doctorModel->update($id, $data)) {
                return redirect()->to('/admin/doctors')->with('success', 'Dokter berhasil diupdate');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->doctorModel->errors());
            }
        }

        return view('admin/doctors/edit', [
            'title' => 'Edit Dokter',
            'doctor' => $doctor,
            'action' => site_url('/admin/doctors/edit/' . $id)
        ]);
    }

    public function delete($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        if ($this->doctorModel->delete($id)) {
            return redirect()->to('/admin/doctors')->with('success', 'Dokter berhasil dihapus');
        } else {
            return redirect()->to('/admin/doctors')->with('error', 'Gagal menghapus dokter');
        }
    }

    public function toggleStatus($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $doctor = $this->doctorModel->find($id);
        if (!$doctor) {
            return $this->errorResponse('Dokter tidak ditemukan');
        }

        $newStatus = !$doctor['is_active'];
        
        if ($this->doctorModel->update($id, ['is_active' => $newStatus])) {
            $message = $newStatus ? 'Dokter diaktifkan' : 'Dokter dinonaktifkan';
            return $this->successResponse($message);
        } else {
            return $this->errorResponse('Gagal mengubah status dokter');
        }
    }
}