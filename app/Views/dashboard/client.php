<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "app/views/layout/tabelcss.php"; ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<input type="hidden" name="idClient" value="<?= user()->id ?>">
<input type="hidden" name="id_service" value="<?= $detail->id_service ?>">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Progres</h3>
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
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Created</b> <a class="float-right"> <b><?= $detail->s_create ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Updated</b> <a class="float-right"> <b><?= $detail->s_update ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <a class="float-right"> <b><?= $detail->fullname ?></b> </a>
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
                                    <i class="fas fa-user-circle"></i>&nbsp; <b>Nama Lengkap</b> <a class="float-right"> <b><?= user()->fullname ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt"></i>&nbsp; <b>Alamat</b> <a class="float-right"> <b><?= user()->alamat ?></b> </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telephone</b> <a class="float-right"> <b><?= user()->telp ?></b> </a>
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
                                    <i class="fas fa-user-circle"></i>&nbsp; <b>Nama PIC</b> <a class="float-right">
                                        <?php if ($detail->pic_nama == null) { ?>
                                            <em> null </em>
                                        <?php } else { ?>
                                            <b><?= $detail->pic_nama ?></b>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-mobile-alt"></i>&nbsp; <b>Telp. PIC</b> <a class="float-right">
                                        <?php if ($detail->pic_nama == null) { ?>
                                            <em> null </em>
                                        <?php } else { ?>
                                            <b><?= $detail->pic_telp ?></b>
                                        <?php } ?>
                                    </a>
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
                                    <input type="text" id="mobilJenis" name="mobilJenis" class="form-control" value="<?= $detail->nama_mobil_jenis ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mobilMerk"> Merk Mobil </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="mobilMerk" name="mobilMerk" class="form-control" value="<?= $detail->nama_mobil_merk ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mobilTipe"> Tipe Mobil </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-car"></i></div>
                                    </div>
                                    <input type="text" id="mobilTipe" name="mobilTipe" class="form-control" value="<?= $detail->nama_mobil_tipe ?>" disabled>
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
<div id="photo-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content myPhoto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="photo-form" class="pl-2 pr-2">
                    <input type="hidden" id="id_progress" name="id_progress" class="form-control">
                    <img src="<?= base_url('public/progress/') ?>" class="img-fluid" id="pgs_photo">
                    <input type="text" id="pgs_note" name="pgs_note" class="form-control" disabled>

                </form>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->

<!-- Start VIEW modal progress -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center bg-warning p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Edit Progress</h5>
            </div>

            <div class="modal-body">
                <form id="edit-form" class="pl-2 pr-2">
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
                                    <select id="id_stall" name="id_stall" class="form-control">

                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pgs_persen"> Percent: </label>
                                    <div class="slidecontainer">
                                        <input type="range" min="0" max="100" value="" step='10' class="slider" id="myRange" onchange="updateTextInput(this.value);" list='tickmarks'>
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
                                        <input type="hidden" id="textRange" name="pgs_persen" value="">
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
                            <input type="hidden" name="photoLama" value="">
                            <input type="hidden" name="photoBaru" id="photoBaru">
                            <img src="<?= base_url('public/progress/') ?>" class="img-fluid" id="pgs_photo">
                            <div class="custom-file form-control-sm mt-3">
                                <input type="file" class="custom-file-input" name="pgs_photo" onchange="photoPreview()">
                                <label class="custom-file-label" for="Photo">Ganti photo ...</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="informasi"> Informasi </label>
                            <ul class="list-group list-group-unbordered mt-2">
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Created</b> <span class="float-right"> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-calendar-alt"></i>&nbsp; <b>Date Updated</b> <span class="float-right"> </span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <span class="float-right"> </span>
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

    <?php require_once(APPPATH . 'views/dashboard/client.js'); ?>
</script>
<?= $this->endSection() ?>