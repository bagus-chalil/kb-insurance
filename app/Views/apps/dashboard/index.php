<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Form Pertanggungan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
        <div class="row align-items-center">
            <div class="col-12 col-md-5 col-lg-6 p-4 pt-0">
                <!-- Image -->
                <img src="{{ asset('assets/images/backgrounds/img-cover.png') }}" alt="..."
                        class="img-fluid mb-6 mb-md-0">
            </div>
            <div class="col-12 col-md-7 col-lg-6 p-4">
                <!-- Heading -->
                <h2 class="mt-2">
                    Efficient <span class="text-primary">Survey Management</span> for Optimal Insights
                </h2>
                <!-- Text -->
                <p class="fs-lg text-gray-700 mb-6">
                    <b>Aplikasi i-Survey</b> adalah solusi terintegrasi yang dirancang khusus untuk memantau dan
                    mengelola
                    kegiatan survei di PT Kimia Farma. Aplikasi ini memberikan kemampuan untuk merancang,
                    melaksanakan, dan menganalisis data survei secara menyeluruh, mulai dari perencanaan hingga
                    pelaporan, guna memastikan hasil survei yang akurat dan relevan.
                </p>
                <p class="fs-lg text-gray-700 mb-6">
                    Dengan aplikasi ini, perusahaan dapat mengoptimalkan proses survei melalui pemantauan real-time,
                    perencanaan yang lebih efisien, serta pengelolaan data survei secara terintegrasi. Hal ini
                    mendukung pengambilan keputusan yang lebih tepat, efisiensi operasional, dan penghematan sumber
                    daya.
                </p>
                <!-- Stats -->
                <div class="d-flex">
                    <div class="pe-5">
                        <h3 class="mb-0">
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="100" data-aos=""
                                    data-aos-id="countup:in" class="aos-init aos-animate">100</span>%
                        </h3>
                        <p class="text-gray-700 mb-0">
                            Keamanan
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
                            Dukungan
                        </p>
                    </div>
                    <div class="border-start border-gray-300"></div>
                    <div class="ps-5">
                        <h3 class="mb-0">
                            <span data-countup="{&quot;startVal&quot;: 0}" data-to="100" data-aos=""
                                    data-aos-id="countup:in" class="aos-init aos-animate">230k</span>+
                        </h3>
                        <p class="text-gray-700 mb-0">
                            Data Realtime
                        </p>
                    </div>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>
</div>

<?= $this->endSection() ?>
