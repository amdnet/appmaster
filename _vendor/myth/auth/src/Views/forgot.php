<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<?= view('Myth\Auth\Views\_message_block') ?>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fab fa-twitter-square"></i></span>
                </div>
            </div>

            <div class="card-body">
                <h3 class="text-light"><?=lang('Auth.forgotPassword')?></h3>
                <span class="text-light"><?=lang('Auth.enterEmailForInstructions')?></span>

                <form action="<?= base_url(route_to('forgot')) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group form-group mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>">
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-block"><?=lang('Auth.sendInstructions')?></button>
                    </div>
                </form>
            </div>

            <div class="card-footer">					
                <div class="d-flex justify-content-center">
                    <span class="float-left text-light"><?=lang('Auth.alreadyRegistered')?> <a class="text-warning" href="<?= base_url(route_to('login')) ?>"><?=lang('Auth.signIn')?></a></span>
                </div>

                <?php if ($config->allowRegistration) : ?>
                <div class="d-flex justify-content-center links">
                    <a class="text-warning" href="<?= base_url(route_to('register')) ?>"><?=lang('Auth.needAnAccount')?></a>
                </div>
                <?php endif; ?>		
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
