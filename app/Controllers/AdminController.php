<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GameModel;
use App\Models\PackageModel;
use App\Models\TransactionModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        // Mengecek apakah pengguna sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');  // Redirect ke halaman login jika belum login
        }
    }
    // Method untuk menampilkan dashboard admin
    public function dashboard()
    {
        $packageModel = new PackageModel();
        $gameModel = new GameModel();
        $transactionModel = new TransactionModel();

        // Ambil semua paket
        $packages = $packageModel->asArray()->findAll(); // Pastikan data paket dikembalikan sebagai array

        // Tambahkan nama game ke setiap paket
        foreach ($packages as &$package) {
            $game = $gameModel->asArray()->find($package['game_id']); // Pastikan game dikembalikan sebagai array
            $package['game_name'] = $game['name'] ?? 'Game Tidak Ditemukan'; // Tambahkan fallback jika game tidak ditemukan
        }

        // Ambil semua game
        $games = $gameModel->asArray()->findAll(); // Pastikan games dikembalikan sebagai array

        // Ambil semua transaksi
        $transactions = $transactionModel->asArray()->findAll(); // Pastikan transactions dikembalikan sebagai array

        // Kirim data ke view
        return view('admin/dashboard', [
            'games' => $games,
            'packages' => $packages,
            'transactions' => $transactions,
        ]);
    }

    // Method untuk logout
    public function logout()
    {
        // Hapus sesi pengguna
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/login');
    }

    // Method untuk menampilkan daftar game
    public function manageGames()
    {
        $session = session();

        // Cek apakah user sudah login dan memiliki role admin
        if (!$session->get('isLoggedIn') || $session->get('role') != 'admin') {
            return redirect()->to('/admin/login');
        }

        $gameModel = new GameModel();
        $games = $gameModel->findAll();

        return view('admin/manage_games', ['games' => $games]);
    }

    public function addGame()
    {
        return view('admin/games/add');
    }

    // Method untuk menyimpan game baru ke database
    public function saveGame()
    {
        $gameModel = new GameModel();

        $name = $this->request->getPost('name');
        $image = $this->request->getFile('image');

        if (!$name || !$image->isValid()) {
            session()->setFlashdata('error', 'Please fill in all fields correctly.');
            return redirect()->to('/admin/games/add');
        }

        $imageName = $image->getName();
        $image->move(ROOTPATH . 'public/uploads');

        $data = [
            'name' => $name,
            'image' => $imageName,
        ];

        if ($gameModel->save($data)) {
            return redirect()->to('/admin/manage_games');
        } else {
            session()->setFlashdata('error', 'Failed to save game.');
            return redirect()->to('/admin/games/add');
        }
    }
    // Method untuk menampilkan form edit game
    public function editGame($id)
    {
        $gameModel = new GameModel();
        $game = $gameModel->find($id);  // Mencari game berdasarkan ID

        // Pastikan game ditemukan, jika tidak redirect
        if (!$game) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Game not found');
        }

        return view('admin/games/edit', ['game' => $game]);
    }

    // Method untuk update game
    public function updateGame($id)
    {
        $gameModel = new GameModel();

        // Cek jika file gambar di-upload
        $image = $this->request->getFile('image');
        
        // Jika ada gambar baru
        if ($image && $image->isValid()) {
            // Pindahkan gambar ke folder uploads
            $image->move(ROOTPATH . 'public/uploads'); 
            $imageName = $image->getName();
        } else {
            // Jika tidak ada gambar baru, gunakan nama gambar lama
            $game = $gameModel->find($id);
            $imageName = $game['image'];
        }

        // Update data game
        $gameModel->update($id, [
            'name' => $this->request->getPost('name'),
            'image' => $imageName
        ]);

        // Redirect ke halaman manage games setelah data disimpan
        return redirect()->to('/admin/manage_games');
    }

    // Method untuk menghapus game
    public function deleteGame($id)
    {
        $gameModel = new GameModel();
        $game = $gameModel->find($id);
    
        if ($game) {
            // Jika ingin menghapus file gambar terkait
            $imagePath = ROOTPATH . 'public/uploads/' . $game['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // Hapus game dari database
            $gameModel->delete($id);
        }
    
        // Redirect kembali ke halaman manage games setelah penghapusan
        return redirect()->to('/admin/manage_games');
    }
    
    // Method untuk menampilkan daftar paket
    public function managePackages($game_id = null)
    {
        $session = session();

        // Cek apakah user sudah login dan memiliki role admin
        if (!$session->get('isLoggedIn') || $session->get('role') != 'admin') {
            return redirect()->to('/admin/login');
        }

        // Jika $game_id tidak diberikan, tampilkan daftar game
        if (is_null($game_id)) {
            // Ambil data game
            $gameModel = new GameModel();
            $games = $gameModel->findAll(); // Ambil semua game

            return view('admin/manage_packages', [
                'games' => $games
            ]);
        }

        // Jika $game_id diberikan, tampilkan paket harga untuk game tersebut
        $gameModel = new GameModel();
        $game = $gameModel->find($game_id);

        if (!$game) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Game dengan ID $game_id tidak ditemukan");
        }

        // Ambil paket harga untuk game tersebut
        $packageModel = new PackageModel();
        $packages = $packageModel->where('game_id', $game_id)->findAll();

        return view('admin/manage_packages', [
            'game' => $game,
            'packages' => $packages
        ]);
    }

    public function manageItems($game_id)
    {
        $gameModel = new GameModel();
        $packageModel = new PackageModel();

        // Ambil data game berdasarkan ID
        $game = $gameModel->find($game_id);

        if (!$game) {
            return redirect()->to('/admin/manage_packages')->with('error', 'Game tidak ditemukan.');
        }

        // Ambil paket-paket untuk game yang sesuai
        $packages = $packageModel->where('game_id', $game_id)->findAll();

        return view('admin/packages/manage_items', [
            'game' => $game,
            'packages' => $packages,
        ]);
    }

    public function addPackage($game_id)
    {
        // Ambil data game berdasarkan ID
        $gameModel = new \App\Models\GameModel();
        $game = $gameModel->find($game_id);
    
        // Jika game tidak ditemukan, redirect dengan pesan error
        if (!$game) {
            return redirect()->to('/admin/manage_packages')->with('error', 'Game tidak ditemukan');
        }
    
        // Menampilkan form tambah paket dengan data game
        return view('admin/packages/add_package', [
            'game' => $game
        ]);
    }
    

public function savePackage()
{
    $validation =  \Config\Services::validation();

    // Validasi inputan
    if (!$this->validate([
        'package_name' => 'required',
        'price' => 'required|numeric',
        'currency_type' => 'required',
        'game_id' => 'required|numeric'
    ])) {
        return redirect()->back()->withInput()->with('error', 'Tolong isi semua data dengan benar.');
    }

    // Ambil data dari form
    $data = [
        'package_name' => $this->request->getPost('package_name'),
        'price' => $this->request->getPost('price'),
        'currency_type' => $this->request->getPost('currency_type'),
        'game_id' => $this->request->getPost('game_id')
    ];

    // Simpan data ke database
    $packageModel = new \App\Models\PackageModel();
    $packageModel->save($data);

    // Mendapatkan game_id dari data yang baru ditambahkan
    $game_id = $data['game_id'];

    // Mengarahkan kembali ke halaman manage_items dengan ID game yang sesuai
    return redirect()->to('/admin/packages/manage_items/' . $game_id)
                     ->with('success', 'Paket berhasil ditambahkan.');
}

public function editPackage($id)
{
    $packageModel = new PackageModel();
    $package = $packageModel->find($id);

    // Pastikan package ditemukan
    if (!$package) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
    }

    // Ambil ID game untuk mengarahkan kembali ke halaman manage_items nanti
    $game_id = $package['game_id'];

    // Mengirim data package dan game_id ke view
    return view('admin/packages/edit_package', [
        'package' => $package,
        'game_id' => $game_id
    ]);
}

public function updatePackage($id)
{
    $packageModel = new PackageModel();

    // Ambil data paket berdasarkan ID
    $package = $packageModel->find($id);
    if (!$package) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Paket tidak ditemukan');
    }

    // Ambil data dari form
    $data = [
        'package_name' => $this->request->getPost('package_name'),
        'price' => $this->request->getPost('price'),
        'currency_type' => $this->request->getPost('currency_type'),
    ];

    // Validasi data
    if (!$this->validate([
        'package_name' => 'required|min_length[3]|max_length[100]',
        'price' => 'required|numeric',
        'currency_type' => 'required|in_list[IDR,USD]',
    ])) {
        return redirect()->back()->withInput()->with('error', 'Data tidak valid');
    }

    // Update data paket ke database
    $packageModel->update($id, $data);

    // Mengambil game_id untuk mengarahkan ke halaman manage_items yang sesuai
    $game_id = $package['game_id'];

    // Redirect ke halaman manage_items setelah update
    return redirect()->to('/admin/packages/manage_items/' . $game_id)
                     ->with('success', 'Paket berhasil diperbarui');
}

public function delete($id)
{
    $packageModel = new PackageModel();

    // Ambil data paket sebelum dihapus
    $package = $packageModel->find($id);
    
    if (!$package) {
        return redirect()->back()->with('error', 'Paket tidak ditemukan.');
    }

    // Hapus paket
    if ($packageModel->delete($id)) {
        // Mengarahkan kembali ke halaman manage_items dengan ID game yang sesuai
        return redirect()->to('/admin/packages/manage_items/' . $package['game_id'])->with('success', 'Paket berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus paket.');
    }
}












}
