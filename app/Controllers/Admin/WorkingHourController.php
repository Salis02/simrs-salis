<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WorkingHourModel;
use App\Models\DoctorModel;

class WorkingHourController extends BaseController
{
    protected $workingHourModel;
    protected $doctorModel;

    public function __construct()
    {
        $this->workingHourModel = new WorkingHourModel();
        $this->doctorModel = new DoctorModel();
    }

    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $model = new WorkingHourModel();

        $perPage = 10;

        $workingHours = $model->select(
            'working_hours.*, doctors.name as doctor_name, doctors.specialization'
        )
            ->join('doctors', 'working_hours.doctor_id = doctors.id')
            ->orderBy('working_hours.date', 'DESC')
            ->paginate($perPage, 'working_hours');   // group name opsional

        $pager = $model->pager; // instance pager untuk view
        $data = [
            'title' => 'Jadwal Dokter',
            'working_hours' => $workingHours,
            'pager' => $pager
        ];

        return view('admin/working_hours/index', $data);
    }

    public function create()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();

            if ($this->workingHourModel->insert($data)) {
                return redirect()->to('/admin/working-hours')->with('success', 'Jadwal dokter berhasil ditambahkan');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->workingHourModel->errors());
            }
        }

        $data = [
            'title' => 'Tambah Jadwal Dokter',
            'doctors' => $this->doctorModel->getActiveDoctors(),
            'working_hour' => null,
            'action' => '/admin/working-hours/create'
        ];

        return view('admin/working_hours/create', $data);
    }

    public function edit($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $workingHour = $this->workingHourModel->find($id);
        if (!$workingHour) {
            return redirect()->to('/admin/working-hours')->with('error', 'Jadwal tidak ditemukan');
        }

        if ($this->request->getMethod() === 'PUT') {
            $data = $this->request->getPost();

            if ($this->workingHourModel->update($id, $data)) {
                return redirect()->to('/admin/working-hours')->with('success', 'Jadwal dokter berhasil diupdate');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->workingHourModel->errors());
            }
        }

        $doctors = $this->doctorModel->getActiveDoctors();

        if (!empty($doctors) && is_object($doctors[0])) {
            $doctors = json_decode(json_encode($doctors), true);
        }


        $data = [
            'title' => 'Edit Jadwal Dokter',
            'working_hour' => $workingHour,
            'doctors' => $doctors,
            'action' => '/admin/working-hours/edit/' . $id
        ];

        return view('admin/working_hours/edit', $data);
    }

    public function delete($id)
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        if ($this->workingHourModel->delete($id)) {
            return redirect()->to('/admin/working-hours')->with('success', 'Jadwal dokter berhasil dihapus');
        } else {
            return redirect()->to('/admin/working-hours')->with('error', 'Gagal menghapus jadwal dokter');
        }
    }
}
