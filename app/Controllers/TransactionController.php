<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\GameModel;
use App\Models\PackageModel;
use CodeIgniter\Controller;

class TransactionController extends BaseController
{
    protected $transactionModel;
    protected $gameModel;
    protected $packageModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->gameModel = new GameModel();
        $this->packageModel = new PackageModel();

        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
    }

    // Halaman utama transaksi (list transaksi)
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');

        $builder->select(
            'transactions.id, 
            transactions.username_game, 
            transactions.game_user_id, 
            transactions.email, 
            transactions.payment_method, 
            transactions.created_at, 
            users.username, 
            games.name AS game_name, 
            packages.package_name AS package_name'
        );
        $builder->join('users', 'transactions.user_id = users.id', 'left');
        $builder->join('games', 'transactions.game_id = games.id', 'left');
        $builder->join('packages', 'transactions.package_id = packages.id', 'left');

        $transactions = $builder->get()->getResultArray();

        // Pastikan data transaksi diteruskan ke view
        return view('admin/transactions', ['transactions' => $transactions]);
    }

    // Form tambah transaksi
    public function create()
    {
        // Mengambil data game dan paket dari model
        $games = $this->gameModel->findAll();
        $packages = $this->packageModel->findAll();
        
        // Menampilkan halaman form transaksi
        return view('admin/transactions/create', [
            'games' => $games,
            'packages' => $packages
        ]);
    }

    // Menyimpan transaksi
    public function store()
    {
        $user_id = session()->get('user_id'); // Ambil user_id dari session
        
        // Debug: Tampilkan nilai user_id
        log_message('debug', 'User ID: ' . $user_id);

        // Validasi input
        if (!$this->validate([
            'game_id' => 'required',
            'package_id' => 'required',
            'username_game' => 'required',
            'game_user_id' => 'required',
            'email' => 'required|valid_email',
            'payment_method' => 'required|in_list[qris,dana,gopay,alfamart,indomart,bni,bri,bca]'  // Perbaiki validasi payment_method
        ])) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan pada validasi input');
        }

        // Menyimpan data transaksi
        $data = [
            'game_id' => $this->request->getPost('game_id'),
            'package_id' => $this->request->getPost('package_id'),
            'username_game' => $this->request->getPost('username_game'),
            'game_user_id' => $this->request->getPost('game_user_id'),
            'email' => $this->request->getPost('email'),
            'payment_method' => $this->request->getPost('payment_method'),
            'user_id' => $user_id // Pastikan ini sudah benar
        ];

        $transactionModel = new TransactionModel();

        if ($transactionModel->insert($data)) {
            return redirect()->to('/admin/transactions')->with('success', 'Transaksi berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi');
        }
    }

    // Form edit transaksi
    public function edit($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $builder->select(
            'transactions.*, users.username, games.name AS game_name, packages.package_name, transactions.payment_method'
        );
        $builder->join('users', 'transactions.user_id = users.id');
        $builder->join('games', 'transactions.game_id = games.id');
        $builder->join('packages', 'transactions.package_id = packages.id');
        $builder->where('transactions.id', $id);

        $transaction = $builder->get()->getRowArray();

        if (!$transaction) {
            return redirect()->to('/admin/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Fetch data games dan packages untuk dropdown
        $games = $this->gameModel->findAll();
        $packages = $this->packageModel->findAll();

        return view('admin/transactions/edit_transaction', [
            'transaction' => $transaction,
            'games' => $games,
            'packages' => $packages
        ]);
    }

    // Update transaksi
    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username_game' => 'required|max_length[100]',
            'game_user_id' => 'required|max_length[50]',
            'email' => 'required|valid_email',
            'payment_method' => 'required|in_list[qris,dana,gopay,alfamart,indomart,bni,bri,bca]'  // Pastikan validasi payment_method sesuai
        ]);
    
        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // Ambil user_id dari session
        $user_id = session()->get('user_id'); // Pastikan user_id ada di sesi
    
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $builder->where('id', $id);
        $builder->update([
            'user_id' => $user_id, // Menyimpan user_id dari session
            'username_game' => $this->request->getPost('username_game'),
            'game_user_id' => $this->request->getPost('game_user_id'),
            'email' => $this->request->getPost('email'),
            'payment_method' => $this->request->getPost('payment_method')
        ]);
    
        return redirect()->to('/admin/transactions')->with('success', 'Transaksi berhasil diperbarui.');
    }

    // Hapus transaksi
    public function delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $transaction = $builder->where('id', $id)->get()->getRowArray();

        if (!$transaction) {
            return redirect()->to('/admin/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        $builder->where('id', $id)->delete();

        return redirect()->to('/admin/transactions')->with('success', 'Transaksi berhasil dihapus.');
    }
}
