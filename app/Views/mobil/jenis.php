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
                        <h3 class="card-title">Data Kategori Jenis Mobil</h3>
                        <button type="button" class="btn btn-primary btn-sm float-right" onclick="add()" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah Data</button>
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Mobil</th>
                                    <th>User Update</th>
                                    <th>Time Created</th>
                                    <th>Time Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Start add modal content -->
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="text-center bg-dark p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Tambah Jenis Mobil</h5>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <i class="text-muted fas fa-car fa-7x"></i>
                </div>
                <form id="add-form" class="pl-2 pr-2">
                    <div class="row">
                        <input type="hidden" id="idMobil" name="idMobil" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="jenisMobil"> Mobil: </label>
                            <input type="text" id="jenisMobil" name="jenisMobil" class="form-control" placeholder="Jenis Mobil" required>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="add-form-btn">Simpan</button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End add modal content -->

<!-- Start edit modal content -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="text-center bg-dark p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Tambah Jenis Mobil</h5>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <i class="text-muted fas fa-car fa-7x"></i>
                </div>
                <form id="edit-form" class="pl-2 pr-2">
                    <div class="row">
                        <input type="hidden" id="idMobil" name="idMobil" class="form-control">
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="jenisMobil"> Jenis Mobil: </label>
                            <input type="text" id="jenisMobil" name="jenisMobil" class="form-control" placeholder="Jenis Mobil" required>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="edit-form-btn">Update</button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End update modal content -->

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

    function add() {
        // reset the form 
        $("#add-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal').modal('show');
        $("#jenisMobil").focus();
        // submit the add from 
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            errorElement: 'div ',
            errorClass: 'invalid-feedback',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {

                var form = $('#add-form');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?= base_url($controller . '/add') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                    },
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
                                $('#add-modal').modal('hide');
                            })

                        } else {

                            if (response.messages instanceof Object) {
                                $.each(response.messages, function(index, value) {
                                    var id = $("#" + index);

                                    id.closest('.form-control')
                                        .removeClass('is-invalid')
                                        .removeClass('is-valid')
                                        .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                                    id.after(value);

                                });
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
                        $('#add-form-btn').html('Add');
                    }
                });
                return false;
            }
        });
        $('#add-form').validate();
    }

    function edit(id_mobil_jenis) {
        $.ajax({
            url: '<?= base_url($controller . '/getOne') ?>',
            type: 'post',
            data: {
                id_mobil_jenis: id_mobil_jenis
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #idMobil").val(response.id_mobil_jenis);
                $("#edit-form #jenisMobil").val(response.nama_mobil_jenis);
                // $("#edit-form #fullname").val(response.fullname);
                // $("#edit-form #updateAt").val(response.update_at);

                // submit the edit from 
                $.validator.setDefaults({
                    highlight: function(element) {
                        $(element).addClass('is-invalid').removeClass('is-valid');
                    },
                    unhighlight: function(element) {
                        $(element).removeClass('is-invalid').addClass('is-valid');
                    },
                    errorElement: 'div ',
                    errorClass: 'invalid-feedback',
                    errorPlacement: function(error, element) {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else if (element.hasClass('selectpicker')) {
                            error.insertAfter(element.next());
                        } else {
                            error.insertAfter(element);
                        }
                    },

                    submitHandler: function(form) {
                        var form = $('#edit-form');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?= base_url($controller . '/edit') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                            },
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
                                        $('#edit-modal').modal('hide');
                                    })

                                } else {

                                    if (response.messages instanceof Object) {
                                        $.each(response.messages, function(index, value) {
                                            var id = $("#" + index);

                                            id.closest('.form-control')
                                                .removeClass('is-invalid')
                                                .removeClass('is-valid')
                                                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                                            id.after(value);

                                        });
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
                                $('#edit-form-btn').html('Update');
                            }
                        });
                        return false;
                    }
                });
                $('#edit-form').validate();
            }
        });
    }

    function remove(id_mobil_jenis) {
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
                        id_mobil_jenis: id_mobil_jenis
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