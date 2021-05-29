<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('management_carguera_lang') ?> | <a href="<?= site_url('carguera/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('add_carguera_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("carguera/add"); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label><?= translate("name_carguera_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input autocomplete="off" type="text" class="form-control input-sm" name="name" placeholder="<?= translate('name_carguera_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("person_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input autocomplete="off" type="text" class="form-control input-sm" name="person" placeholder="<?= translate('person_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("phone_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input autocomplete="off" type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("email_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input autocomplete="off" type="text" class="form-control input-sm" name="email" placeholder="<?= translate('email_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("direccion_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input autocomplete="off" type="text" class="form-control input-sm" name="address" placeholder="<?= translate('direccion_lang'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="text-align: right;">
                            <br>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                        </div>
                    </div>
                    <?= form_close(); ?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->