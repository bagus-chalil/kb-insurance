<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url() ?>" class="app-brand-link">
            <span class="app-brand-logo demo"></span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">KB Insurance</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <?php
    $current_url = current_url();
    ?>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?= strpos($current_url, base_url('dashboard')) !== false ? 'active open' : '' ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Assurance -->
        <li class="menu-item <?= (strpos($current_url, base_url('assurance')) !== false) ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div class="text-truncate" data-i18n="Assurance">Assurance</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?= strpos($current_url, base_url('assurance/form')) !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('assurance/form') ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="Form">Form</div>
                    </a>
                </li>
                <li class="menu-item <?= strpos($current_url, base_url('assurance/list')) !== false ? 'active' : '' ?>">
                    <a href="<?= base_url('assurance/list') ?>" class="menu-link">
                        <div class="text-truncate" data-i18n="List">List</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Documentation -->
        <li class="menu-item">
            <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div class="text-truncate" data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>
</aside>
