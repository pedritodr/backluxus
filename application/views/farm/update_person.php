<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_personal_lang') ?> | <a href="<?= site_url('farm/index_personal/' .$provider_id.'/'. $person_object->farm_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('update_person_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/update_persona"); ?>
                    <div class="row">

                        <div class="col-lg-6">
                            <label><?= translate("nombre_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('nombre_lang'); ?>" value="<?= $person_object->name ?>">
                                <input type="hidden" name="person_id" value="<?= $person_object->person_id ?>">
                                <input type="hidden" name="farm_id" value="<?= $person_object->farm_id ?>">
                                <input type="hidden" name="provider_id" value="<?= $provider_id ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("phone_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="phone" required placeholder="<?= translate('phone_lang'); ?>" value="<?= $person_object->phone ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("skype_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="skype"  placeholder="<?= translate('skype_lang'); ?>" value="<?= $person_object->skype ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("whatsapp_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="whatsapp"  placeholder="<?= translate('whatsapp_lang'); ?>" value="<?= $person_object->whatsapp ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("functions_lang"); ?></label>
                            <div class="input-group">
                                <select id="functions" name="functions" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('select_opction_lang') ?></option>
                                    <option <?php if($person_object->function ==1){?> selected <?php }?> value="1"><?= translate('seller_lang') ?></option>
                                    <option <?php if($person_object->function ==2){?> selected <?php }?> value="2"><?= translate('seller_payment_lang') ?></option>
                                    <option <?php if($person_object->function ==3){?> selected <?php }?> value="3"><?= translate('owner_lang') ?></option>
                                </select>
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