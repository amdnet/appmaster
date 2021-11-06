<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <?php foreach ($role as $rule) : ?>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <img class="img-fluid" width="200px" height="200px" src="<?= base_url('public/profil/' . $rule->photo) ?>">
                                        </div>
                                        <div class="col-md-6">

                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>User Name</b> <a class="float-right"><?= $rule->username ?></a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</section>
<?= $this->endSection() ?>