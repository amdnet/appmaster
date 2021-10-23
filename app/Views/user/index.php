<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Data User Login</h3>
                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="add()" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah User</button>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>User Name</th>
                                        <th>Role</th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= $user->userid; ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td><?= $user->username; ?></td>
                                    <td> </td>
                                    <td><?= $user->created_at; ?></td>
                                    <td><?= $user->updated_at; ?></td>
                                    <td><a class="btn btn-primary btn-sm" href="<?= base_url('detail/'. $user->userid); ?>"><i class="fas fa-eye"></i></a> <a class="btn btn-success btn-sm" href="<?= base_url('edit/'. $user->userid); ?>"><i class="fas fa-pencil-alt"></i></a> <a class="btn btn-danger btn-sm" href="<?= base_url('hapus/'. $user->userid); ?>"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div> <!-- card-body -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </section>

    <!-- tambah user login modal -->
    <div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User Login</h5>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <form id="add-form" action="<?= base_url('auth/proses'); ?>" method="post">
                                        
                            <span class="text-danger"><?= isset($validation) ? tampil_error($validation, 'nama') : '' ?></span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                </div>
                                <input type="text" class="form-control" name="nama" placeholder="input nama" value="<?= set_value('nama'); ?>">
                            </div>

                            <span class="text-danger"><?= isset($validation) ? tampil_error($validation, 'email') : '' ?></span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                </div>
                                <input type="text" class="form-control" name="email" placeholder="input email (user login)" value="<?= set_value('email'); ?>">
                            </div>

                            <span class="text-danger"><?= isset($validation) ? tampil_error($validation, 'password') : '' ?></span>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="input password" value="<?= set_value('password'); ?>">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><a href="#" id="show_password" onclick="change1()"><i class="fas fa-eye"></i></div></a>
                                </div>
                            </div>

                            <span class="text-danger"><?= isset($validation) ? tampil_error($validation, 'kpassword') : '' ?></span>
                            <div class="input-group">
                                <input type="password" class="form-control" name="kpassword" id="kpassword" placeholder="konfirmasi password" value="<?= set_value('kpassword'); ?>">
                                <div class="input-group-prepend">
                                <div class="input-group-text"><a href="#" id="show_password" onclick="change2()"><i class="fas fa-eye"></i></div></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    var table = $('#datatable').DataTable({
        responsive: true,
        ordering: true,
        searching: false,
        dom: 'Bfrtip',
        buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
        order: [[ 0, "asc" ]],
        columnDefs: [
        { "orderable": true, "scrollY": "200px", "scrollCollapse": true, "targets": "_all" }
        ],
    });
});

function add() {
        // reset the form 
        $("#add-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal').modal('show');
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
                } else if ($(element).is('.select')) {
                    element.next().after(error);
                } else if (element.hasClass('select2')) {
                    //error.insertAfter(element);
                    error.insertAfter(element.next());
                } else if (element.hasClass('selectpicker')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {

                var form = $('#add-form');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url('users/add') ?>',
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
</script>
<?= $this->endSection() ?>