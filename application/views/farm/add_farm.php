<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_farms_lang') ?> | <a href="<?= site_url('farm/index/' . $provider_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('add_farm_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/add_farm"); ?>
                    <div class="row">

                        <div class="col-lg-6">
                            <label><?= translate("name_legal_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="name_legal" required placeholder="<?= translate('name_legal_lang'); ?>">
                                <input type="hidden" name="provider_id" value="<?= $provider_id ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("name_commercial_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="name_commercial" required placeholder="<?= translate('name_commercial_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_farm_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="address_farm" required placeholder="<?= translate('address_farm_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_oficce_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="address_office" required placeholder="<?= translate('address_oficce_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("hectare_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="hectare" required placeholder="<?= translate('hectare_lang'); ?>">
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