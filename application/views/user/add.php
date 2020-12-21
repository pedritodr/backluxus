<div class="main-container" id="container">

    <div class="layout-px-spacing">
        <h3>
            Gestionar usuario | <a href="<?= site_url('user/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple">Agregar usuario</h6>
                </div>
                <div class="widget-content widget-content-area">

                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("user/add"); ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <label><?= translate("nombre_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="fullname" required placeholder="<?= translate('nombre_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= "Apellido" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="surname" required placeholder="<?= "Apellido" ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= "Teléfono" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="phone" required placeholder="<?= "Teléfono" ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("role_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <select id="role" name="role" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="2">Administrador</option>
                                    <option value="3">Cliente</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= "Dirección" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="address" required placeholder="<?= "Dirección" ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("email_lang"); ?></label>
                            <div class="input-group">
                                <input type="email" class="form-control input-sm" required name="email" placeholder="<?= translate('email_lang') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("password_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-sm" name="password" required placeholder="<?= translate('password_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("repeat_password_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-sm" name="repeat_password" required placeholder="<?= translate('repeat_password_lang'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12" style="text-align: right;margin-top:4%">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                    </div>

                    <?= form_close(); ?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->