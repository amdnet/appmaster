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
                            <h4 class="profile-username text-center"><?= user()->username; ?></h4>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>ID</b> <a class="float-right"><?= user()->id; ?></a>
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

                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <h4>Informasi Personal</h4>
                            
                            <div class="card-body">
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

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" id="password" name="password" class="form-control" maxlength="35">
                                </div>

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="text" id="kpassword" name="kpassword" class="form-control" maxlength="35">
                                </div>
					        </div>
                            <a href="#" class="btn btn-primary btn-block">Edit Profil</a>
                        </div> <!-- card-body box-profile -->

                    </div> <!-- card -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container-fluid -->
    </section>
<?= $this->endSection() ?>