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

        <?= $this->include('apps/coverage/components/tabel_history') ?>
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

    // Simpan data (Validasi sebelum kirim)
    $("#formPertanggungan").on("submit", function(e) {
        e.preventDefault();

        let formData = $(this).serializeArray();
        let hargaInput = formData.find(i => i.name === "harga_pertanggungan");
        
        // Validasi harga (tidak boleh kosong atau kurang dari 100.000)
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
            success: function(response) {
                Swal.fire("Success!", "Data berhasil disimpan", "success");
                loadRiwayat();
                $("#formPertanggungan")[0].reset();
                $("#id").val("");
            }
        });
    });

    // Load data riwayat
    function loadRiwayat() {
        $.get("/assurance/history", function(data) {
            let html = "";
            data.forEach(r => {
                html += `
                    <tr>
                        <td>${r.nama}</td>
                        <td>${r.pertanggungan}</td>
                        <td>Rp. ${new Intl.NumberFormat('id-ID').format(r.harga_pertanggungan)}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit"
                                data-id="${r.id}"
                                data-nama="${r.nama}"
                                data-periode_awal="${r.periode_awal}"
                                data-periode_akhir="${r.periode_akhir}"
                                data-pertanggungan="${r.pertanggungan}"
                                data-harga="${r.harga_pertanggungan}"
                                data-jenis="${r.jenis_pertanggungan}"
                                data-gempa='${r.gempa}'
                                data-banjir='${r.banjir}'
                            >Edit</button>
                            <button class="btn btn-danger btn-sm delete" data-id="${r.id}">Hapus</button>
                            <a class="btn btn-primary btn-sm" href="/assurance/premi/${r.id}" >Premi</a>
                        </td>
                    </tr>`;
            });
            $("#riwayat").html(html);
        });
    }
    loadRiwayat();

    // Hapus data dengan konfirmasi SweetAlert
    $(document).on("click", ".delete", function() {
        let id = $(this).data("id");
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data akan hilang permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/assurance/delete/" + id,
                    success: function() {
                        Swal.fire("Deleted!", "Data berhasil dihapus.", "success");
                        loadRiwayat();
                    }
                });
            }
        });
    });

    // Edit data (Mengisi semua form dengan data yang ada)
    $(document).on("click", ".edit", function() {
        $("#id").val($(this).data("id"));
        $("input[name='nama']").val($(this).data("nama"));
        $("input[name='periode_awal']").val($(this).data("periode_awal"));
        $("input[name='periode_akhir']").val($(this).data("periode_akhir"));
        $("input[name='pertanggungan']").val($(this).data("pertanggungan"));

        // Harga harus tetap format Rupiah
        let harga = new Intl.NumberFormat('id-ID').format($(this).data("harga"));
        $("input[name='harga_pertanggungan']").val(harga);

        // Set jenis pertanggungan sesuai data
        $("select[name='jenis_pertanggungan']").val($(this).data("jenis"));
        
        // Set nilai checkbox
        $("#banjir").prop("checked", $(this).data("banjir") === "TRUE");
        $("#gempa").prop("checked", $(this).data("gempa") === "TRUE");
    });

});
</script>

<?= $this->endSection() ?>
