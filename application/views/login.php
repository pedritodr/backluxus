<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from designreset.com/cork/ltr/demo10/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Dec 2020 17:05:46 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <title>Admin Template - Login</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('admin_template/assets/img/favicon.ico') ?>" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap')?>" rel="stylesheet" />
    <link href="<?= base_url('admin_template/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css') ?>" />
    <link href="<?= base_url('admin_template/assets/css/plugins.css" rel="stylesheet" type="text/css') ?>" />
    <link href="<?= base_url('admin_template/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css') ?>" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('admin_template/assets/css/forms/theme-checkbox-radio.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('admin_template/assets/css/forms/switches.css') ?>" />
</head>

<body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">
                            Iniciar sesión en
                            <a href="index.html"><span class="brand-name">Luxus</span></a>
                        </h1>
                        <!--   <p class="signup-link">
                            New Here? <a href="auth_register.html">Create an account</a>
                        </p> -->
                        <form class="text-center" method="">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Email" />
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" />
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Mostrar contraseñas</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none" />
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">

                                        <a href="javascript:void(0);" onclick="login()" id="btnIniciar" class="btn btn-primary btn-md mb-3 mr-3">
                                            <div style="display:none" id="spinnerLogin" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                                            <span id="spanInicia">Iniciar sesión</span>
                                        </a>
                                        <!--   <button type="submit" class="btn btn-primary" value="">

                                        </button> -->
                                    </div>
                                </div>

                                <div class="field-wrapper">
                                    <a href="javascript:void(0);" class="forgot-pass-link">¿Recuperar contraseña?</a>
                                </div>
                            </div>
                        </form>
                        <p class="terms-conditions">
                            © <?= date('Y') ?> Todos los derechos reservados. <a href="index.html">Luxus</a>
                            <!--     <a href="javascript:void(0);">Cookie Preferences</a>,
                <a href="javascript:void(0);">Privacy</a>, and
                <a href="javascript:void(0);">Terms</a>. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="form-image">
            <div class="l-image"></div>
        </div> -->
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url('admin_template/assets/js/libs/jquery-3.1.1.min.js') ?>"></script>
    <script src="<?= base_url('admin_template/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('admin_template/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('admin_template/plugins/sweetalerts/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('admin_template/plugins/sweetalerts/custom-sweetalert.js') ?>"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url('admin_template/assets/js/authentication/form-1.js') ?>"></script>
    <script>
        const login = () => {
            let username = $('#username').val().trim();
            let password = $('#password').val().trim();
            if (username == "") {
                swal({
                    title: '¡Error!',
                    text: "El campo usuario es requerido",
                    padding: '2em'
                });
                $('#spinnerLogin').hide();
                $('#spanInicia').text('Iniciar sesión');
            } else if (password == "") {
                swal({
                    title: '¡Error!',
                    text: "El campo contraseña es requerido",
                    padding: '2em'
                });
                $('#spinnerLogin').hide();
                $('#spanInicia').text('Iniciar sesión');
            } else {
                $('#spinnerLogin').show();
                $('#spanInicia').text('iniciando');
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('login/auth') ?>",
                        data: {
                            email: username,
                            password: password
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    padding: '2em'
                                });

                                toast({
                                    type: 'success',
                                    title: '¡Correcto!',
                                    padding: '2em',
                                })
                                $('#spinnerLogin').hide();
                                $('#spanInicia').text('Iniciar sesión');
                                window.location = '<?= site_url('dashboard/index') ?>';
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                $('#spinnerLogin').hide();
                                $('#spanInicia').text('Iniciar sesión');
                            }

                        }
                    });
                }, 1500)
            }
        }
        $(document).keypress(function(e) {
            if (e.which == 13) {
                login();
            }
        });
    </script>


</body>

<!-- Mirrored from designreset.com/cork/ltr/demo10/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Dec 2020 17:05:46 GMT -->

</html>