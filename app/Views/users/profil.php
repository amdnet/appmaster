<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-md-4">
                        <form action="<?= base_url('users/editphoto/' . user()->id); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="photoLama" value="<?= user()->photo; ?>">
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

                                        <a href="#photoProfil" data-toggle="modal" data-target="#photoProfil">
                                            <img src="<?= base_url('public/profil') . '/' . user()->photo; ?>" title="<?= user()->photo; ?>" id="avatar" class="img-fluid">
                                        </a>
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
                                            <b>Member Since</b> <a class="float-right"><?= user()->created_at; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Last Update</b> <a class="float-right"><?= user()->updated_at; ?></a>
                                        </li>
                                    </ul>

                                    <!-- Modal Image -->
                                    <div class="modal fade" id="photoProfil" tabindex="-1" role="dialog" aria-labelledby="photoProfilTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content myPhoto">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img src="<?= base_url('public/profil/' . user()->photo); ?>" class="img-fluid">
                                                    <br>
                                                    <span class="text-dark"><?= user()->photo; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->

                                    <div class="d-grid gap-3 float-right">
                                        <button class="btn btn-dark btn-sm" type="submit" onclick="return confirm('Simpan perubahan data?')">Update photo</button>
                                    </div>
                                </div> <!-- card-body box-profile -->
                            </div> <!-- card -->
                        </form>
                    </div>

                    <div class="col-md-8">
                        <form action="<?= base_url('users/editdataprofil/' . user()->id); ?>" method="POST">
                            <input type="hidden" name="emailLama" value="<?= user()->email; ?>">
                            <input type="hidden" name="userLama" value="<?= user()->username; ?>">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <label for="role"> User Role:</label>
                                                <input type="text" id="role" name="role" class="form-control" value="<?= $detail['name']; ?>" disabled>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email"> Email: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= (old('email')) ? old('email') : user()->email; ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('email'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="username"> Username: <span class="text-danger">*</span> <small>(nama asuransi, user login)</small></label>
                                                <div class="input-group">
                                                    <input type="text" id="username" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username" value="<?= (old('username')) ? old('username') : user()->username; ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('username'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="fullname"> Nama Lengkap: <span class="text-danger">*</span> <small>(nama advisor, pic, surveyor, client)</small></label>
                                                <div class="input-group">
                                                    <input type="text" id="fullname" name="fullname" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" placeholder="nama lengkap" value="<?= (old('fullname')) ? old('fullname') : user()->fullname; ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('fullname'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="telp"> No Hp: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="telp" name="telp" class="form-control <?= ($validation->hasError('telp')) ? 'is-invalid' : ''; ?>" placeholder="Nomor handphone" value="<?= (old('telp')) ? old('telp') : user()->telp; ?>">
                                                    <div class=" input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('telp'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="alamat"> Alamat: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="alamat" name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" placeholder="Alamat lengkap" value="<?= (old('alamat')) ? old('alamat') : user()->alamat; ?>">
                                                    <div class=" input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-house-user"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('alamat'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="d-grid gap-3 float-right">
                                            <button class="btn btn-dark btn-sm" type="submit" onclick="return confirm('Simpan perubahan data?')">Update profil</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> <!-- form profil -->

                        <!-- form password -->
                        <form action="<?= base_url('users/editpassword/' . user()->id); ?>" method="POST">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="password"> Password: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="input password">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <a href="#" id="show_password" onclick="change1()">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('password'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="pass_confirm"> Konfirmasi Password: <span class="text-danger">*</span> </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : ''; ?>" name="pass_confirm" id="pass_confirm" placeholder="konfirmasi password">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <a href="#" id="show_password2" onclick="change2()">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('pass_confirm'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-3 float-right">
                                            <button class="btn btn-dark btn-sm" type="submit">Update password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> <!-- form password -->

                    </div>
                </div> <!-- row -->

            </div> <!-- col-12-->
        </div> <!-- row -->
    </div> <!-- container-fluid -->
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
    function photoPreview() {
        const photo = document.querySelector('#photo');
        const photoLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('#avatar');

        photoLabel.textContent = photo.files[0].name;

        const filePhoto = new FileReader();
        filePhoto.readAsDataURL(photo.files[0]);

        filePhoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function change1() {
        var x = document.getElementById('password').type;

        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    function change2() {
        var x = document.getElementById('pass_confirm').type;

        if (x == 'password') {
            document.getElementById('pass_confirm').type = 'text';
            document.getElementById('show_password2').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('pass_confirm').type = 'password';
            document.getElementById('show_password2').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>
<?= $this->endSection() ?>