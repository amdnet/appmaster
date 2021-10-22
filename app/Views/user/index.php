<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Data User Login</h3>
                            <a class="btn btn-primary btn-sm float-right" href="#">Add User</a>
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
</script>
<?= $this->endSection() ?>