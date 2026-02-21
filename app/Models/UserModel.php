<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';  // Nama tabel Anda
    protected $primaryKey = 'id';  // Primary key tabel
    protected $allowedFields = ['name', 'email', 'username', 'password', 'role', 'created_at'];  // Kolom yang dapat diubah
    protected $useTimestamps = true;

    // Method untuk mengambil pengguna berdasarkan username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();  // Mengambil data pengguna berdasarkan username
    }
}
