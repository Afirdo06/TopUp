<?php

namespace App\Controllers;

use App\Models\GameModel;

class Home extends BaseController
{
    public function index()
    {
        $gameModel = new GameModel();
        $games = $gameModel->findAll(); // Mengambil semua data game dari database

        return view('landing_page', ['games' => $games]);
    }
}
