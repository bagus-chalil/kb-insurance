<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Form Pertanggungan
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
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="form-label">Nama Nasabah</label>
                            <input type="text" class="form-control" name="nama" required>
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
                            <input type="text" class="form-control" name="pertanggungan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Pertanggungan (Rp.)</label>
                            <input type="text" class="form-control format-rupiah" name="harga_pertanggungan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Asuransi</label>
                            <select class="form-select" name="jenis_pertanggungan">
                                <option value="1">Comprehensive</option>
                                <option value="2">Total Loss Only</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tambahan Risiko</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="banjir" id="banjir">
                                <label class="form-check-label" for="banjir">Banjir</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="gempa" id="gempa">
                                <label class="form-check-label" for="gempa">Gempa</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script type="text/javascript">
$(document).ready(function() {
    // Format harga ke Rupiah
    $(".format-rupiah").on("input", function() {
        let value = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(new Intl.NumberFormat('id-ID').format(value));
    });

    // Simpan data
    $("#formPertanggungan").on("submit", function(e) {
        e.preventDefault();

        let formData = $(this).serializeArray();
        let hargaInput = formData.find(i => i.name === "harga_pertanggungan");
        
        let hargaAsli = hargaInput.value.replace(/\./g, '').replace(',', '.');
        if (!hargaAsli || parseFloat(hargaAsli) < 100000) {
            Swal.fire("Error!", "Harga pertanggungan minimal Rp. 100.000!", "error");
            return;
        }

        hargaInput.value = hargaAsli;

        $.ajax({
            type: "POST",
            url: "/assurance/save",
            data: $.param(formData),
            headers: {
                "X-CSRF-TOKEN": csrfToken
            },
            success: function(response) {
                Swal.fire("Success!", "Data berhasil disimpan", "success");
                $("#formPertanggungan")[0].reset();
                $("#id").val("");
                getCsrfToken();
            }
        });
    });

});
</script>

<?= $this->endSection() ?>
