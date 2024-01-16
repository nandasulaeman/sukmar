<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="<?= base_url('/') ?>"><img src="<?= base_url('./assets/compiled/svg/logo.svg') ?>" alt="Logo"
                        srcset="" /></a>
            </div>
            <div class="sidebar-toggler x">
                <a class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <!-- Management Pasar -->
            <li
                class="sidebar-item has-sub <?= (strpos(current_url(), base_url('/markets')) !== false || strpos(current_url(), base_url('/markets_floor')) !== false || current_url() == base_url('')) ? 'active' : ''; ?>">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-shop"></i>
                    <span>Management Pasar</span>
                </a>
                <ul class="submenu">
                    <li
                        class="submenu-item <?= (current_url() == base_url('/markets') || strpos(current_url(), base_url('/markets/')) !== false) ? 'active' : ''; ?>">
                        <a href="<?= base_url('/markets') ?>">Data Pasar</a>
                    </li>
                    <li
                        class="submenu-item <?= (current_url() == base_url('/markets_floor') || strpos(current_url(), base_url('/markets_floor/')) !== false) ? 'active' : ''; ?>">
                        <a href="<?= base_url('/markets_floor') ?>">Data Denah</a>
                    </li>
                </ul>
            </li>

            <!-- Management Produk -->
            <li
                class="sidebar-item has-sub <?= (strpos(current_url(), base_url('/products')) !== false || strpos(current_url(), base_url('/products_floor')) !== false || strpos(current_url(), base_url('/products_varian')) !== false) ? 'active' : ''; ?>">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-bag-fill"></i>
                    <span>Management Produk</span>
                </a>
                <ul class="submenu">
                    <li
                        class="submenu-item <?= (current_url() == base_url('/products') || strpos(current_url(), base_url('/products/')) !== false) ? 'active' : ''; ?>">
                        <a href="<?= base_url('/products') ?>">Data Produk</a>
                    </li>
                    <li
                        class="submenu-item <?= (current_url() == base_url('/products_floor') || strpos(current_url(), base_url('/products_floor/')) !== false) ? 'active' : ''; ?>">
                        <a href="<?= base_url('/products_floor') ?>">Data Denah Produk</a>
                    </li>
                    <li
                        class="submenu-item <?= (current_url() == base_url('/products_varian') || strpos(current_url(), base_url('/products_varian/')) !== false) ? 'active' : ''; ?>">
                        <a href="<?= base_url('/products_varian') ?>">Data Varian Produk</a>
                    </li>
                </ul>
            </li>

            <!-- Management User -->
            <li class="sidebar-item <?= (current_url() == base_url('index.html')) ? 'active' : ''; ?>">
                <a href="<?= base_url('index.html') ?>" class="sidebar-link">
                    <i class="bi bi-people"></i>
                    <span>Management User</span>
                </a>
            </li>
        </ul>

    </div>
</div>