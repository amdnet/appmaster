<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Data Login User</h3>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User IP</th>
                                        <th>User Email</th>
                                        <th>User ID</th>
                                        <th>Last Login</th>
                                        <th>Info</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <?php foreach ($userLogin as $login) : ?>
                                <tr>
                                    <td><?= $login->id; ?></td>
                                    <td><?= $login->ip_address; ?></td>
                                    <td><?= $login->email; ?></td>
                                    <td><?= $login->user_id; ?></td>
                                    <td><?= $login->date; ?></td>
                                    <td><?= $login->success; ?></td>
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