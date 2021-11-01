<?= $this->extend('layout/template.php') ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="alert alert-danger" role="alert">
                    Anda tidak dapat mengakses halaman ini! Silahkan hubungi Administrator untuk informasi lebih lanjut..
                </div>

            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.row -->
</section>

<?= $this->endSection() ?>