<div class="main-container" id="container">

    <div class="layout-px-spacing">
        <h3>
            Gestionar usuario | <a href="<?= site_url('user/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple">Editar usuario</h6>
                </div>
                <div class="widget-content widget-content-area">

                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("user/update"); ?>
                    <div class="row">
                        <div class="col-lg-3">
                            <label><?= translate("nombre_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="fullname" required value="<?= $user_object->name; ?>" placeholder="<?= translate('nombre_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= "Apellido" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="surname" required value="<?= $user_object->surname; ?>" placeholder="<?= "Apellido" ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= "Teléfono" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="phone" required value="<?= $user_object->phone; ?>" placeholder="<?= "Teléfono" ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("role_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <select class="form-control input-sm" name="role" id="role">
                                    <?php if ($this->session->userdata('role_id') == 1) { ?>
                                        <option value="1" selected>Super admin</option>
                                        <option value="2" <?php if (2 == $user_object->role_id) { ?>selected <?php } ?>>Administrador</option>
                                    <?php } else { ?>
                                        <option value="2" <?php if (2 == $user_object->role_id) { ?>selected <?php } ?>>Administrador</option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= "Dirección" ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="address" required value="<?= $user_object->address; ?>" placeholder="<?= "Dirección" ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("email_lang"); ?></label>
                            <div class="input-group">
                                <input disabled type="email" class="form-control input-sm" required name="email" value="<?= $user_object->email; ?>" placeholder="<?= translate('email_lang') ?>">
                                <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />
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