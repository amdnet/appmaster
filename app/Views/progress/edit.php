<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<style>
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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('progress/update/' . $progress->id_progress); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_progress" value="<?= $progress->id_progress ?>">
                    <input type="hidden" name="id_service" value="<?= $progress->id_service ?>">

                    <div class="card card-warning">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <h3 class="card-title"><i class="fas fa-car"></i> &nbsp; Edit data progress </h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="tgl_progress"> Tanggal: </label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="text" id="tgl_progress" name="tgl_progress" class="form-control datepicker <?= ($validation->hasError('tgl_progress')) ? 'is-invalid' : ''; ?>" value="<?= (old('tgl_progress')) ? old('tgl_progress') : $progress->tgl_progress ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('tgl_progress'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="id_stall"> Location: </label>
                                            <select id="id_stall" name="id_stall" class="form-control <?= ($validation->hasError('id_stall')) ? 'is-invalid' : ''; ?>">
                                                <option value="<?= $progress->p_stall ?>" disabled selected> <?= $progress->stall ?> </option>
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
                                                <input type="range" min="0" max="100" value="<?= (old('pgs_persen')) ? old('pgs_persen') : $progress->pgs_persen ?>" step='10' class="slider" id="myRange" onchange="updateTextInput(this.value);" list='tickmarks'>
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
                                                <input type="hidden" id="textRange" name="pgs_persen" class="form-control <?= ($validation->hasError('pgs_persen')) ? 'is-invalid' : ''; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pgs_persen'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="pgs_note"> Note: </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-clipboard"></i></div>
                                                </div>
                                                <input type="text" id="pgs_note" name="pgs_note" class="form-control <?= ($validation->hasError('pgs_note')) ? 'is-invalid' : ''; ?>" value="<?= (old('pgs_note')) ? old('pgs_note') : $progress->pgs_note ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pgs_note'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="Photo"> Photo: </label> <br>
                                            <input type="hidden" name="photoLama" value="<?= $progress->pgs_photo ?>">
                                            <img src="<?= base_url('public/progress/' . $progress->pgs_photo) ?>" class="img-fluid" id="photo_progress">
                                            <div class="custom-file form-control-sm mt-3">
                                                <input type="file" class="custom-file-input  <?= ($validation->hasError('pgs_photo')) ? 'is-invalid' : ''; ?>" id="pgs_photo" name="pgs_photo" onchange="photoPreview()">
                                                <label class="custom-file-label" for="Photo">Ganti photo ...</label>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('pgs_photo'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-3 mb-4 float-right">
                        <a href="<?= base_url('service/detail/' . $progress->id_service); ?>" type="button" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> &nbsp; Batal</a>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> &nbsp; Update</button>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h3 class="card-title"><i class="fas fa-clipboard"></i> &nbsp; Informasi data progress </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 mb-1">
                                <label> Data Create: </label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $progress->created_at ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label> Data Update: </label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $progress->updated_at ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label> User Update: </label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-circle"></i></div>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $progress->fullname ?>" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

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

    function photoPreview() {
        const photo = document.querySelector('#pgs_photo');
        const photoLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('#photo_progress');
        photoLabel.textContent = photo.files[0].name;
        const filePhoto = new FileReader();
        filePhoto.readAsDataURL(photo.files[0]);
        filePhoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection() ?>