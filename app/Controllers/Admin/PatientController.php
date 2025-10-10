<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use CodeIgniter\HTTP\ResponseInterface;

class PatientController extends BaseController
{
    /**
     * @var PatientModel
     */
    protected $patientModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();
    }

    // --- READ (Index) ---
    public function index()
    {
        $redirect = $this->requireAuth();
        if ($redirect) return $redirect;

        $model = new PatientModel();

        $perPage = 10; // jumlah data per halaman
        $search = trim((string)$this->request->getGet('search'));

        //Base Query
        $query = $model->orderBy('id', 'ASC');

        if ($search !== '') {
            $query->groupStart()
                ->like('name', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }

        // Paginasi tetap aktif
        $patients = $query->paginate($perPage, 'patients');
        $pager = $model->pager;

        $data = [
            'title'    => 'Manajemen Data Pasien',
            'patients' => $patients,
            'pager'    => $pager,
            'search'   => $search
        ];

        return view('admin/patients/index', $data);
    }


    // --- CREATE (GET & POST) ---
    public function create()
    {
        $data = [
            'title' => 'Tambah Pasien Baru',
            'patient' => null, // Untuk form baru
        ];

        if ($this->request->is('post')) {
            // Validasi data menggunakan rules dari PatientModel
            if (!$this->validate($this->patientModel->getValidationRules())) {
                // Jika validasi gagal, kembalikan ke form dengan error
                return view('admin/patients/form', array_merge($data, ['validation' => $this->validator]));
            }

            // Data siap disimpan
            $saveData = $this->request->getPost();

            if ($this->patientModel->insert($saveData)) {
                session()->setFlashdata('success', 'Data pasien berhasil ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan data pasien.');
            }

            return redirect()->to(base_url('admin/patients'));
        }

        // Tampilan form (GET)
        return view('admin/patients/form', $data);
    }

    // --- UPDATE (GET & POST) ---
    public function edit(int $id)
    {
        $patient = $this->patientModel->find($id);

        if (!$patient) {
            session()->setFlashdata('error', 'Data pasien tidak ditemukan.');
            return redirect()->to(base_url('admin/patients'));
        }

        $data = [
            'title' => 'Edit Pasien: ' . $patient['name'],
            'patient' => $patient, // Data pasien untuk mengisi form
        ];

        if ($this->request->is('post')) {
            // Tentukan rules validasi. Karena tidak ada field unik selain ID, 
            // kita bisa menggunakan rules model, tetapi kita harus memastikan 
            // validasi di-handle dengan benar jika ada field unik di masa depan.
            // Untuk sementara, kita pakai rules model
            if (!$this->validate($this->patientModel->getValidationRules())) {
                return view('admin/patients/form', array_merge($data, ['validation' => $this->validator]));
            }

            // Data yang akan diupdate
            $saveData = $this->request->getPost();

            if ($this->patientModel->update($id, $saveData)) {
                session()->setFlashdata('success', 'Data pasien berhasil diperbarui.');
            } else {
                session()->setFlashdata('error', 'Tidak ada perubahan atau gagal memperbarui data.');
            }

            return redirect()->to(base_url('admin/patients'));
        }

        // Tampilan form (GET)
        return view('admin/patients/form', $data);
    }

    // --- DELETE (POST) ---
    public function delete(int $id)
    {
        $patient = $this->patientModel->find($id);

        if (!$patient) {
            session()->setFlashdata('error', 'Data pasien tidak ditemukan.');
            return redirect()->to(base_url('admin/patients'));
        }

        // Proses Penghapusan
        if ($this->patientModel->delete($id)) {
            session()->setFlashdata('success', 'Data pasien ' . $patient['name'] . ' berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data pasien.');
        }

        return redirect()->to(base_url('admin/patients'));
    }
}
