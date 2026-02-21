<?php

namespace App\Controllers;

use App\Models\GameModel; // Import model

class LandingPage extends BaseController
{
    public function index()
    {
        // Load model
        $gameModel = new GameModel();

        // Ambil data game dari database
        $games = $gameModel->findAll();

        // Kirim data ke view
        return view('landing_page', ['games' => $games]);
    }
}
