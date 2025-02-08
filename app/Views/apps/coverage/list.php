<?= $this->extend('layouts/main-layout') ?>

<?= $this->section('title') ?>
Form Pertanggungan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?= $this->include('apps/coverage/components/tabel_history') ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script type="text/javascript">
$(document).ready(function() {
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
