<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'game_id', 'package_id', 'username_game', 'game_user_id', 'email', 'payment_method', 'created_at'];

    // Mengambil data transaksi dengan join game dan paket
    public function getTransactions()
    {
        return $this->db->table('transactions')
            ->select('transactions.*, games.name as game_name, packages.package_name')
            ->join('games', 'games.id = transactions.game_id')
            ->join('packages', 'packages.id = transactions.package_id')
            ->get()->getResultArray();
    }
}
