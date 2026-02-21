<?php

namespace App\Controllers;

use App\Models\GameModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $gameModel = new GameModel();
        $data['games'] = $gameModel->findAll(); // Mendapatkan semua data game dari database
        
        return view('dashboard', $data);  // Memanggil view dashboard
    }
}
