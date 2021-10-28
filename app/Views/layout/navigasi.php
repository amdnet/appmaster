<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item ">
            <a href="<?= base_url('home') ?>" class="nav-link <?= (current_url() == base_url('home')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard </p>
            </a>
        </li>

        <!-- data kategori -->
        <li class="nav-item <?= (current_url() == base_url('stall')) || (current_url() == base_url('mobil')) ? 'menu-open' : '' ?> ">
            <a href="#" class="nav-link <?= (current_url() == base_url('stall')) || (current_url() == base_url('mobil')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-th-list"></i>
                <p>Data Kategori<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('stall'); ?>" class="nav-link <?= (current_url() == base_url('stall')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori Stall</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('mobil'); ?>" class="nav-link <?= (current_url() == base_url('mobil')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kategori Mobil</p>
                    </a>
                </li>
            </ul>
        </li>

        <!-- data user -->
        <li class="nav-item <?= (current_url() == base_url('users')) || (current_url() == base_url('users/add')) || (current_url() == base_url('users/login')) || (current_url() == base_url('users/profil')) ? 'menu-open' : '' ?> ">
            <a href="#" class="nav-link <?= (current_url() == base_url('users')) || (current_url() == base_url('users/login')) || (current_url() == base_url('users/profil')) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user-circle"></i>
                <p>Data User<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= base_url('users'); ?>" class="nav-link <?= (current_url() == base_url('users')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('users/add'); ?>" class="nav-link <?= (current_url() == base_url('users/add')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User Add</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('users/login'); ?>" class="nav-link <?= (current_url() == base_url('users/login')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User Login</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('users/profil'); ?>" class="nav-link <?= (current_url() == base_url('users/profil')) ? 'active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User Profil</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Dokumentasi<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1/" target="_blank" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin LTE</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>BootStrap 5</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://fontawesome.com/v5.15/icons" target="_blank" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>FontAwesome 5</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>