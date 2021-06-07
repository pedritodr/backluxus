<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_areoline_lang') ?> | <a href="<?= site_url('aeroline/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"><?= translate('edit_aeroline_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("aeroline/update"); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="hidden" name="aeroline_id" value="<?= $object->aeroline_id; ?>" />
                                        <input type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('nombre_lang'); ?>" value="<?= $object->name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("code_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="text" class="form-control input-sm" name="code" placeholder="<?= translate('code_lang'); ?>" value="<?= $object->code ?>" maxlength="3">
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