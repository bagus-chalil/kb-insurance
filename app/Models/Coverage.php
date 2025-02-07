<?php

namespace App\Models;

use CodeIgniter\Model;

class Coverage extends Model
{
    protected $table = 'coverage';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'periode_awal', 'periode_akhir', 'pertanggungan', 
        'harga_pertanggungan', 'jenis_pertanggungan', 'risiko_pertanggungan'
    ];

    public function saveAssurance($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function hitungPremi($harga, $tahun, $jenis, $risiko)
    {
        $rate_jenis = ($jenis == 1) ? 0.0015 : 0.005;
        $premi_kendaraan = $harga * $tahun * $rate_jenis;

        $rate_risiko = 0;
        if (!empty($risiko)) {
            foreach ($risiko as $r) {
                $rate_risiko += ($jenis == 1) ? 0.0005 : 0.002;
            }
        }
        $premi_risiko = $harga * $tahun * $rate_risiko;
        return $premi_kendaraan + $premi_risiko;
    }
}
