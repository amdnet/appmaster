<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<?= view('Myth\Auth\Views\_message_block') ?>
		
		<div class="card">	
			<div class="card-header">
				<h3><?=lang('Auth.register')?></h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>

			<div class="card-body">
				<form action="<?= base_url(route_to('register')) ?>" method="post">
					<?= csrf_field() ?>

					<div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
						<input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
					</div>

					<div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
					</div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
					</div>

                    <div class="form-group">
						<span class="float-left text-light"><?=lang('Auth.alreadyRegistered')?> <a class="text-warning" href="<?= base_url(route_to('login')) ?>"><?=lang('Auth.signIn')?></a></span>
					</div>

					<div class="form-group">
						<button type="submit" class="btn float-right login_btn"><?=lang('Auth.register')?></button>
					</div>
				</form>
			</div> <!-- card-body -->
		</div>
	</div>
</div>

<?= $this->endSection() ?>