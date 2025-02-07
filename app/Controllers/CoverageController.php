<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Coverage;

class CoverageController extends ResourceController
{
    protected $coverageModel;

    public function __construct()
    {
        $this->coverageModel = new Coverage();
    }

    public function index()
    {
        return view('apps/coverage/create');
    }

    public function simpan()
    {
        $request = $this->request->getPost();

		$data = array(
			'nama' => $request['nama'],
			'periode_awal' => $request['periode_awal'],
			'periode_akhir' => $request['periode_akhir'],
			'pertanggungan' => $request['pertanggungan'],
			'harga_pertanggungan' => $request['harga_pertanggungan'],
			'jenis_pertanggungan' => $request['jenis_pertanggungan'],
			'risiko_pertanggungan' => $request['risiko_pertanggungan']
		);

		// $tahun = date('Y') - date('Y', strtotime($data['periode_awal']));
		// $risiko = $data['risiko_pertanggungan'] ?? [];
		// $risiko = array_values($risiko
		// );

        // Perbaiki pemanggilan model
        // $assurance = ;

        // $data['risiko'] = json_encode($risiko);
        // $data['total_premi'] = $premi;
		
        if ($this->coverageModel->insert($data)) {
            return $this->respond(['status' => 'success', 'data' => $data], 200);
        } else {
            return $this->fail('Gagal menyimpan data', 500);
        }
    }

    public function riwayat()
    {
        return $this->respond($this->coverageModel->findAll(), 200);
    }
}
