<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8 mt-2">
                <h3 class="card-title">Member</h3>
              </div>
              <div class="col-md-4">
                <a href="<?= base_url('users/add') ?>" class="btn btn-primary btn-sm float-right" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah Data</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="data_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
  </div>
  <!-- /.row -->
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(function() {
    $('#data_table').DataTable({
      dom: 'Blfrtip',
      buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
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