<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Kode Pos</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>                  
                            </tbody>
                            </table>
                        </div> <!-- card-body -->

                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ordering: true,
        dom: 'Bfrtip',
        buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],

        order: [[ 0, "desc" ]],
        ajax: {
            "url": "<?= base_url('konsumen/ajaxList') ?>",
            "type": "POST"
        },

        columnDefs: [
        { "className": "text-center", "targets": [0] }, 
        { "orderable": true, "scrollY": "200px", "scrollCollapse": true, "targets": "_all" }
        ],
    });
});
</script>
<?= $this->endSection() ?>