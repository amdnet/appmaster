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
                <button type="button" class="btn btn-primary btn-sm float-right" onclick="add()" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah Data</button>
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
                  <th>Photo</th>
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

<!-- Add modal content -->
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="text-center bg-dark p-2">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Add New User Account</h4>
      </div>

      <div class="modal-body">
        <form id="add-form" class="pl-3 pr-3">
          <?= csrf_field(); ?>

          <div class="row">
            <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="11" required>

            <div class="col-md-4">
              <div class="text-center mb-3">
                <img src="<?= base_url() ?>/public/img/avatar.png" id="avatar" class="img-fluid">
              </div>
              <div class="custom-file form-control-sm mb-3">
                <input type="file" class="custom-file-input" id="photo" name="photo" onchange="photoPreview()">
                <label class="custom-file-label" for="Photo">Upload photo ...</label>
                <div class="invalid-feedback">

                </div>
              </div>
            </div>
            <!-- col-md-4 -->

            <div class="col-md-8">
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="role"> User Role: <span class="text-danger">*</span></label>

                  <select id="role" name="role" class="custom-select">
                    <option value="" selected disabled required>Pilih Role</option>
                    <?php foreach ($role as $rule) : ?>
                      <option value="<?= $rule->id ?>"> <?= $rule->name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="email"> Email: <span class="text-danger">*</span> </label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" maxlength="255" required>
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="username"> Username: <span class="text-danger">*</span> </label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="30" required>
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="alamat"> Alamat: <span class="text-danger">*</span> </label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" maxlength="100" required>
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="telp"> Telp: <span class="text-danger">*</span> </label>
                    <input type="text" id="telp" name="telp" class="form-control" placeholder="Telp" maxlength="15" required>
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="passwordHash"> Password: <span class="text-danger">*</span> </label>
                    <input type="password" id="passwordHash" name="passwordHash" class="form-control" placeholder="Password hash" maxlength="255" required>
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="form-group">
                    <label for="passwordHash"> Konfirmasi Password: <span class="text-danger">*</span> </label>
                    <input type="password" id="passwordHash" name="passwordHash" class="form-control" placeholder="Password hash" maxlength="255" required>
                  </div>
                </div>

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
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="text-center bg-dark p-2">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Edit User Account</h4>
      </div>
      <div class="modal-body">
        <form id="edit-form" class="pl-3 pr-3">
          <div class="row">
            <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="11" required>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="email"> Email: <span class="text-danger">*</span> </label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" maxlength="255" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="username"> Username: <span class="text-danger">*</span> </label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" maxlength="30" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="photo"> Photo: <span class="text-danger">*</span> </label>
                <input type="text" id="photo" name="photo" class="form-control" placeholder="Photo" maxlength="100" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="alamat"> Alamat: <span class="text-danger">*</span> </label>
                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" maxlength="100" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="telp"> Telp: <span class="text-danger">*</span> </label>
                <input type="text" id="telp" name="telp" class="form-control" placeholder="Telp" maxlength="15" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="passwordHash"> Password hash: <span class="text-danger">*</span> </label>
                <input type="password" id="passwordHash" name="passwordHash" class="form-control" placeholder="Password hash" maxlength="255" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="createdAt"> Created at: </label>
                <input type="date" id="createdAt" name="createdAt" class="form-control" dateISO="true">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="updatedAt"> Updated at: </label>
                <input type="date" id="updatedAt" name="updatedAt" class="form-control" dateISO="true">
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
      buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
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
        $("#edit-form #email").val(response.email);
        $("#edit-form #username").val(response.username);
        $("#edit-form #photo").val(response.photo);
        $("#edit-form #alamat").val(response.alamat);
        $("#edit-form #telp").val(response.telp);
        $("#edit-form #passwordHash").val(response.password_hash);
        $("#edit-form #createdAt").val(response.created_at);
        $("#edit-form #updatedAt").val(response.updated_at);

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
      title: 'Are you sure of the deleting process?',
      text: "You cannot back after confirmation",
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