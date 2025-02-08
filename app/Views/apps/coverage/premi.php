<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Printout Pertanggungan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="bg-light min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow print-area position-relative" style="width: 21cm; height: 29.7cm; padding: 2cm; background-color: white; overflow: hidden;">
        
        <!-- Header Perusahaan -->
        <div class="text-center mb-4">
            <img src="/assets/img/logo/KB_Insurance_logo.png" alt="Logo Perusahaan" style="max-width: 75%;">
            <p class="mt-2">Sahid Sudirman Centre, Jl. Jenderal Sudirman, Jakarta, Indonesia</p>
        </div>

        <!-- Tombol Print dan Back (Tidak Akan Tercetak) -->
        <div class="d-print-none d-flex justify-content-between mb-3">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
            <a href="/assurance/list" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <!-- General Information -->
            <h5><strong>General Information</strong></h5>
            <hr>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td style="width: 40%"><strong>Nama Tertanggung</strong></td>
                        <td style="width: 20px">:</td>
                        <td><?= $data['nama'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Periode Pertanggungan</strong></td>
                        <td>:</td>
                        <td><?= date('d/m/Y', strtotime($data['periode_awal'])) ?> - <?= date('d/m/Y', strtotime($data['periode_akhir'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pertanggungan/Kendaraan</strong></td>
                        <td>:</td>
                        <td><?= $data['pertanggungan'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Harga Pertanggungan</strong></td>
                        <td>:</td>
                        <td>Rp. <?= number_format($data['harga_pertanggungan'], 2, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Coverage Information -->
            <h5 class="mt-4"><strong>Coverage Information</strong></h5>
            <hr>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td style="width: 40%"><strong>Jenis Asuransi</strong></td>
                        <td style="width: 20px">:</td>
                        <td><?= ($data['jenis_pertanggungan'] == 1) ? 'Comprehensive' : 'Total Loss Only' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Risiko Pertanggungan</strong></td>
                        <td>:</td>
                        <td>
                            <?php
                                $risiko = [];
                                if ($data['banjir'] === 'TRUE') {
                                    $risiko[] = 'Banjir';
                                }
                                if ($data['gempa'] === 'TRUE') {
                                    $risiko[] = 'Gempa';
                                }
                                echo !empty($risiko) ? implode(', ', $risiko) : '-';
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Premium Calculation -->
            <h5 class="mt-4"><strong>Premium Calculation</strong></h5>
            <hr>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td style="width: 40%"><strong>Jumlah Tahun Pertanggungan</strong></td>
                        <td style="width: 20px">:</td>
                        <td><?= $coverage_periode ?> Tahun</td>
                    </tr>
                    <tr>
                        <td><strong>Premi Kendaraan</strong></td>
                        <td>:</td>
                        <td>Rp. <?= number_format($vehicle_premi, 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Banjir</strong></td>
                        <td>:</td>
                        <td>Rp. <?= number_format($banjir, 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Gempa</strong></td>
                        <td>:</td>
                        <td>Rp. <?= number_format($gempa, 2, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Premi</strong></td>
                        <td>:</td>
                        <td><span class="text-danger">Rp. <?= number_format($total_premi, 2, ',', '.') ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<style>
    /* Background abu-abu seperti MS Word */
    .bg-light {
        background-color: #f0f0f0 !important;
    }

    /* Simulasi halaman A4 dengan shadow */
    .print-area {
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        overflow: hidden; /* Hindari konten keluar */
    }

    /* Pastikan tombol print dan back tidak ikut tercetak */
    @media print {
        @page {
            size: A4; 
            margin: 0; /* Hilangkan margin bawaan untuk menghindari halaman kosong */
        }
        body {
            background: white;
        }
        .d-print-none {
            display: none !important; /* Sembunyikan tombol saat print */
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 21cm;
            height: 29.7cm;
            page-break-after: avoid; /* Mencegah halaman kosong */
        }
        /* Hilangkan footer */
        footer {
            display: none !important;
        }
    }

    /* Table styling */
    .table-borderless td {
        padding: 5px 0;
        vertical-align: top;
    }
</style>
<?= $this->endSection() ?>
