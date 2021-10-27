<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kategori Mobil</h3>
                        <button type="button" class="btn btn-primary btn-sm float-right" onclick="add()" title="Tambah Data"><i class="fas fa-database"></i> &nbsp; Tambah Data</button>
                    </div>

                    <div class="card-body">



                        <form class="pl-2 pr-2" action="<?= base_url('akun/proses'); ?>" method="post">
                            <?= csrf_field(); ?>

                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" required>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="role"> User Role: </label>
                                    <select id="role" name="role" class="custom-select">
                                        <option value="" selected disabled>Pilih Role</option>
                                        <?php foreach ($role as $rule) : ?>
                                            <option value="<?= $rule->id ?>"> <?= $rule->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mt-3">
                                    <label for="email"> Email: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                        </div>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="username"> Username: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                        </div>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mt-3">
                                    <label for="email"> Alamat: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                                        </div>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Alamat lengkap" value="<?= set_value('email'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="username"> No Hp: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                        </div>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Nomor handphone" value="<?= set_value('username'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mt-3">
                                    <label for="password_hash"> Password: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><a href="#" id="show_password" onclick="change1()"><i class="fas fa-eye"></i></div></a>
                                        </div>
                                        <input type="password" class="form-control" name="password_hash" id="password_hash" placeholder="input password" value="<?= set_value('password_hash'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="pass_confirm"> Konfirmasi Password: <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><a href="#" id="show_password" onclick="change2()"><i class="fas fa-eye"></i></div></a>
                                        </div>
                                        <input type="password" class="form-control" name="pass_confirm" id="pass_confirm" placeholder="konfirmasi password" value="<?= set_value('pass_confirm'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-3 mt-4 float-right">
                                <a href="#" class="btn btn-dark">Batal</a>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan User Role</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <h4>Periksa Entrian Form</h4>
                                </hr />
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>
                        tulis keterangan disini
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
    function change1() {
        var x = document.getElementById('password_hash').type;

        if (x == 'password') {
            document.getElementById('password_hash').type = 'text';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('password_hash').type = 'password';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    function change2() {
        var x = document.getElementById('pass_confirm').type;

        if (x == 'password') {
            document.getElementById('pass_confirm').type = 'text';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('pass_confirm').type = 'password';
            document.getElementById('show_password').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>
<?= $this->endSection() ?>