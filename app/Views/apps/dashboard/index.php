<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 col-lg-6 p-4 pt-0">
                <!-- Image -->
                <img src="<?= base_url('assets/img/illustrations/insurance.jpg') ?>" alt="Dashboard Image"
                    class="img-fluid mb-6 mb-md-0">
            </div>
            <div class="col-12 col-md-7 col-lg-6 p-4">
                <!-- Heading -->
                <h2 class="mt-2">
                    Selamat Datang di <span class="text-primary">Aplikasi KB Insurance</span>
                </h2>
                <!-- Text -->
                <p class="fs-lg text-gray-700 mb-6">
                    <b>PT KB Insurance</b> adalah perusahaan yang bergerak di bidang asuransi umum (general insurance).
                    Untuk mendapatkan profit/keuntungan, PT KB Insurance perlu menawarkan perlindungan terhadap
                    kerugian yang mungkin dialami oleh nasabah/tertanggung.
                </p>
                <p class="fs-lg text-gray-700 mb-6">
                    Aplikasi ini dibuat untuk membantu <b>Agent/Marketing</b> dalam menawarkan perlindungan kepada calon
                    nasabah dengan mengisi formulir pertanggungan, menghitung premi berdasarkan risiko, serta
                    mencatat semua penawaran yang telah dibuat. Dengan fitur ini, proses pemasaran dan pengelolaan
                    polis menjadi lebih efisien.
                </p>

                <!-- Stats -->
                <div class="d-flex">
                    <div class="pe-5">
                        <h3 class="mb-0">
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="100" data-aos=""
                                data-aos-id="countup:in" class="aos-init aos-animate">100</span>%
                        </h3>
                        <p class="text-gray-700 mb-0">
                            Keamanan Data
                        </p>
                    </div>
                    <div class="border-start border-gray-300"></div>
                    <div class="px-5">
                        <h3 class="mb-0">
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="24" data-aos=""
                                data-aos-id="countup:in" class="aos-init aos-animate">24</span>/
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="7" data-aos=""
                                data-aos-id="countup:in" class="aos-init aos-animate">7</span>
                        </h3>
                        <p class="text-gray-700 mb-0">
                            Layanan Dukungan
                        </p>
                    </div>
                    <div class="border-start border-gray-300"></div>
                    <div class="ps-5">
                        <h3 class="mb-0">
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="230000" data-aos=""
                                data-aos-id="countup:in" class="aos-init aos-animate">230k</span>+
                        </h3>
                        <p class="text-gray-700 mb-0">
                            Data Pertanggungan
                        </p>
                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div>
</div>

<?= $this->endSection() ?>
