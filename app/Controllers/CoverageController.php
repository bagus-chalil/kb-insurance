<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Coverage;
use DateTime;
use Exception;

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
        try {
            $request = $this->request->getPost();

            $harga = str_replace('.', '', $request['harga_pertanggungan']);
            $harga = str_replace(',', '.', $harga); 

            $data = [
                'nama' => $request['nama'],
                'periode_awal' => date('Y-m-d', strtotime($request['periode_awal'])),
                'periode_akhir' => date('Y-m-d', strtotime($request['periode_akhir'])),
                'pertanggungan' => $request['pertanggungan'],
                'harga_pertanggungan' => floatval($harga),
                'jenis_pertanggungan' => intval($request['jenis_pertanggungan']),
                'banjir' => isset($request['banjir']) ? 'TRUE' : 'FALSE',
                'gempa' => isset($request['gempa']) ? 'TRUE' : 'FALSE'
            ];
            
            if (!empty($request['id'])) {
                $this->coverageModel->update($request['id'], $data);
            } else {
                $this->coverageModel->insert($data);
            }

            return $this->respond(['status' => 'success', 'data' => $data], 200);
        } catch (Exception $e) {
            return $this->fail('Gagal menyimpan data: ' . $e->getMessage(), 500);
        }
    }

    public function riwayat()
    {
        try {
            return $this->respond($this->coverageModel->findAll(), 200);
        } catch (Exception $e) {
            return $this->fail('Gagal mengambil data: ' . $e->getMessage(), 500);
        }
    }

    public function hapus($id)
    {
        try {
            if ($this->coverageModel->delete($id)) {
                return $this->respond(['status' => 'success', 'message' => 'Data berhasil dihapus'], 200);
            } else {
                return $this->fail('Gagal menghapus data', 500);
            }
        } catch (Exception $e) {
            return $this->fail('Gagal menghapus data: ' . $e->getMessage(), 500);
        }
    }

    public function premi($id)
    {
        try {
            $assuranceData = $this->coverageModel->where('id', $id)->first();
            
            if (!$assuranceData) {
                return redirect()->to('/assurance')->with('error', 'Data tidak ditemukan');
            }

            // Perhitungan Premi
            $startDate = new DateTime($assuranceData['periode_awal']);
            $endDate = new DateTime($assuranceData['periode_akhir']);
            $coverage_periode = $startDate->diff($endDate)->y;
            if ($coverage_periode < 1) {
                $coverage_periode = 1;
            }

            // Premi Kendaraan
            $rate_jenis = ($assuranceData['jenis_pertanggungan'] == 1) ? 0.0015 : 0.005;
            $vehicle_premi = $coverage_periode * $assuranceData['harga_pertanggungan'] * $rate_jenis;

            // Premi Risiko Pertanggungan
            $risk_premi_coverage = 0;
            if ($assuranceData['jenis_pertanggungan'] == 1) {
                if ($assuranceData['banjir'] === 'TRUE') {
                    $risk_premi_coverage += $coverage_periode * $assuranceData['harga_pertanggungan'] * 0.0005;
                }
                if ($assuranceData['gempa'] === 'TRUE') {
                    $risk_premi_coverage += $coverage_periode * $assuranceData['harga_pertanggungan'] * 0.0002;
                }
            }

            // Total Premi
            $total_premi = $vehicle_premi + $risk_premi_coverage;

            return view('apps/coverage/premi', [
                'data' => $assuranceData,
                'coverage_periode' => $coverage_periode,
                'vehicle_premi' => $vehicle_premi,
                'risk_premi_coverage' => $risk_premi_coverage,
                'total_premi' => $total_premi
            ]);
        } catch (Exception $e) {
            return redirect()->to('/assurance')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
