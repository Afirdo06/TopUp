<?php

namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model
{
    protected $table = 'packages';  // Tabel yang digunakan
    protected $primaryKey = 'id';   // Primary key
    protected $allowedFields = ['game_id', 'package_name', 'price', 'currency_type']; // Kolom yang diizinkan
    protected $returnType = 'array'; 
    
}




