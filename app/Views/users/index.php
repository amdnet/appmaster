<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "app/views/layout/tabelcss.php"; ?>
<?= $this->endSection() ?>

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
                                <h3 class="card-title">List Data User Login</h3>
                            </div>
                            <div class="col-md-4">
                                <a href="<?= base_url('users/add'); ?>" class="btn btn-dark btn-sm float-right" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah User</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Telp</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?php include_once "app/views/layout/tabeljs.php"; ?>
<script>
    $(function() {
        $('#data_table').DataTable({
            dom: 'Blfrtip',
            "buttons": ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
            "order": [
                [0, "asc"]
            ],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?= base_url($controller . '/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    });

    function remove(userid) {
        swal.fire({
            title: 'Apakah Anda yakin dengan proses penghapusan?',
            text: 'Data akan dihapus secara permanen setelah konfirmasi!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: '<?= base_url($controller . '/remove') ?>',
                    type: 'post',
                    data: {
                        userid: userid
                    },
                    dataType: 'json',
                    success: function(response) {

                        if (response.success === true) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            })
                        } else {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection() ?>