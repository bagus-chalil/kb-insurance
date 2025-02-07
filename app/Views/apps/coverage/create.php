<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Form Pertanggungan</h4>
                </div>
                <div class="card-body">
                    <form id="formPertanggungan">
                        <div class="mb-3">
                            <label class="form-label">Nama Nasabah</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama nasabah" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Periode Awal</label>
                                <input type="date" class="form-control" name="periode_awal" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Periode Akhir</label>
                                <input type="date" class="form-control" name="periode_akhir" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pertanggungan</label>
                            <input type="text" class="form-control" name="pertanggungan" placeholder="Masukkan jenis pertanggungan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Pertanggungan</label>
                            <input type="number" class="form-control" name="harga_pertanggungan" placeholder="Masukkan harga pertanggungan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Asuransi</label>
                            <select class="form-select" name="jenis_pertanggungan">
                                <option value="1">Comprehensive</option>
                                <option value="2">Total Loss Only</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Tambahan Risiko</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="risiko_pertanggungan" value="banjir">
                                <label class="form-check-label">Banjir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="risiko_pertanggungan" value="gempa">
                                <label class="form-check-label">Gempa</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Hitung & Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Riwayat Pertanggungan</h4>
                </div>
                <div class="card-body">
                    <div id="riwayat" class="list-group"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#formPertanggungan").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/assurance/save",
                data: $(this).serialize(),
                success: function(response) {
                    alert("Message: Berhasil");
                    loadRiwayat();
                }
            });
        });

        function loadRiwayat() {
            $.ajax({
                url: "assurance/history",
                success: function(data) {
                    let html = "";
                    data.forEach(r => {
                        html += `<div class="list-group-item">${r.nama} - ${r.pertanggungan} - Rp. ${r.harga_pertanggungan}</div>`;
                    });
                    $("#riwayat").html(html);
                }
            });
        }

        loadRiwayat();
    });
</script>
<?= $this->endSection() ?>
