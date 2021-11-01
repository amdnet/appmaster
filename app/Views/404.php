<?= $this->extend('layout/template.php') ?>
<?= $this->section('css') ?>
<?php include_once "layout/404.php"; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 404</h1>
                <hr>
                <h2>Oops... Halaman Tidak Ditemukan!</h2>
                <p>Anda tidak dapat mengakses halaman ini! <br> Silahkan hubungi Administrator untuk informasi lebih lanjut <a href="#">contact us</a></p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>