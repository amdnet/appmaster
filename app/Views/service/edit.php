<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<!-- Main content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('service/editsave/' . $detail->id_service); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="idUsers" name="idUsers" class="form-control" value="<?= user()->id; ?>">

                    <!-- Informasi Perusahaan -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">

                                <div class="col-md-8 mt-2">
                                    <h3 class="card-title">Informasi Perusahaan</h3>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?= base_url('service'); ?>" class="btn btn-dark btn-sm float-right"><i class="fas fa-arrow-circle-left"></i> &nbsp; Batal</a>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="perusahaan"> Perusahaan: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-building"></i></div>
                                        </div>
                                        <input type="perusahaan" id="perusahaan" name="perusahaan" class="form-control" value="AUTO KOOL Body & Paint" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="alamat"> Alamat: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                        <input type="alamat" id="alamat" name="alamat" class="form-control" value="Jl. Sunan Gn. Jati No. 91 Cirebon 45151" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone"> Telephone: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                        </div>
                                        <input type="phone" id="phone" name="phone" class="form-control" value="0231 - 202948" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email"> Email: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                        </div>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="info@autokool.co.id" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="advisor"> Service Advisor: <span class="text-danger">*</span> <small><em>(staff pelayanan konsumen)</em></small></label>
                                    <select id="advisor" name="advisor" class="form-control select2 <?= ($validation->hasError('advisor')) ? 'is-invalid' : ''; ?>" onchange="document.getElementById('telp').value=this.options[this.selectedIndex].getAttribute('data-telp')">
                                        <option value="<?= $detail->id_advisor ?>" selected disabled><?= $advisor->fullname ?></option>
                                        <?php foreach ($advisorMenu as $menu) : ?>
                                            <option value="<?= $menu->user_id ?>" data-telp="<?= $menu->telp ?>"> <?= $menu->fullname ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('advisor'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telp"> Telp. Advisor: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                        </div>
                                        <input type="text" id="telp" name="telp" class="form-control" value="<?= $advisor->telp; ?>" disabled>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Informasi Perusahaan -->

                    <!-- Informasi Konsumen -->
                    <div class="card card-success">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8 mt-2">
                                    <h3 class="card-title">Informasi Konsumen</h3>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="client"> Nama Client: <span class="text-danger">*</span></label>
                                    <select id="client" name="client" class="form-control select2 <?= ($validation->hasError('client')) ? 'is-invalid' : ''; ?>" onchange="document.getElementById('alamatClient').value=this.options[this.selectedIndex].getAttribute('data-alamatClient');document.getElementById('telpClient').value=this.options[this.selectedIndex].getAttribute('data-telpClient')">
                                        <option value="<?= $detail->id_client ?>" selected disabled><?= $client->fullname; ?></option>
                                        <?php foreach ($clientMenu as $menu) : ?>
                                            <option value="<?= $menu->user_id ?>" data-alamatClient="<?= $menu->alamat ?>" data-telpClient="<?= $menu->telp ?>"> <?= $menu->fullname ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('client'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="alamatClient"> Alamat Client: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                        <input type="text" id="alamatClient" name="alamatClient" class="form-control" value="<?= $client->alamat; ?>" autocomplete="off" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telpClient"> Telp. Client: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                        </div>
                                        <input type="text" id="telpClient" name="telpClient" class="form-control" value="<?= $client->telp; ?>" autocomplete="off" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="asuransi"> Asuransi: <span class="text-danger">*</span> <small><em>(perusahaan asuransi)</em></small></label>
                                    <select id="asuransi" name="asuransi" class="form-control select2 <?= ($validation->hasError('asuransi')) ? 'is-invalid' : ''; ?>" onchange="document.getElementById('svyAsuransi').value=this.options[this.selectedIndex].getAttribute('data-svyAsuransi');document.getElementById('telpSvy').value=this.options[this.selectedIndex].getAttribute('data-telpSvy')">
                                        <option value="<?= $detail->id_asuransi ?>" disabled selected><?= $asuransi->username ?></option>
                                        <?php foreach ($asuransiMenu as $menu) : ?>
                                            <option value="<?= $menu->user_id ?>" data-svyAsuransi="<?= $menu->fullname ?>" data-telpSvy="<?= $menu->telp ?>"> <?= $menu->username ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('asuransi'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="svyAsuransi"> Nama Surveyor: <span class="text-danger">*</span> <small><em>(perwakilan asuransi)</em></small></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                        </div>
                                        <input type="text" id="svyAsuransi" name="svyAsuransi" class="form-control" value="<?= $asuransi->fullname ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telpSvy"> Telp. Surveyor: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                        </div>
                                        <input type="text" id="telpSvy" name="telpSvy" class="form-control" value="<?= $asuransi->telp ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="tipeClient"> Tipe Client: <span class="text-danger">*</span></label>
                                    <select id="tipeClient" name="tipeClient" class="form-control">
                                        <!-- <option disabled selected>-- pilih tipe konsumen --</option> -->
                                        <option value="<?= $detail->tipe_client ?>" disabled selected>
                                            <?php if ($detail->tipe_client == '1') { ?>
                                                Corporate
                                            <?php } else { ?>
                                                Personal
                                            <?php } ?>
                                        </option>
                                        <option value="2">Personal</option>
                                        <option value="1">Corporate</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tipeClient'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="namaPIC"> Nama PIC: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                        </div>
                                        <input type="text" id="namaPIC" name="namaPIC" class="form-control <?= ($validation->hasError('namaPIC')) ? 'is-invalid' : ''; ?>" value="<?= $detail->pic_nama ?>" disabled>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('namaPIC'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telpPIC"> Telp. PIC: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-mobile-alt"></i></div>
                                        </div>
                                        <input type="text" id="telpPIC" name="telpPIC" class="form-control <?= ($validation->hasError('telpPIC')) ? 'is-invalid' : ''; ?>" value="<?= $detail->pic_telp ?>" disabled>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('telpPIC'); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Informasi Konsumen -->

                    <!-- Informasi Mobil -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8 mt-2">
                                    <h3 class="card-title">Informasi Kendaraan</h3>
                                </div>
                            </div>
                        </div> <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="mobilJenis"> Jenis Mobil: <span class="text-danger">*</span></label>
                                    <select id="mobilJenis" name="mobilJenis" class="form-control select2 <?= ($validation->hasError('mobilJenis')) ? 'is-invalid' : ''; ?>">
                                        <option value="<?= $detail->id_mbl_jenis ?>" disabled selected><?= $mobilEdit->nama_mobil_jenis ?></option>
                                        <?php foreach ($mobilJenis as $mobilJenis) : ?>
                                            <option value="<?= $mobilJenis->id_mobil_jenis ?>"> <?= $mobilJenis->nama_mobil_jenis ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('mobilJenis'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mobilMerk"> Merk Mobil: <span class="text-danger">*</span></label>
                                    <select id="mobilMerk" name="mobilMerk" class="form-control select2 <?= ($validation->hasError('mobilMerk')) ? 'is-invalid' : ''; ?>">
                                        <option value="<?= $detail->id_mbl_merk ?>" disabled selected><?= $mobilEdit->nama_mobil_merk ?></option>
                                        <?php foreach ($mobilMerk as $mobilMerk) : ?>
                                            <option value="<?= $mobilMerk->id_mobil_merk ?>"> <?= $mobilMerk->nama_mobil_merk ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('mobilMerk'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mobilTipe"> Tipe Mobil: <span class="text-danger">*</span></label>
                                    <select id="mobilTipe" name="mobilTipe" class="form-control select2 <?= ($validation->hasError('mobilTipe')) ? 'is-invalid' : ''; ?>">
                                        <option value="<?= $detail->id_mbl_tipe ?>" disabled selected><?= $mobilEdit->nama_mobil_tipe ?></option>
                                        <?php foreach ($mobilTipe as $mobilTipe) : ?>
                                            <option value="<?= $mobilTipe->id_mobil_tipe ?>"> <?= $mobilTipe->nama_mobil_tipe ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('mobilTipe'); ?>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="tahunRakit"> Tahun Rakit: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="tahunRakit" name="tahunRakit" class="form-control <?= ($validation->hasError('tahunRakit')) ? 'is-invalid' : ''; ?>" value="<?= (old('tahunRakit')) ? old('tahunRakit') : $detail->thn_rakit ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tahunRakit'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="noPolisi"> No. Polisi: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-car"></i></div>
                                        </div>
                                        <input type="text" id="noPolisi" name="noPolisi" class="form-control <?= ($validation->hasError('noPolisi')) ? 'is-invalid' : ''; ?>" value="<?= (old('noPolisi')) ? old('noPolisi') : $detail->no_pol ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('noPolisi'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="noRangka"> No. Rangka: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-car"></i></div>
                                        </div>
                                        <input type="text" id="noRangka" name="noRangka" class="form-control <?= ($validation->hasError('noRangka')) ? 'is-invalid' : ''; ?>" value="<?= (old('noRangka')) ? old('noRangka') : $detail->no_rangka ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('noRangka'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="noMesin"> No. Mesin: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-car"></i></div>
                                        </div>
                                        <input type="text" id="noMesin" name="noMesin" class="form-control <?= ($validation->hasError('noMesin')) ? 'is-invalid' : ''; ?>" value="<?= (old('noMesin')) ? old('noMesin') : $detail->no_mesin ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('noMesin'); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Informasi Mobil -->
                    <div class="d-grid gap-3 mb-4 float-right">
                        <a href="<?= base_url('service'); ?>" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> &nbsp; Batal</a>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> &nbsp; Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('.select2').select2();
</script>

<script>
    document.getElementById('tipeClient').addEventListener('change', function() {
        if (this.value == 1) {
            document.getElementById('namaPIC').disabled = false;
            document.getElementById('namaPIC').placeholder = 'Nama PIC wajib diisi';
            document.getElementById('telpPIC').disabled = false;
            document.getElementById('telpPIC').placeholder = 'Telp. PIC wajib diisi';
        } else {
            document.getElementById('namaPIC').disabled = true;
            document.getElementById('namaPIC').placeholder = '';
            document.getElementById('namaPIC').value = '';
            document.getElementById('telpPIC').disabled = true;
            document.getElementById('telpPIC').placeholder = '';
        }
    });
</script>
<?= $this->endSection() ?>