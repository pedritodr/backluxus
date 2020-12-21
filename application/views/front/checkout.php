<div id="content">
    <div class="content-page woocommerce">
        <div class="container content-about ">
            <h2 class="title30 dosis-font font-bold text-uppercase text-center dark">Pedido Final</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="register-content-box">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-billing">
                                    <div class="form-my-account">
                                        <form class="block-login" action="<?= site_url('login/auth'); ?>" method="post">
                                            <h2 class="title24 title-form-account">Datos del Cliente</h2>
                                            <p>
                                                <label>Nombre <span class="required">*</span></label>
                                                <input type="text" name="name" />
                                            </p>
                                            <p>
                                                <label>Apellido <span class="required">*</span></label>
                                                <input type="text" name="surname" />
                                            </p>
                                            <p>
                                                <label>Direccion <span class="required">*</span></label>
                                                <input type="text" name="address" />
                                            </p>
                                            <p>
                                                <label>Telefono<span class="required">*</span></label>
                                                <input type="text" name="phone" />
                                            </p>
                                            <p>
                                                <label>E-mail<span class="required">*</span></label>
                                                <input type="text" name="email" />
                                            </p>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-address">
                                    <div class="form-my-account check-register text-center">
                                        <h2 class="title24 title-form-account">Tu Orden </h2>
                                        <p class="desc">
                                            Registrarse en este sitio le permite acceder al estado e historial de sus pedidos. Simplemente complete los campos a continuación, y obtendremos una nueva cuenta configurada para usted en poco tiempo. Solo le pediremos la información necesaria para que el proceso de compra sea más rápido y fácil.</p>
                                        <a href="#" class="shop-button bg-color login-to-register" data-login="Iniciar sesión" data-register="Registrarme">Finalizar Pedido</a>
                                        <!--  <p class="desc title12 silver"><i>Haga clic para cambiar Registrarse / Iniciar sesión</i></p> -->
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