<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_farms_lang') ?> | <a href="<?= site_url('farm/index_provider'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('update_provider_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/update_provider"); ?>
                    <div class="row">
                        <input type="hidden" name="provider_id" value="<?= $provider_obj->provider_id ?>">
                        <div class="col-lg-6">
                            <label><?= translate("owner_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="owner" value="<?= $provider_obj->owner ?>" required placeholder="<?= translate('owner_lang'); ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label><?= translate("days_credit_lang"); ?></label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control input-sm" name="days" value="<?= $provider_obj->days_credit ?>" required placeholder="<?= translate('days_credit_lang'); ?>">
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