<style>
    .dropdown-toggle::after {
        display: none;
        /* Menyembunyikan panah bawaan */
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
    }

    .dropdown-toggle .material-icons {
        margin-left: 5px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white ">
    <div class="container-fluid mx-3">

        <a class="navbar-brand fw-bold" href="#" style="color: #012970;">Bank Data Centre</a>

        <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse fw-semibold">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Activity</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('manajemen') ?>">Manajemen User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('data_prospek') ?>">Data Prospek</a>
                </li>
            </ul>

            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?php echo $this->session->userdata('users')['nama_karyawan']; ?>
                        <i class="material-icons">keyboard_arrow_down</i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm fw-semibold" aria-labelledby="navbarDropdownMenuLink" style="transition: all 0.5s ease;">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item fw-semibold text-danger" href="<?= base_url('auth/logout') ?>" style="display: flex; align-items: center;">
                                <span class="material-symbols-outlined mx-1" style="font-size: 1.3rem;">
                                    logout
                                </span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

    </div>
</nav>