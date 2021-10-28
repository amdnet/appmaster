<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('akun/proses'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center mb-3">
                                        <img src="<?= $detail['photo'] ?>" id="avatar" class="img-fluid">
                                    </div>
                                    <div class="custom-file form-control-sm mb-3">
                                        <input type="file" class="custom-file-input" id="photo" name="photo" onchange="photoPreview()">
                                        <label class="custom-file-label" for="Photo">Upload photo ...</label>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <!-- menampilkan pesan data berhasil disimpan -->
                                    <?php if (session()->getFlashdata('pesan')) : ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?= session()->getFlashdata('pesan'); ?>
                                        </div>
                                    <?php endif; ?>

                                </div> <!-- card-body box-profile -->
                            </div> <!-- card -->
                        </div>

                        <div class="col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-2">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <label for="role"> User Role: <span class="text-danger">*</span></label>
                                                <select id="role" name="role" class="custom-select">
                                                    <option value="" selected disabled required>Pilih Role</option>

                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email"> Email: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?= old('email'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="username"> Username: <?= $detail['username'] ?><span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= old('username'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="alamat"> Alamat: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat lengkap" value="<?= old('alamat'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="telp"> No Hp: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="telp" name="telp" class="form-control " placeholder="Nomor handphone" value="<?= old('telp'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="password"> Password: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="input password" value="<?= old('password'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <a href="#" id="show_password" onclick="change1()">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="pass_confirm"> Konfirmasi Password: <span class="text-danger">*</span> </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="pass_confirm" id="pass_confirm" placeholder="konfirmasi password" value="<?= old('pass_confirm'); ?>">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <a href="#" id="show_password2" onclick="change2()">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                        </div> <!-- row -->
                                    </div>
                                </div> <!-- card-header -->
                            </div>
                            <div class="d-grid gap-3 mb-4 float-right">
                                <a href="<?= base_url('users'); ?>" class="btn btn-dark">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div> <!-- col-md-8 -->
                    </div> <!-- row-->
                </form>
            </div>
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