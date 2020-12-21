<!-- Banner Area -->
<div class="cleaning-mini-banner">
    <div class="d-table">
        <div class="d-tablecell">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Trabaja con nosotros</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="cleaning-breadcumb">
                            <a href="<?= site_url(); ?>">Inicio</a> / Trabaja con nosotros
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Banner Area -->

<!-- Start Main Content Area -->
<section class="cleaning-content-block checkout-form-area">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12">

                <div class="contact-form-area">

                    <div class="contact-info text-center">
                        <h2>Registrate en nuestra plataforma.</h2>
                        <p>Forma parte de la red de tecnicos para prestar servicios.</p>

                    </div>

                    <?= form_open('front/add_trabajador'); ?>
                    <div class="row">
                        <?= get_message_from_operation(); ?>

                        <h4 class="text-center">Datos Básicos</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="nombre" id="contact_name" placeholder="Nombres*" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="apellido" id="contact_apellido" placeholder="Apellidos*" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="cedula" id="contact_cedula" placeholder="Cédula*" required restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="ruc" id="contact_ruc" placeholder="RUC*" required restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <select id="sexo" name="sexo" style="height: 4.5rem;" class="form-control">
                                    <option>Sexo*</option>
                                    <option value=1>Masculino</option>
                                    <option value=0>Femenino</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <select id="cargas" name="cargas" style="height: 4.5rem;" class="form-control">
                                    <option>Carga Familiares*</option>
                                    <option value=1>Si</option>
                                    <option value=0>No</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <select id="conadis" name="conadis" style="height: 4.5rem;" class="form-control">
                                    <option>Conadis*</option>
                                    <option value=1>Si</option>
                                    <option value=0>No</option>

                                </select>
                            </div>
                        </div>
                        <h4 class="text-center">Datos de Contacto</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="celular" id="contact_celular" placeholder="Celular*" required restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="contact_phone" placeholder="Teléfono" restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <h4 class="text-center">Datos de Usuario</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="contact_email" placeholder="E-mail*" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="contact_password" placeholder="Password*" required>
                            </div>
                        </div>
                        <h4 class="text-center">Referencia Bancaria</h4>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="institucion" id="contact_institucion" placeholder="Institución Financiera*" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="nombre_dep" id="contact_nombre_dep" placeholder="Nombre a Depositar*" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="cuenta" id="contact_cuenta" placeholder="Número de Cuenta*" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <select id="tipo_cuenta" name="tipo_cuenta" style="height: 4.5rem;" class="form-control">
                                    <option>Tipo de Cuenta*</option>
                                    <option value=1>Ahorro</option>
                                    <option value=2>Corriente</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="cedula_b" id="contact_cedula_b" placeholder="Cédula/RUC*" required restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="phone_b" id="contact_phone_b" placeholder="Teléfono" restrict="A-Z\a-z\0-9">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="email_b" name="email_b" id="contact_email_b" placeholder="E-mail*" required>
                            </div>
                        </div>
                        <h4 class="text-center">Categoria de Servicios</h4>
                        <?php foreach ($categories as $category) { ?>

                            <div class="col-md-12">
                                <strong>
                                    <p style="color:#f8b604;" class="text-center"><?= $category->nombre; ?></p>
                                </strong>
                                <?php foreach ($category->subcategories as $subcategory) { ?>
                                    <div class="col-lg-3">
                                        <div class="checkbox">
                                            <label>
                                                <input id="subcategorias" name="subcategorias[]" type="checkbox" value="<?= $subcategory->subcategoria_id; ?>">

                                                <strong><?= $subcategory->nom_sub; ?></strong>
                                                <br>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } ?>


                    </div>

                    <div class="text-center">
                        <div id="contact_send_status"></div>
                        <input type="submit" class="sbmt-btn" value="Registrarse">
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Main Content Area -->



<!-- Start scroll to top feature -->
<a href="#" id="back-to-top" title="Back to Top">
    <i class="fa fa-long-arrow-up"></i>
</a>
<!-- End scroll to top feature -->