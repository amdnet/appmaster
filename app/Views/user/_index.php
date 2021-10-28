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
                                <h3 class="card-title">List Data User Login</h3>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-sm float-right" onclick="add()" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah User</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Images</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Created</th>
                                    <th>Updated</th>
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

<!-- Add modal content -->
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center bg-dark p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Add New User Account</h5>
            </div>

            <div class="modal-body">
                <form id="add-form" class="pl-2 pr-2">
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" required>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="role"> User Role: </label>
                            <select id="role" name="role" class="custom-select">
                                <option value="" selected disabled required>Pilih Role</option>
                                <?php foreach ($role as $rule) : ?>
                                    <option value="<?= $rule->id ?>"> <?= $rule->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="username"> Username: <span class="text-danger">*</span> </label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="30" required>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="email"> Email: <span class="text-danger">*</span> </label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="password_hash"> Password: <span class="text-danger">*</span> </label>
                                <input type="password" id="password_hash" name="password_hash" class="form-control" placeholder="Input Password">
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="pass_confirm"> Password confirm: <span class="text-danger">*</span> </label>
                                <input type="password" name="pass_confirm" class="form-control" placeholder="Konfirmasi Password">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="add-form-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit modal content -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center bg-dark p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Edit User Login</h5>
            </div>

            <div class="modal-body">
                <form id="edit-form" class="pl-2 pr-2">
                    <div class="row">
                        <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="11" required>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="images"> User Role: </label>
                            <select id="images" name="images" class="custom-select">
                                <option value="select1">Admin</option>
                                <option value="select2">Asuransi</option>
                                <option value="select3">Member</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="username"> Username: <span class="text-danger">*</span> </label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="30" required>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="email"> Email: <span class="text-danger">*</span> </label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email" maxlength="30" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="password_hash"> Password: <span class="text-danger">*</span> </label>
                                <input type="password" id="password_hash" name="password_hash" class="form-control" placeholder="Password" maxlength="30" required>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="password_confirm"> Password confirm: <span class="text-danger">*</span> </label>
                                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Konfirmasi Password" maxlength="30" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="edit-form-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
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
            "autoWidth": true,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url($controller . '/getAll') ?>',
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
                    // } else if ($(element).is('.select')) {
                    //     element.next().after(error);
                    // } else if (element.hasClass('select2')) {
                    //     error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {

                var form = $('#add-form');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url($controller . '/add') ?>',
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

    function edit(id) {
        $.ajax({
            url: '<?php echo base_url($controller . '/getOne') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #id").val(response.id);
                $("#edit-form #images").val(response.images);
                $("#edit-form #username").val(response.username);
                $("#edit-form #email").val(response.email);
                // $("#edit-form #passwordHash").val(response.password_hash);

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

                        } else {
                            error.insertAfter(element);
                        }
                    },

                    submitHandler: function(form) {
                        var form = $('#edit-form');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url($controller . '/edit') ?>',
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

    function remove(id) {
        Swal.fire({
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
                    url: '<?php echo base_url($controller . '/remove') ?>',
                    type: 'post',
                    data: {
                        id: id
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