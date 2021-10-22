<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?php session()->set('redirect_url', base_url(route_to('home'))); ?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<?= view('Myth\Auth\Views\_message_block') ?>
		
		<div class="card">	
			<div class="card-header">
				<h3><?=lang('Auth.loginTitle')?></h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>

			<div class="card-body">
				<form action="<?= base_url(route_to('login')) ?>" method="post">
					<?= csrf_field() ?>

					<?php if ($config->validFields === ['email']): ?>
					<div class="form-group">
						<label for="login"><?=lang('Auth.email')?></label>
						<input type="email" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
								name="login" placeholder="<?=lang('Auth.email')?>">
						<div class="invalid-feedback">
							<?= session('errors.login') ?>
						</div>
					</div>
					<?php else: ?>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
							name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
						<div class="invalid-feedback">
						</div>
					</div>
					<?php endif; ?>

					<div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
						<div class="invalid-feedback">
						</div>
					</div>

					<?php if ($config->allowRemembering): ?>
					<div class="form-check">
						<label class="form-check-label text-light">
							<input type="checkbox" name="remember" class="form-check-input" <?php if(old('remember')) : ?> checked <?php endif ?>>
							<?=lang('Auth.rememberMe')?>
						</label>
					</div>
					<?php endif; ?>

					<div class="form-group">
						<button type="submit" class="btn float-right login_btn"><?=lang('Auth.loginAction')?></button>
					</div>
				</form>
			</div> <!-- card-body -->
				
			<div class="card-footer">					
				<?php if ($config->allowRegistration) : ?>
				<div class="d-flex justify-content-center links">
					<a class="text-warning" href="<?= base_url(route_to('register')) ?>"><?=lang('Auth.needAnAccount')?></a>
				</div>
				<?php endif; ?>
				
				<?php if ($config->activeResetter): ?>
				<div class="d-flex justify-content-center">
					<a class="text-warning" href="<?= base_url(route_to('forgot')) ?>"><?=lang('Auth.forgotYourPassword')?></a>
				</div>
				<?php endif; ?>						
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>