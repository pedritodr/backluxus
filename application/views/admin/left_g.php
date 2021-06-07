<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="compactSidebar">

            <div class="theme-logo">
                <a href="<?= site_url('dashboard/index') ?>">
                    <img src="<?= base_url('admin_template/assets/img/logo.svg') ?>" class="navbar-logo" alt="logo">
                </a>
            </div>

            <ul class="menu-categories">
                <li class="menu active">
                    <a href="#dashboard" data-active="true" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span>Empresa</span></div>
                </li>

                <li class="menu">
                    <a href="#app" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-aperture">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="14.31" y1="8" x2="20.05" y2="17.94"></line>
                                    <line x1="9.69" y1="8" x2="21.17" y2="8"></line>
                                    <line x1="7.38" y1="12" x2="13.12" y2="2.06"></line>
                                    <line x1="9.69" y1="16" x2="3.95" y2="6.06"></line>
                                    <line x1="14.31" y1="16" x2="2.83" y2="16"></line>
                                    <line x1="16.62" y1="12" x2="10.88" y2="21.94"></line>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span>Variedades</span></div>
                </li>
                <li class="menu">
                    <a href="#farms" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack">
                                    <path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z">
                                    </path>
                                    <path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z">
                                    </path>
                                    <path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z">
                                    </path>
                                    <path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path>
                                    <path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z">
                                    </path>
                                    <path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z">
                                    </path>
                                    <path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z">
                                    </path>
                                    <path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span><?= translate('manage_farms_lang') ?></span></div>
                </li>
                <li class="menu">
                    <a href="#users" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span>Usuarios</span></div>
                </li>
                <li class="menu">
                    <a href="#invoice_farm" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span><?= translate('manage_invoice_farms_lang') ?></span></div>
                </li>
                <!--   <li class="menu">
                    <a href="#pages" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span>Pages</span></div>
                </li>

                <li class="menu">
                    <a href="#more" data-active="false" class="menu-toggle">
                        <div class="base-menu">
                            <div class="base-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="tooltip"><span>Extra Elements</span></div>
                </li> -->
            </ul>
            <!--
            <div class="external-links">
                <a href="https://designreset.com/cork/documentation/index.html" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    <div class="tooltip"><span>Documentation</span></div>
                </a>
            </div> -->
        </nav>

        <div id="compact_submenuSidebar" class="submenu-sidebar">

            <div class="theme-brand-name">
                <a href="<?= site_url('dashboard/index') ?>">LUXUS</a>
            </div>

            <div class="submenu" id="dashboard">
                <div class="category-info">
                    <h5>Empresa</h5>
                    <p>Gestión para los datos de la empresa.</p>
                </div>

                <ul class="submenu-list" data-parent-element="#dashboard">
                    <li>
                        <a href="<?= site_url('empresa/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Empresa</a>
                    </li>
                    <li>
                        <a href="<?= site_url('box/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar tipo cajas</a>
                    </li>
                    <li>
                        <a href="<?= site_url('country/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar paises de entrega</a>
                    </li>
                    <li>
                        <a href="<?= site_url('rol/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span><?= translate('manage_roles_lang') ?></a>
                    </li>
                    <li>
                        <a href="<?= site_url('reason_credit/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span><?= translate('manage_reason_credit_lang') ?></a>
                    </li>
                    <li>
                        <a href="<?= site_url('carguera/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span><?= translate('manage_carguera_lang') ?></a>
                    </li>
                    <li>
                        <a href="<?= site_url('aeroline/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span><?= translate('management_areoline_lang') ?></a>
                    </li>
                </ul>
            </div>

            <div class="submenu" id="app">
                <div class="category-info">
                    <h5>Variedades</h5>
                    <p>Gestiona las variedades, categorias en la plataforma.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#app">
                    <li>
                        <a href="<?= site_url('categoria/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar categorias</a>
                    </li>
                    <li>
                        <a href="<?= site_url('measure/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar medidas/pesos</a>
                    </li>
                    <li>
                        <a href="<?= site_url('color/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar colores</a>
                    </li>
                    <li>
                        <a href="<?= site_url('bouquet/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar bouquets</a>
                    </li>
                    <li>
                        <a href="<?= site_url('type/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar tipos</a>
                    </li>
                    <li>
                        <a href="<?= site_url('product/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span>Gestionar variedades</a>
                    </li>

                </ul>
            </div>
            <div class="submenu" id="farms">
                <div class="category-info">
                    <h5>Fincas</h5>
                    <p>Gestión para las fincas.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#farms">
                    <li>
                        <a href="<?= site_url('farm/index_provider') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_farms_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('farm/index_balance') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('balance_farm_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('farm/index_payments') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_payment_farm_lang') ?> </a>
                    </li>
                    <!--  <li>
                        <a href="widgets.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Widgets </a>
                    </li> -->
                </ul>
            </div>
            <div class="submenu" id="users">
                <div class="category-info">
                    <h5>Usuarios</h5>
                    <p>Gestión de usuarios en la plataforma.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#users">
                    <li>
                        <a href="<?= site_url('user/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Gestionar usuario </a>
                    </li>
                    <li>
                        <a href="<?= site_url('user/index_client') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_clients_lang') ?> </a>
                    </li>
                    <!--   <li>
                        <a href="user_account_setting.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Account Settings </a>
                    </li>
                    <li>
                        <a href="fonticons.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Font Icons </a>
                    </li>
                    <li>
                        <a href="widgets.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Widgets </a>
                    </li> -->
                </ul>
            </div>
            <div class="submenu" id="invoice_farm">
                <div class="category-info">
                    <h5>Facturas</h5>
                    <p>Gestión de facturas de fincas y clientes en la plataforma.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#invoice_farm">
                    <li>
                        <a href="<?= site_url('invoice_farm/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_invoice_farms_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('invoice_farm/index_wait') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('invoice_wait_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('invoice_farm/index_invoice_client') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('invoice_client_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('invoice_farm/index_invoice_client_send') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('List_invoice_send_client_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('credit/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_credit_lang') ?> </a>
                    </li>
                    <li>
                        <a href="<?= site_url('fixed_orders/index') ?>"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> <?= translate('manage_fixed_orders_lang') ?> </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">