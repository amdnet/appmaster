<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
<title>Title judul</title>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"/>

<style>
    button.dt-button, div.dt-button, a.dt-button, input.dt-button {
    margin-right: 0;
    margin-bottom: 0.333em;
    padding: 0.3em 1em !important;
    border-radius: 5px !important;
    font-size: 0.83em !important}
</style>
</head>

<body>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <!-- Start Content -->
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header"><strong>Data User Login</strong></div>
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <td class="text-center">Id</td>
                                    <td>Nama</td>
                                    <td>Kontak</td>
                                    <td>Aksi</td>
                                </thead>
                                <tbody>                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->

        </div>
    </div>
</div>

    <footer class="text-center mt-5">
        <!-- konten footer -->
    </footer>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript">
    let url;
        let status = 'tambah';
        $(document).ready(function() {
            tampil_table_users();
        });

        function tambah() {
            status = 'tambah';
            $('#exampleModal').modal('show');
            $('#form-users')[0].reset();
        }

        function edit(id_user) {
            status = 'edit';
            $('#exampleModal').modal('show');
            $('#id_user').val(id_user);
            $.ajax({
                url: " echo base_url('home/edit'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: $('#form-users').serialize(),
                success: function(x) {
                    if (x.sukses == true) {
                        $('#nama_user').val(x.data.nama_user);
                        $('#alamat').val(x.data.alamat);
                    }
                }
            });
        }

        function hapus(id_user) {
            $.ajax({
                url: " echo base_url('home/hapus'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_user: id_user
                },
                success: function(x) {
                    if (x.sukses == true) {
                        tampil_table_users();
                    }
                }
            });
        }

        function proses() {
            if (status == 'tambah') {
                url = " echo base_url('crud/tambah'); ?>";
            } else if (status == 'edit') {
                url = " echo base_url('crud/update'); ?>";
            } else {
                url = " echo base_url('crud/hapus'); ?>";
            }

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: $('#datatable').serialize(),
                success: function(x) {
                    if (x.sukses == true) {
                        $('#exampleModal').modal('hide');
                        tampil_table_users();
                    }
                }
            });
        }

        function tampil_table_users() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                responsive: true,
                ajax: {
                    url: "<?= base_url('crud/dt_users') ?>",
                    type: "POST",
                    data: {},
                },
                columnDefs: [{
                        targets: [0, -1],
                        orderable: false,
                    },
                    {
                        width: "1%",
                        targets: [0, -1],
                    },
                    {
                        className: "dt-nowrap",
                        targets: [-1],
                    }
                ],

            });
        }
</script>

</body>
</html>