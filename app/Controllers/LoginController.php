<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    // Method untuk memproses login
    public function login_process()
    {
        $session = session();
        $model = new UserModel();
    
        // Ambil data username dan password
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
    
        // Cek apakah username dan password cocok
        $user = $model->where('username', $username)->first();
    
        // Verifikasi jika user ditemukan dan password sesuai
        if ($user && $password == $user['password']) {
            // Menyimpan data session
            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            $session->set('role', $user['role']);
            $session->set('user_id', $user['id']); // Menambahkan user_id ke session
    
            // Cek role untuk menentukan redirect
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard'); // Redirect ke dashboard admin
            } elseif ($user['role'] === 'user') {
                return redirect()->to('user/topup'); // Redirect ke halaman topup untuk user
            }
        } else {
            // Jika login gagal
            $session->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('login');
        }
    }
    
    // Method untuk logout
    public function logout()
    {
        $session = session();
        $session->destroy(); // Hapus session
        return redirect()->to('/login'); // Kembali ke halaman login
    }

    // Method untuk menampilkan form register
    public function register()
    {
        return view('register');
    }

    // Method untuk memproses register
    public function register_process()
    {
        $model = new UserModel();
        $session = session();

        // Ambil data dari form
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');

        // Validasi
        if ($password !== $confirm_password) {
            $session->setFlashdata('error', 'Password dan konfirmasi password tidak cocok');
            return redirect()->to('/register');
        }

        // Cek apakah username atau email sudah ada
        if ($model->where('username', $username)->first()) {
            $session->setFlashdata('error', 'Username sudah digunakan');
            return redirect()->to('/register');
        }

        if ($model->where('email', $email)->first()) {
            $session->setFlashdata('error', 'Email sudah digunakan');
            return redirect()->to('/register');
        }

        // Simpan data user baru
        $data = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password, // Dalam produksi, hash password
            'role' => 'user' // Default role user
        ];

        if ($model->save($data)) {
            $session->setFlashdata('success', 'Registrasi berhasil, silakan login');
            return redirect()->to('/login');
        } else {
            $session->setFlashdata('error', 'Registrasi gagal, coba lagi');
            return redirect()->to('/register');
        }
    }
}
