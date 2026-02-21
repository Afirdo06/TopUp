<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table = 'games'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'image']; // Kolom yang dapat diisi
    protected $returnType = 'array';
    public function getGame($gameId)
    {
        return $this->find($gameId);
    }
}
