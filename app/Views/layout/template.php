<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
	<title><?= $pageTitle . " - " . $situs ?></title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/css/bootstrap-4.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/css/custom.css">
	<style>
		.select2-container .select2-selection--single {
			height: 38px !important;
		}
	</style>

	<?= $this->renderSection('css') ?>
</head>

<body class="hold-transition sidebar-mini">

	<div class="wrapper">

		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<!-- <a href="index3.html" class="brand-link"> -->
			<!-- <img src="<?= base_url() ?>/public/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">AdminLTE 3</span> -->
			<!-- </a> -->

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image pt-2">
						<img src="<?= base_url('public/profil/' . user()->photo); ?>" class="img-circle elevation-2">
					</div>

					<div class="info">
						<span class="d-block text-white"> hi, <?= user()->fullname; ?> </span>
						<small><a href="<?= base_url('users/profil/' . user()->id); ?>" class="<?= (current_url() == base_url('user/profil')) ? 'text-warning' : '' ?>"><i class="far fa-user-circle"></i> Profil</a> <a href="<?= base_url('logout'); ?>" class="ml-3"><i class="fas fa-sign-out-alt"></i> Logout</a></small>
					</div>
				</div>

				<!-- awal navigasi -->
				<?= $this->include('layout/navigasi'); ?>
				<!-- akhir navigasi -->
			</div>
		</aside>

		<!-- Content Wrapper = konten halaman -->
		<div class="content-wrapper">

			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><?= $pageTitle; ?></h1>
						</div>
						<div class="col-sm-6">
							<!-- <ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">sub navigasi</li>
							</ol> -->
						</div>
					</div>
				</div>
			</section>

			<!-- bagian awal konten -->
			<?= $this->renderSection('content') ?>
			<!-- bagian akhir konten -->

		</div>
		<!-- Content Wrapper = konten halaman -->

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block"> Version 3.1.0 </div>
			<span class="">Copyright &copy; <?= date("Y"); ?> <a href="#">Web Development</a>. All rights reserved.</span>
		</footer>

		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
	</div> <!-- end wrapper setelah body -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?= base_url() ?>/public/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
	<script src="<?= base_url() ?>/public/js/sweetalert2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url() ?>/public/js/dashboard.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<?= $this->renderSection('script') ?>

</body>

</html>