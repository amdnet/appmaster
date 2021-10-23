<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
	<title><?= $pageTitle; ?></title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/css/bootstrap-4.min.css">

	<style>
		.content-header h1 {
			font-size: 1.5rem !important;
		}

		button.dt-button,
		div.dt-button,
		a.dt-button,
		input.dt-button {
			margin-right: 0;
			margin-bottom: 0.5em;
			padding: 0.4em 0.9em !important;
			border-radius: 3px !important;
			font-size: 0.83em !important
		}

		div.dt-buttons {
			margin-right: 20px;
		}

		.dataTables_wrapper label:not(.form-check-label):not(.custom-file-label) {
			font-weight: normal;
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button {
			padding: .3em .9em;
			margin-top: 7px;
			margin-left: 2px;
			border: 1px solid #aaa;
			border-radius: 3px;
		}
	</style>
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
			<a href="index3.html" class="brand-link">
				<img src="<?= base_url() ?>/public/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">AdminLTE 3</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image pt-2">
						<img src="<?= base_url() ?>/public/img/user2-160x160.jpg" class="img-circle elevation-2">
					</div>

					<div class="info">
						<span class="d-block text-white"> hi, <?= user()->username; ?> </span>
						<small><a href="<?= base_url('user/profil'); ?>" class="<?= (current_url() == base_url('user/profil')) ? 'text-warning' : '' ?>"><i class="far fa-user-circle"></i> Profil</a> <a href="<?= base_url('logout'); ?>" class="ml-3"><i class="fas fa-sign-out-alt"></i> Logout</a></small>
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
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">DataTables</li>
							</ol>
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
			<span class="">Copyright &copy; <?= date("Y"); ?> <a href="#">AdminLTE.io</a>. All rights reserved.</span>
		</footer>

		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
	</div> <!-- end wrapper setelah body -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="<?= base_url() ?>/public/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>

	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

	<script src="<?= base_url() ?>/public/js/sweetalert2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url() ?>/public/js/dashboard.js"></script>

	<?= $this->renderSection('script') ?>

</body>

</html>