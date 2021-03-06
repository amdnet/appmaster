<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "app/views/layout/tabelcss.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<style>
    .select2-container {
        width: 100% !important;
    }

    .datepicker {
        z-index: 9999 !important;
    }

    input:focus {
        outline: none;
    }

    .slider {
        -webkit-appearance: none;
        --range: calc(var(--max) - var(--min));
        --ratio: calc((var(--val) - var(--min))/var(--range));
        --sx: calc(.5*1.5em + var(--ratio)*(100% - 1.5em));
        margin: 0;
        padding: 0;
        width: 100%;
        height: 1.5em;
        background: transparent;
        font: 1em/1 arial, sans-serif;
        border: none;
    }

    .slider,
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
    }

    .slider::-webkit-slider-runnable-track {
        box-sizing: border-box;
        border: none;
        width: 12.5em;
        height: 0.5em;
        background: #ccc;
    }

    .js .slider::-webkit-slider-runnable-track {
        background: linear-gradient(#7b1c1a, #7b1c1a) 0/var(--sx) 100% no-repeat #ccc;
    }

    .slider::-moz-range-track {
        box-sizing: border-box;
        border: none;
        height: 0.5em;
        background: #ccc;
    }

    .slider::-ms-track {
        box-sizing: border-box;
        border: none;
        width: 12.5em;
        height: 0.5em;
        background: #ccc;
    }

    .slider::-moz-range-progress {
        height: 0.5em;
        background: #7b1c1a;
    }

    .slider::-ms-fill-lower {
        height: 0.5em;
        background: #7b1c1a;
    }

    .slider::-webkit-slider-thumb {
        margin-top: -0.550em;
        box-sizing: border-box;
        border: none;
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        background: #7b1c1a;
    }

    .slider::-moz-range-thumb {
        box-sizing: border-box;
        border: none;
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        background: #7b1c1a;
    }

    .slider::-ms-thumb {
        margin-top: 0;
        box-sizing: border-box;
        border: none;
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        background: #7b1c1a;
    }

    .slider::-ms-tooltip {
        display: none;
    }

    #tickmarks {
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
    }

    #tickmarks p {
        position: relative;
        display: flex;
        justify-content: center;
        text-align: center;
        width: 1px;
        background: #D3D3D3;
        height: 10px;
        line-height: 40px;
        margin: 0 0 20px 0;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<input type="hidden" name="id_service" value="<?= $detail->id_service; ?>">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Progres</h3>
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                            <a href="<?= base_url('service'); ?>" type="button" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> &nbsp; Kembali</a>
                            <button type="button" class="btn btn-primary btn-sm " onclick="add()" title="Tambah Data"> Tambah Data &nbsp; <i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Location</th>
                                    <th>Percent</th>
                                    <th>Note</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">
                <!-- Informasi Perusahaan -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Perusahaan</h3>
                    </div> <!-- /.card-header -->

                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mt-2">
                            <li class="list-group-item">
                                <i class="fas fa-building"></i>&nbsp; <b>Perusahaan</b> <a class="float-right"> <b>AUTO KOOL Body & Paint</b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-map-marker-alt"></i>&nbsp; <b>Alamat</b> <a class="float-right"> <b>Jl. Sunan Gn. Jati No. 91 Cirebon 45151</b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-phone-alt"></i>&nbsp; <b>Telephone</b> <a class="float-right"> <b>0231 - 202948</b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-envelope"></i>&nbsp; <b>Email</b> <a class="float-right"> <b>info@autokool.co.id</b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-headset"></i>&nbsp; <b>Service Advisor</b> <a class="float-right"> <b><?= $advisor->fullname ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telp. Advisor</b> <a class="float-right"> <b><?= $advisor->telp ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Created</b> <a class="float-right"> <b><?= $progress->p_create ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Updated</b> <a class="float-right"> <b><?= $progress->p_update ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <a class="float-right"> <b><?= $progress->fullname ?></b> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Informasi Perusahaan -->


            <!-- Informasi Konsumen -->
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Konsumen</h3>
                    </div> <!-- /.card-header -->

                    <div class="card-body">
                        <div class="col-md-12 mt-2">

                            <ul class="list-group list-group-unbordered mt-2">
                                <li class="list-group-item">
                                    <i class="fas fa-user-circle"></i>&nbsp; <b>Nama Lengkap</b> <a class="float-right"> <b><?= $client->fullname ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt"></i>&nbsp; <b>Alamat</b> <a class="float-right"> <b><?= $client->alamat ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telephone</b> <a class="float-right"> <b><?= $client->telp ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-building"></i>&nbsp; <b>Asuransi</b> <a class="float-right"> <b><?= $asuransi->username ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-circle"></i>&nbsp; <b>Nama Surveyor</b> <a class="float-right"> <b><?= $asuransi->fullname ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telp. Surveyor</b> <a class="float-right"> <b><?= $asuransi->telp ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-friends"></i>&nbsp; <b>Tipe Client</b> <a class="float-right"> <b> <?php if ($detail->tipe_client == '1') { ?>
                                                Corporate
                                            <?php } else { ?>
                                                Personal
                                            <?php } ?> </b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-circle"></i>&nbsp; <b>Nama PIC</b> <a class="float-right"> <b><?= $detail->pic_nama ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telp. PIC</b> <a class="float-right"> <b><?= $detail->pic_telp ?></b> </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Informasi Konsumen -->

            <!-- Informasi Mobil -->
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Kendaraan</h3>
                    </div> <!-- /.card-header -->

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="mobilJenis"> Jenis Mobil </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="mobilJenis" name="mobilJenis" class="form-control" value="<?= $mobilEdit->nama_mobil_jenis ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mobilMerk"> Merk Mobil </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="mobilMerk" name="mobilMerk" class="form-control" value="<?= $mobilEdit->nama_mobil_merk ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mobilTipe"> Tipe Mobil </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="mobilTipe" name="mobilTipe" class="form-control" value="<?= $mobilEdit->nama_mobil_tipe ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="tahunRakit"> Tahun Rakit </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="text" id="tahunRakit" name="tahunRakit" class="form-control" value="<?= $detail->thn_rakit ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="noPolisi"> No. Polisi </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="noPolisi" name="noPolisi" class="form-control" value="<?= $detail->no_pol ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="noRangka"> No. Rangka </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="noRangka" name="noRangka" class="form-control" value="<?= $detail->no_rangka ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="noMesin"> No. Mesin </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="noMesin" name="noMesin" class="form-control" value="<?= $detail->no_mesin ?>" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Informasi Mobil -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Image -->
<div class="modal fade" id="photoProgress" tabindex="-1" role="dialog" aria-labelledby="photoProgressTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content myPhoto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                <img src="<?= base_url('public/progress/' . $progress->p_photo); ?>" class="img-fluid">
                <br>
                <span id="namaPhoto" name="namaPhoto" class="text-dark"> <?= $progress->p_note ?> </span>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Start add modal content -->
<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center bg-warning p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Edit Progress</h5>
            </div>

            <div class="modal-body">
                <form id="edit-form" class="pl-2 pr-2">
                    <input type="hidden" id="id_progress" name="id_progress" class="form-control">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="tgl_progress"> Tanggal: </label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="tgl_progress" name="tgl_progress" class="form-control datepicker">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="id_stall"> Location: </label>
                                    <select id="id_stall" name="id_stall" class="form-control <?= ($validation->hasError('id_stall')) ? 'is-invalid' : ''; ?>">
                                        <?php foreach ($stall as $lokasi) : ?>
                                            <option value="<?= $lokasi->id_stall ?>"> <?= $lokasi->stall ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id_stall'); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pgs_persen"> Percent: </label>
                                    <div class="slidecontainer">
                                        <input type="range" min="0" max="100" value="<?= $progress->p_persen ?>" step='10' class="slider" id="myRange" onchange="updateTextInput(this.value);" list='tickmarks'>
                                        <div id="tickmarks">
                                            <p>0</p>
                                            <p>10</p>
                                            <p>20</p>
                                            <p>30</p>
                                            <p>40</p>
                                            <p>50</p>
                                            <p>60</p>
                                            <p>70</p>
                                            <p>80</p>
                                            <p>90</p>
                                            <p>100</p>
                                        </div>
                                        <input type="hidden" id="textRange" name="pgs_persen" value="<?= $progress->p_persen ?>">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="pgs_note"> Note: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-clipboard"></i></div>
                                </div>
                                <input type="text" id="pgs_note" name="pgs_note" class="form-control" value=" ">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Photo"> Photo: </label>
                            <input type="hidden" name="photoLama" value="<?= $progress->p_photo ?>">
                            <input type="hidden" name="photoBaru" id="photoBaru">
                            <img src="<?= base_url('public/progress/' . $progress->p_photo) ?>" class="img-fluid" id="photo_progress">
                            <div class="custom-file form-control-sm mt-3">
                                <input type="file" class="custom-file-input" id="pgs_photo" name="pgs_photo" onchange="photoPreview()">
                                <label class="custom-file-label" for="Photo">Ganti photo ...</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="informasi"> Informasi </label>
                            <ul class="list-group list-group-unbordered mt-2">
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Created</b> <span class="float-right"> <?= $progress->p_create ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Updated</b> <span class="float-right"> <?= $progress->p_update ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <span class="float-right"> <?= $progress->fullname ?> </span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="add-form-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- End add modal content -->

<!-- Start modal edit progress -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center bg-warning p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Edit Progress</h5>
            </div>

            <div class="modal-body">
                <form id="edit-form" class="pl-2 pr-2">
                    <input type="hidden" id="id_progress" name="id_progress" class="form-control">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="tgl_progress"> Tanggal: </label>
                                    <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="tgl_progress" name="tgl_progress" class="form-control datepicker">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="id_stall"> Location: </label>
                                    <select id="id_stall" name="id_stall" class="form-control <?= ($validation->hasError('id_stall')) ? 'is-invalid' : ''; ?>">
                                        <?php foreach ($stall as $lokasi) : ?>
                                            <option value="<?= $lokasi->id_stall ?>"> <?= $lokasi->stall ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('id_stall'); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pgs_persen"> Percent: </label>
                                    <div class="slidecontainer">
                                        <input type="range" min="0" max="100" value="<?= $progress->p_persen ?>" step='10' class="slider" id="myRange" onchange="updateTextInput(this.value);" list='tickmarks'>
                                        <div id="tickmarks">
                                            <p>0</p>
                                            <p>10</p>
                                            <p>20</p>
                                            <p>30</p>
                                            <p>40</p>
                                            <p>50</p>
                                            <p>60</p>
                                            <p>70</p>
                                            <p>80</p>
                                            <p>90</p>
                                            <p>100</p>
                                        </div>
                                        <input type="hidden" id="textRange" name="pgs_persen" value="<?= $progress->p_persen ?>">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="pgs_note"> Note: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-clipboard"></i></div>
                                </div>
                                <input type="text" id="pgs_note" name="pgs_note" class="form-control" value=" ">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="Photo"> Photo: </label>
                            <input type="hidden" name="photoLama" value="<?= $progress->p_photo ?>">
                            <input type="hidden" name="photoBaru" id="photoBaru">
                            <img src="<?= base_url('public/progress/' . $progress->p_photo) ?>" class="img-fluid" id="photo_progress">
                            <div class="custom-file form-control-sm mt-3">
                                <input type="file" class="custom-file-input" id="pgs_photo" name="pgs_photo" onchange="photoPreview()">
                                <label class="custom-file-label" for="Photo">Ganti photo ...</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="informasi"> Informasi </label>
                            <ul class="list-group list-group-unbordered mt-2">
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Created</b> <span class="float-right"> <?= $progress->p_create ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Updated</b> <span class="float-right"> <?= $progress->p_update ?> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <span class="float-right"> <?= $progress->fullname ?> </span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="edit-form-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- End modal edit progress -->

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?php include_once "app/views/layout/tabeljs.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    const _R = document.querySelector('[type=range]');
    _R.style.setProperty('--val', +_R.value);
    _R.style.setProperty('--max', +_R.max);
    _R.style.setProperty('--min', +_R.min);

    document.documentElement.classList.add('js');

    _R.addEventListener('input', e => {
        _R.style.setProperty('--val', +_R.value);
    }, false);

    function updateTextInput(val) {
        document.getElementById('textRange').value = val;
    }

    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    function photoPreview() {
        const photo = document.querySelector('#pgs_photo');
        const photoLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('#photo_progress');

        photoLabel.textContent = photo.files[0].name;
        document.getElementById('photoBaru').value = photo.files[0].name;

        const filePhoto = new FileReader();
        filePhoto.readAsDataURL(photo.files[0]);

        filePhoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    <?php require_once(APPPATH . 'views/progress/view.js'); ?>
    <?php require_once(APPPATH . 'views/progress/edit.js'); ?>
    <?php require_once(APPPATH . 'views/progress/delete.js'); ?>
</script>
<?= $this->endSection() ?>