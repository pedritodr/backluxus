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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-flower2">
                                    <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4zm3-12c0 .073-.01.155-.03.247-.544.241-1.091.638-1.598 1.084A2.987 2.987 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1.117 1.117 0 0 1 5 4a3 3 0 0 1 6 0zm-.812 6.052A2.99 2.99 0 0 0 11 8a2.99 2.99 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a6.833 6.833 0 0 1-.647-.487zm-3.56.617a3.001 3.001 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084.02.091.03.174.03.247a3 3 0 1 1-6 0c0-.073.01-.155.03-.247.544-.242 1.091-.638 1.598-1.084zm-.816-4.721A2.99 2.99 0 0 0 5 8c0 .794.308 1.516.812 2.052a6.83 6.83 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu">
                                    <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                    <rect x="9" y="9" width="6" height="6"></rect>
                                    <line x1="9" y1="1" x2="9" y2="4"></line>
                                    <line x1="15" y1="1" x2="15" y2="4"></line>
                                    <line x1="9" y1="20" x2="9" y2="23"></line>
                                    <line x1="15" y1="20" x2="15" y2="23"></line>
                                    <line x1="20" y1="9" x2="23" y2="9"></line>
                                    <line x1="20" y1="14" x2="23" y2="14"></line>
                                    <line x1="1" y1="9" x2="4" y2="9"></line>
                                    <line x1="1" y1="14" x2="4" y2="14"></line>
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

            <!--    <div class="submenu" id="pages">
                <div class="category-info">
                    <h5>Pages</h5>
                    <p>Lorem ipsum dolor sit amet sed incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#pages">
                    <li>
                        <a href="pages_helpdesk.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Helpdesk </a>
                    </li>
                    <li>
                        <a href="pages_contact_us.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Contact Form </a>
                    </li>
                    <li>
                        <a href="pages_faq.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> FAQ </a>
                    </li>
                    <li>
                        <a href="pages_faq2.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> FAQ 2 </a>
                    </li>
                    <li>
                        <a href="pages_privacy.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Privacy Policy </a>
                    </li>
                    <li>
                        <a href="pages_coming_soon.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Coming Soon </a>
                    </li>
                    <li class="sub-submenu">
                        <a role="menu" class="collapsed" data-toggle="collapse" data-target="#error" aria-expanded="false">
                            <div><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg></span> Error</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                        <ul id="error" class="collapse" data-parent="#compact_submenuSidebar">
                            <li>
                                <a href="pages_error404.html"> 404 </a>
                            </li>
                            <li>
                                <a href="pages_error500.html"> 500 </a>
                            </li>
                            <li>
                                <a href="pages_error503.html"> 503 </a>
                            </li>
                            <li>
                                <a href="pages_maintenence.html"> Maintanence </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="submenu" id="more">
                <div class="category-info">
                    <h5>Extra Elements</h5>
                    <p>Lorem ipsum dolor sit amet sed incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <ul class="submenu-list" data-parent-element="#more">

                    <li class="sub-submenu">
                        <a role="menu" class="collapsed" data-toggle="collapse" data-target="#auth" aria-expanded="false">
                            <div> <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg></span> Authentication</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                        <ul id="auth" class="collapse" data-parent="#compact_submenuSidebar">
                            <li>
                                <a href="auth_login.html"> Login </a>
                            </li>
                            <li>
                                <a href="auth_login_boxed.html"> Login Boxed </a>
                            </li>
                            <li>
                                <a href="auth_register.html"> Register </a>
                            </li>
                            <li>
                                <a href="auth_register_boxed.html"> Register Boxed </a>
                            </li>
                            <li>
                                <a href="auth_lockscreen.html"> Unlock </a>
                            </li>
                            <li>
                                <a href="auth_lockscreen_boxed.html"> Unlock Boxed </a>
                            </li>
                            <li>
                                <a href="auth_pass_recovery.html"> Recover ID </a>
                            </li>
                            <li>
                                <a href="auth_pass_recovery_boxed.html"> Recover ID Boxed </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="dragndrop_dragula.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Drag and Drop </a>
                    </li>
                    <li>
                        <a href="charts_apex.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Charts </a>
                    </li>
                    <li>
                        <a href="map_jvector.html"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg></span> Maps </a>
                    </li>
                    <li class="sub-submenu">
                        <a role="menu" class="collapsed" data-toggle="collapse" data-target="#starter-kit" aria-expanded="false">
                            <div><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg></span> Starter Kit</div> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                        <ul id="starter-kit" class="collapse" data-parent="#compact_submenuSidebar">
                            <li>
                                <a href="starter_kit_blank_page.html"> Blank Page </a>
                            </li>
                            <li>
                                <a href="starter_kit_breadcrumb.html"> Breadcrumb </a>
                            </li>
                            <li>
                                <a href="starter_kit_boxed.html"> Boxed </a>
                            </li>
                        </ul>

                </ul>
            </div> -->

        </div>

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">