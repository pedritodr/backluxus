<!-- End Header -->
<div id="content">
    <div class="content-page woocommerce">
        <div class="container content-about ">
            <h2 class="title30 dosis-font font-bold text-uppercase text-center dark">Miembro</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="register-content-box">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-billing">
                                    <div class="form-my-account">
                                        <form class="block-login" action="<?= site_url('login/auth'); ?>" method="post">
                                            <h2 class="title24 title-form-account">Iniciar sesión</h2>
                                            <?= get_message_from_operation(); ?>
                                            <p>
                                                <label>E-mail<span class="required">*</span></label>
                                                <input type="text" name="email" />
                                            </p>
                                            <p>
                                                <label>Contraseña <span class="required">*</span></label>
                                                <input type="password" name="password" />
                                            </p>
                                            <p>
                                                <input type="submit" class="register-button" name="login" value="Entrar">
                                            </p>
                                            <div class="table create-account">

                                                <div class="text-right">
                                                    <a href="#" onclick="modal_recuperar();" class="color">¿recuperar tu contraseña?</a>
                                                </div>
                                            </div>
                                            <!--  <h2 class="title18 social-login-title">Or login with</h2>
                                            <div class="social-login-block table text-center">
                                                <div class="social-login-btn">
                                                    <a href="#" class="login-fb-link">Facebook</a>
                                                </div>
                                                <div class="social-login-btn">
                                                    <a href="#" class="login-goo-link">Google</a>
                                                </div>
                                            </div> -->
                                        </form>
                                        <form class="block-register" action="<?= site_url('front/add'); ?>" method="post">
                                            <?= get_message_from_operation(); ?>
                                            <h2 class="title24 title-form-account">Registrarme</h2>
                                            <p>
                                                <label>Nombre <span class="required">*</span></label>
                                                <input type="text" name="name" />
                                            </p>
                                            <p>
                                                <label>Apellido <span class="required">*</span></label>
                                                <input type="text" name="surname" />
                                            </p>
                                            <p>
                                                <label>E-mail <span class="required">*</span></label>
                                                <input type="text" name="email" />
                                            </p>
                                            <p>
                                                <label>Contraseña <span class="required">*</span></label>
                                                <input type="password" name="password" />
                                            </p>
                                            <p>
                                                <input type="submit" class="register-button" name="register" value="Registrarme">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-address">
                                    <div class="form-my-account check-register text-center">
                                        <h2 class="title24 title-form-account">Registrarme</h2>
                                        <p class="desc">
                                            Registrarse en este sitio le permite acceder al estado e historial de sus pedidos. Simplemente complete los campos a continuación, y obtendremos una nueva cuenta configurada para usted en poco tiempo. Solo le pediremos la información necesaria para que el proceso de compra sea más rápido y fácil.</p>
                                        <a href="#" class="shop-button bg-color login-to-register" data-login="Iniciar sesión" data-register="Registrarme">Registrarme</a>
                                        <p class="desc title12 silver"><i>Haga clic para cambiar Registrarse / Iniciar sesión</i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Page -->
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open("login/recover_password") ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Recuper contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" class="form-control" name="email" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info">Recuperar contraseña</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function modal_recuperar() {
        $("#myModal").modal('show');
    }
</script>
<!-- End Content -->