<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url(); ?>/users/profiledit" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="photoLama" value="<?= user()->photo; ?>">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center mb-3">
                                        <!-- menampilkan pesan data berhasil disimpan -->
                                        <?php if (session()->getFlashdata('pesan')) : ?>
                                            <div class="alert alert-success alert-dismissible fade show position-absolute" role="alert">
                                                <?= session()->getFlashdata('pesan'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <!-- menampilkan pesan data error disimpan -->
                                        <?php if (session()->getFlashdata('error')) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show position-absolute" role="alert">
                                                <?= session()->getFlashdata('error'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <a href="#photoProfil" data-toggle="modal" data-target="#photoProfil"><img src="<?= base_url('public/profil/' . user()->photo); ?>" title="<?= user()->photo; ?>" id="avatar" class="img-fluid"></a>
                                    </div>

                                    <div class="custom-file form-control-sm mb-3">
                                        <input type="file" class="custom-file-input <?= ($validation->hasError('photo')) ? 'is-invalid' : ''; ?>" id="photo" name="photo" onchange="photoPreview()">
                                        <label class="custom-file-label" for="Photo">Ganti photo ...</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('photo'); ?>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>User ID</b> <a class="float-right"><?= user()->id; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Member Since</b> <a class="float-right"><?= user()->created_at; ?>></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Last Update</b> <a class="float-right"><?= user()->updated_at; ?></a>
                                        </li>
                                    </ul>
                                </div> <!-- card-body box-profile -->
                            </div> <!-- card -->
                        </div>

                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <h4>Informasi Akun</h4>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" id="username" name="username" class="form-control" maxlength="35" value="<?= user()->username; ?>">
                                                </div>

                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="text" id="email" name="email" class="form-control" maxlength="35" value="<?= user()->email; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input type="text" id="password" name="password" class="form-control" placeholder="Input password" maxlength="17">
                                                </div>

                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input type="text" id="kpassword" name="kpassword" class="form-control" placeholder="Ulangi password" maxlength="17">
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- card-body -->
                                </div>
                            </div> <!-- card -->
                            <button type="submit" class="btn btn-primary float-right" id="edit-form-btn">Update profil</button>
                        </div> <!-- col-md-8-->

                    </div>
                </form>
            </div>
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</section>
<?= $this->endSection() ?>