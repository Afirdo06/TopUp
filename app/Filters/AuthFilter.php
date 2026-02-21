<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Memeriksa apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->to('/login');
        }

        // Jika akses hanya untuk admin
        if (is_array($arguments) && in_array('admin', $arguments)) {
            $userModel = new UserModel();
            $user = $userModel->find(session()->get('user_id'));

            // Memeriksa apakah user adalah admin
            if ($user['role'] !== 'admin') {
                // Jika bukan admin, arahkan ke halaman lain atau tampilkan pesan error
                return redirect()->to('/user');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request diproses
    }
}
