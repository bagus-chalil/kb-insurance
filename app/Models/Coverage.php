<?php

namespace App\Models;

use CodeIgniter\Model;

class Coverage extends Model
{
    protected $table = 'coverage';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'periode_awal', 'periode_akhir', 'pertanggungan', 
        'harga_pertanggungan', 'jenis_pertanggungan', 'banjir', 'gempa'
    ];
}
