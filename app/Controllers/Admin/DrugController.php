<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DrugModel;
use CodeIgniter\HTTP\ResponseInterface;

class DrugController extends BaseController
{
    /**
     * @var DrugModel
     */
    protected $drugModel;

    public function __construct()
    {
        $this->drugModel = new DrugModel();
    }

    // --- READ (Index) ---
    public function index()
    {
        $data = [
            'title' => 'Manajemen Data Obat',
            'drugs' => $this->drugModel->orderBy('name', 'ASC')->findAll(),
        ];

        return view('admin/drugs/index', $data);
    }

    // --- CREATE (GET & POST) ---
    public function create()
    {
        $data = [
            'title' => 'Tambah Obat Baru',
            'drug' => null, 
        ];

        if ($this->request->is('post')) {
            if (!$this->validate($this->drugModel->getValidationRules())) {
                return view('admin/drugs/form', array_merge($data, ['validation' => $this->validator]));
            }

            $saveData = $this->request->getPost();

            if ($this->drugModel->insert($saveData)) {
                session()->setFlashdata('success', 'Obat baru berhasil ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan data obat.');
            }

            return redirect()->to(base_url('admin/drugs'));
        }

        return view('admin/drugs/form', $data);
    }

    // --- UPDATE (GET & POST) ---
    public function edit(int $id)
    {
        $drug = $this->drugModel->find($id);

        if (!$drug) {
            session()->setFlashdata('error', 'Obat tidak ditemukan.');
            return redirect()->to(base_url('admin/drugs'));
        }

        $data = [
            'title' => 'Edit Obat: ' . $drug['name'],
            'drug' => $drug,
        ];

        if ($this->request->is('post')) {
            // Kita perlu mengambil rules dan menyesuaikannya untuk `is_unique`
            $rules = $this->drugModel->getValidationRules();
            $rules['name'] = "required|min_length[3]|max_length[100]|is_unique[drugs.name,id,{$id}]";

            if (!$this->validate($rules)) {
                return view('admin/drugs/form', array_merge($data, ['validation' => $this->validator]));
            }

            $saveData = $this->request->getPost();
            
            if ($this->drugModel->update($id, $saveData)) {
                session()->setFlashdata('success', 'Data obat berhasil diperbarui.');
            } else {
                session()->setFlashdata('error', 'Tidak ada perubahan atau gagal memperbarui data.');
            }

            return redirect()->to(base_url('admin/drugs'));
        }

        return view('admin/drugs/form', $data);
    }

    // --- DELETE (POST) ---
    public function delete(int $id)
    {
        $drug = $this->drugModel->find($id);

        if (!$drug) {
            session()->setFlashdata('error', 'Obat tidak ditemukan.');
            return redirect()->to(base_url('admin/drugs'));
        }
        
        if ($this->drugModel->delete($id)) {
            session()->setFlashdata('success', 'Obat ' . $drug['name'] . ' berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data obat.');
        }

        return redirect()->to(base_url('admin/drugs'));
    }
}
