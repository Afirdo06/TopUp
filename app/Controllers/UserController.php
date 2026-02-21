<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\PackageModel;
use App\Models\TransactionModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        // Mengecek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');  // Redirect ke halaman login jika belum login
        }
    }
    public function topup()
    {
        // Ambil daftar game dari model
        $gameModel = new GameModel();
        $data['games'] = $gameModel->findAll(); // Ambil semua game

        // Kirim data ke view
        return view('user/topup', $data);
    }

    public function topup_game($game_id)
{
    $gameModel = new GameModel();
    $packageModel = new PackageModel();

    $game = $gameModel->find($game_id);
    $packages = $packageModel->where('game_id', $game_id)->findAll();

    // Filter paket jika diperlukan (misalnya ID 2 tidak diinginkan)
    $packages = array_filter($packages, function ($package) {
        return $package['id'] != 2; // Sesuaikan dengan kondisi yang dibutuhkan
    });

    // Ambil game_user_id jika ada di sesi atau dari data lain
    $game_user_id = session()->get('game_user_id') ?? '';

    return view('user/topup_game', [
        'game' => $game,
        'packages' => $packages,
        'game_id' => $game_id,
        'game_user_id' => $game_user_id, // Kirimkan game_user_id ke view
    ]);
}


public function topup_process()
{
    // Check if it's an AJAX request
    $isAjax = $this->request->isAJAX() || $this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';

    // Ambil data dari form
    $data = [
        'user_id' => session()->get('user_id'), // Pastikan user_id ada di session
        'game_id' => $this->request->getPost('game_id'), // Ambil game_id yang dipilih
        'package_id' => $this->request->getPost('package_id'),
        'username_game' => $this->request->getPost('username_game'),
        'game_user_id' => $this->request->getPost('game_user_id'),
        'payment_method' => $this->request->getPost('payment_method'),
        'email' => $this->request->getPost('email'),
        'created_at' => date('Y-m-d H:i:s'),
    ];

    // Validasi data input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'user_id' => 'required|integer',
        'game_id' => 'required|integer',
        'package_id' => 'required|integer',
        'username_game' => 'required|string',
        'game_user_id' => 'required|string',
        'payment_method' => 'required|string',
        'email' => 'required|valid_email',
    ]);

    if (!$validation->run($data)) {
        // Jika validasi gagal
        if ($isAjax) {
            return $this->response->setJSON(['success' => false, 'message' => 'Semua field harus diisi dengan benar.']);
        }
        session()->setFlashdata('error', 'Semua field harus diisi dengan benar.');
        return redirect()->to('/user/topup_game')->withInput()->with('validation', $validation);
    }

    // Simpan data transaksi ke database
    $transactionModel = new TransactionModel();

    if ($transactionModel->save($data)) {
        if ($isAjax) {
            return $this->response->setJSON(['success' => true, 'message' => 'Top-up berhasil!']);
        }
        session()->setFlashdata('success', 'Top-up berhasil! Silakan lanjutkan pembayaran.');
        return redirect()->to('/user/topup_game'); // Kembali ke halaman top-up
    } else {
        // Log error jika penyimpanan gagal
        log_message('error', 'Error saving transaction data: ' . print_r($data, true));

        if ($isAjax) {
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data. Coba lagi nanti.']);
        }
        session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data. Coba lagi nanti.');
        return redirect()->to('/user/topup_game')->withInput();
    }
}
public function logout()
    {
        // Hancurkan sesi pengguna
        session()->destroy();
        
        // Alihkan pengguna ke halaman login
        return redirect()->to('/login');
    }


}
