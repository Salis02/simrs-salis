<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($user = $this->userModel->validateLogin($username, $password)) {
                $this->session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'full_name' => $user['full_name'],
                    'role' => $user['role']
                ]);

                return redirect()->to('/admin')->with('success', 'Berhasil login');
            } else {
                return redirect()->back()->with('error', 'Username atau password salah');
            }
        }

        return view('admin/auth/login', ['title' => 'Login Admin']);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login')->with('success', 'Berhasil logout');
    }
}