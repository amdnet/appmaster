<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img src="<?= base_url() ?>/public/img/default.svg" class="profile-user-img img-fluid img-circle">
                            </div>
                            <h3 class="profile-username text-center"><?= user()->username; ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>ID</b> <a class="float-right"><?= user()->user_id; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= user()->email; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Create</b> <a class="float-right"><?= user()->created_at; ?></a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block">Edit Profil</a>
                        </div> <!-- card-body box-profile -->

                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </section>
<?= $this->endSection() ?>