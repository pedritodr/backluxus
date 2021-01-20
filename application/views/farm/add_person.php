<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_personal_lang') ?> | <a href="<?= site_url('farm/index_personal/' . $farm_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('add_person_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/add_persona"); ?>
                    <div class="row">

                        <div class="col-lg-6">
                            <label><?= translate("nombre_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('nombre_lang'); ?>">
                                <input type="hidden" name="farm_id" value="<?= $farm_id ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("phone_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="phone" required placeholder="<?= translate('phone_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("skype_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="skype"  placeholder="<?= translate('skype_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("whatsapp_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="whatsapp"  placeholder="<?= translate('whatsapp_lang'); ?>">
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