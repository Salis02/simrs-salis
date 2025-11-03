<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    /**
     * @var UserModel
     */
    protected $userModel;
    protected $currentUserId;

    public function __construct()
    {
        // Load model di constructor
        $this->userModel = new UserModel();

        // Ambil ID pengguna yang sedang login
        $this->currentUserId = session()->get('user_id');
    }

    // --- READ (Index) ---
    public function index()
    {
        $data = [
            'title' => 'Manajemen Administrator',
            'users' => $this->userModel->orderBy('id', 'ASC')->findAll(),
        ];

        // Memuat view dengan data administrator
        return view('admin/users/index', $data);
    }

    // --- CREATE (GET & POST) ---
    public function create()
    {
        $data = [
            'title' => 'Tambah Administrator Baru',
            'user' => null, // Untuk form baru
        ];

        if ($this->request->is('post')) {
            // Tentukan rules validasi khusus untuk CREATE (password wajib)
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'full_name' => 'required|min_length[3]|max_length[100]',
                'password' => 'required|min_length[6]',
                'pass_confirm' => 'required_with[password]|matches[password]',
            ];

            if (!$this->validate($rules)) {
                // Jika validasi gagal, kembalikan ke form dengan error
                return view('admin/users/form', array_merge($data, ['validation' => $this->validator]));
            }

            // Data siap disimpan
            $saveData = [
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
                'password' => $this->request->getPost('password'),
                'role' => 'admin', // Set role secara default
            ];

            // 🌟 PERBAIKAN: Panggil metode insert()
            $this->userModel->insert($saveData);

            session()->setFlashdata('success', 'Administrator baru berhasil ditambahkan!');

            return redirect()->to(base_url('admin/users'));
        }

        // Tampilan form (GET)
        return view('admin/users/form', $data);
    }

    // --- UPDATE (GET & POST) ---
    public function edit(int $id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'Administrator tidak ditemukan.');
            return redirect()->to(base_url('admin/users'));
        }

        $data = [
            'title' => 'Edit Administrator: ' . $user['full_name'],
            'user' => $user, // Data pengguna untuk mengisi form
        ];

        if ($this->request->is('post')) {
            // Tentukan rules validasi untuk EDIT
            $rules = [
                'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
                'full_name' => 'required|min_length[3]|max_length[100]',
                'password' => 'permit_empty|min_length[6]',
                'pass_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                return view('admin/users/form', array_merge($data, ['validation' => $this->validator]));
            }

            // Data yang akan diupdate
            $saveData = [
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
            ];

            // Hanya update password jika field password diisi
            $newPassword = $this->request->getPost('password');
            if (!empty($newPassword)) {
                $saveData['password'] = $newPassword;
                // Model Callback (hashPassword) akan otomatis dijalankan di beforeUpdate
            }

            // dd($saveData);
            // 🌟 PERBAIKAN: Panggil metode update()
            $this->userModel->update($id, $saveData);

            session()->setFlashdata('success', 'Administrator ' . $saveData['full_name'] . ' berhasil diperbarui!');

            return redirect()->to(base_url('admin/users'));
        }

        // Tampilan form (GET)
        return view('admin/users/form', $data);
    }
    // --- DELETE (POST) ---
    public function delete(int $id)
    {
        // Ambil ID pengguna yang sedang login dan pastikan tipe datanya INTEGER
        $currentUserIdInt = (int) $this->currentUserId;

        // 1. Pengecekan Keamanan: Mencegah admin menghapus akunnya sendiri
        // Gunakan operator perbandingan ketat (===) atau pastikan tipenya sama.
        if ($id === $currentUserIdInt) {
            session()->setFlashdata('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return redirect()->to(base_url('admin/users'));
        }

        // 2. Cek apakah user ada
        $user = $this->userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Administrator tidak ditemukan.');
            return redirect()->to(base_url('admin/users'));
        }

        // 3. Proses Penghapusan
        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Administrator ' . $user['full_name'] . ' berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus administrator.');
        }

        return redirect()->to(base_url('admin/users'));
    }
}
