<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Daftar Pertanggungan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?= $this->include('apps/coverage/components/tabel_history') ?>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Pertanggungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label class="form-label">Nama Nasabah</label>
                        <input type="text" class="form-control" name="nama" id="edit-nama" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Periode Awal</label>
                            <input type="date" class="form-control" name="periode_awal" id="edit-periode-awal" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Periode Akhir</label>
                            <input type="date" class="form-control" name="periode_akhir" id="edit-periode-akhir" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pertanggungan</label>
                        <input type="text" class="form-control" name="pertanggungan" id="edit-pertanggungan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Pertanggungan (Rp.)</label>
                        <input type="text" class="form-control format-rupiah" name="harga_pertanggungan" id="edit-harga" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Asuransi</label>
                        <select class="form-select" name="jenis_pertanggungan" id="edit-jenis">
                            <option value="1">Comprehensive</option>
                            <option value="2">Total Loss Only</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tambahan Risiko</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="banjir" id="edit-banjir">
                            <label class="form-check-label" for="edit-banjir">Banjir</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="gempa" id="edit-gempa">
                            <label class="form-check-label" for="edit-gempa">Gempa</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
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

    // Edit data (Mengisi modal dengan data yang ada)
    $(document).on("click", ".edit", function() {
        $("#edit-id").val($(this).data("id"));
        $("#edit-nama").val($(this).data("nama"));
        $("#edit-periode-awal").val($(this).data("periode_awal"));
        $("#edit-periode-akhir").val($(this).data("periode_akhir"));
        $("#edit-pertanggungan").val($(this).data("pertanggungan"));

        // Harga format Rupiah
        let harga = new Intl.NumberFormat('id-ID').format($(this).data("harga"));
        $("#edit-harga").val(harga);

        // Set jenis pertanggungan sesuai data
        $("#edit-jenis").val($(this).data("jenis"));

        // Set nilai checkbox
        $("#edit-banjir").prop("checked", $(this).data("banjir") === "TRUE");
        $("#edit-gempa").prop("checked", $(this).data("gempa") === "TRUE");

        $("#modalEdit").modal("show");
    });

    // Simpan perubahan data
    $("#formEdit").on("submit", function(e) {
        e.preventDefault();

        let formData = $(this).serializeArray();
        let hargaInput = formData.find(i => i.name === "harga_pertanggungan");

        // Validasi harga (minimal Rp. 100.000)
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
                Swal.fire("Success!", "Data berhasil diperbarui", "success");
                $("#modalEdit").modal("hide");
                loadRiwayat();
            }
        });
    });

    // Hapus data
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
});
</script>

<?= $this->endSection() ?>
