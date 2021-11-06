<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "app/views/layout/tabelcss.php"; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Progres</h3>
                        <a href="<?= base_url('progress/add') ?>" type="button" class="btn btn-primary btn-sm float-right" title="Tambah Data"><i class="fas fa-plus-circle"></i> &nbsp; Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Service</th>
                                    <th>Tanggal</th>
                                    <th>Location</th>
                                    <th>Percent</th>
                                    <th>Note</th>
                                    <th>Photo</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Image -->
    <div class="modal fade" id="photoProfil" tabindex="-1" role="dialog" aria-labelledby="photoProfilTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content myPhoto">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center">
                    <img src="<?= base_url('public/profil/' . user()->photo); ?>" class="img-fluid">
                    <br>
                    <span class="text-light"><?= user()->photo; ?></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</section>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?php include_once "app/views/layout/tabeljs.php"; ?>
<script>
    $(function() {
        $('#data_table').DataTable({
            dom: 'Blfrtip',
            buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                emptyTable: "Tidak ada data di dalam tabel",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data entri",
                lengthMenu: "Lihat _MENU_ entri",
                loadingRecords: "Loading data...",
                processing: "Memproses data...",
                search: "Pencarian: ",
                searchPlaceholder: "Cari kategori mobil",
            },
            "ajax": {
                "url": '<?= base_url($controller . '/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    });
</script>
<?= $this->endSection() ?>