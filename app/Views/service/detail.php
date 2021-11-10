<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "app/views/layout/tabelcss.php"; ?>
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
                                    <th>ID Service</th>
                                    <th>Tanggal</th>
                                    <th>Location</th>
                                    <th>Percent</th>
                                    <th>Note</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($progress as $progres) : ?>
                                    <tr>
                                        <?php $no = 1; ?>
                                        <td><?= $no++; ?></td>
                                        <td><?= $progres->id_service; ?></td>
                                        <td><?= $progres->tgl_progress; ?></td>
                                        <td><?= $progres->stall; ?></td>
                                        <td><?= $progres->pgs_persen; ?></td>
                                        <td><?= $progres->pgs_note; ?></td>
                                        <td><a href="<?= base_url('public/progress/' . $progres->pgs_photo) ?>" data-toggle="modal" data-target="#photoProfil">
                                                <img src="<?= base_url('public/progress/' . $progres->pgs_photo) ?>" title="' . $progres->pgs_note . '" class="img-fluid rounded profile-user-img"></a> </td>
                                        <td><button type="button" class="btn btn-sm btn-success" onclick="editProgress(<?= $progres->id_progress ?>)"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(<?= $progres->id_progress ?>)"><i class="fa fa-trash-alt"></i></button></td>
                                    </tr>
                                <?php endforeach; ?>
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
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Created</b> <a class="float-right"> <b><?= $detail->created_at ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-calendar-alt"></i>&nbsp; <b>Data Updated</b> <a class="float-right"> <b><?= $detail->updated_at ?></b> </a>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-user-edit"></i>&nbsp; <b>User Update</b> <a class="float-right"> <b><?= $detail->id_users ?></b> </a>
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
<div class="modal fade" id="photoProfil" tabindex="-1" role="dialog" aria-labelledby="photoProfilTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content myPhoto">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center">
                <img src="<?= base_url('public/progress/' . $progres->pgs_photo); ?>" class="img-fluid">
                <br>
                <span class="text-dark"><?= $progres->pgs_note;; ?></span>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Start modal edit progress -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="text-center bg-dark p-2">
                <h5 class="modal-title text-white" id="info-header-modalLabel">Edit Progress</h5>
            </div>

            <div class="modal-body">
                <form id="edit-form" class="pl-2 pr-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="tgl_progress"> Tanggal: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                        <input type="text" id="tgl_progress" name="tgl_progress" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="id_stall"> Location: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-location-arrow"></i></div>
                                        </div>
                                        <input type="text" id="id_stall" name="id_stall" class="form-control" value="<?= (old('id_stall')) ? old('id_stall') : $progres->id_stall; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pgs_persen"> Percent: </label>

                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="pgs_note"> Note: </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-clipboard"></i></div>
                                </div>
                                <input type="text" id="pgs_note" name="pgs_note" class="form-control" value="<?= (old('id_stall')) ? old('id_stall') : $progres->pgs_note; ?>">
                            </div>
                        </div>
                    </div>
            </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="tgl_progress"> Tanggal Progress: </label>
                            <input type="text" id="tgl_progress" name="tgl_progress" class="form-control" placeholder="Tipe Mobil" required>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
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
    $(function() {
        $('#data_table').DataTable({
            dom: 'Blfrtip',
            buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            language: {
                emptyTable: "Tidak ada data di dalam tabel",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data entri",
                lengthMenu: "Lihat _MENU_ entri",
                loadingRecords: "Loading data...",
                processing: "Memproses data...",
                search: "Pencarian: ",
            },
        });
    });
</script>
<?php require_once(APPPATH . 'views/progress/edit.php'); ?>
<?php require_once(APPPATH . 'views/progress/delete.php'); ?>
<?= $this->endSection() ?>