<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item ">
            <a href="<?= base_url('home') ?>" class="nav-link <?= (current_url() == base_url('home')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard </p>
            </a>
        </li>

        <!-- data kategori -->
        <?php if (in_groups([1, 2])) : ?>
            <li class="nav-item <?= (current_url() == base_url('stall')) || (current_url() == base_url('mobil-jenis')) || (current_url() == base_url('mobil-merk')) || (current_url() == base_url('mobil-tipe')) ? 'menu-open' : '' ?> ">
                <a href="#" class="nav-link <?= (current_url() == base_url('stall')) || (current_url() == base_url('mobil-jenis')) || (current_url() == base_url('mobil-merk')) || (current_url() == base_url('mobil-tipe')) ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-th-list"></i>
                    <p>Data Kategori<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('stall'); ?>" class="nav-link <?= (current_url() == base_url('stall')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lokasi Stall</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('mobil-jenis'); ?>" class="nav-link <?= (current_url() == base_url('mobil-jenis')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis Mobil</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('mobil-merk'); ?>" class="nav-link <?= (current_url() == base_url('mobil-merk')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Merk Mobil</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('mobil-tipe'); ?>" class="nav-link <?= (current_url() == base_url('mobil-tipe')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tipe Mobil</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- data user -->
        <?php if (in_groups([1, 2])) : ?>
            <li class="nav-item <?= (current_url() == base_url('users')) || (current_url() == base_url('users/add')) || (current_url() == base_url('users/login')) ? 'menu-open' : '' ?> ">
                <a href="#" class="nav-link <?= (current_url() == base_url('users')) || (current_url() == base_url('users/login')) ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Data User<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('users/add'); ?>" class="nav-link <?= (current_url() == base_url('users/add')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users'); ?>" class="nav-link <?= (current_url() == base_url('users')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users/login'); ?>" class="nav-link <?= (current_url() == base_url('users/login')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Info Login</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- data service progress -->
        <?php if (in_groups([1, 2])) : ?>
            <li class="nav-item <?= (current_url() == base_url('service')) || (current_url() == base_url('service/add')) || (current_url() == base_url('service/detail/')) ? 'menu-open' : '' ?> ">
                <a href="#" class="nav-link <?= (current_url() == base_url('service')) || (current_url() == base_url('service/add')) ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>Data service<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url('service'); ?>" class="nav-link <?= (current_url() == base_url('service')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List Service</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('service/add'); ?>" class="nav-link <?= (current_url() == base_url('service/add')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tambah Service</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('users/login'); ?>" class="nav-link <?= (current_url() == base_url('users/login')) ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Info Login</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- profil user -->
        <li class="nav-item">
            <a href="<?= base_url('users/profil/' . user()->id); ?>" class="nav-link <?= (current_url() == base_url('users/profil/' . user()->id)) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>Profil</p>
            </a>
        </li>

        <?php if (in_groups(1)) : ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Dokumentasi<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="https://adminlte.io/docs/3.1/" target="_blank" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin LTE 3.1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://adminlte.io/themes/v3/index3.html" target="_blank" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Admin LTE Demo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>BootStrap 4</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free" target="_blank" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>FontAwesome 5</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>