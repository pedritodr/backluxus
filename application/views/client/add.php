<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_clients_lang'); ?>
            <small><?= translate('add_client_lang'); ?></small>
            | <a href="<?= site_url('client/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_client_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_client_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("client/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label><?= translate("fullname_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control input-sm" name="name" placeholder="<?= translate('fullname_lang'); ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("email_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control input-sm" name="email" placeholder="<?= translate('email_lang') ?>">
                                        </div>

                                    </div>



                                    <div class="col-lg-3">
                                        <label><?= translate("tax_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                            <input type="text" class="form-control input-sm" name="identificador" placeholder="<?= translate('tax_lang'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("logo_lang"); ?> (1920X766)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('foto_lang'); ?>">
                                        </div>
                                    </div>




                                </div>
                                <div class="row">
                                    <div class="col-lg-3">

                                        <label><?= translate("password_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control input-sm" name="password" required placeholder="<?= translate('password_lang'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">

                                        <label><?= translate("repeat_password_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control input-sm" name="repeat_password" required placeholder="<?= translate('repeat_password_lang'); ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("direccion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" class="form-control input-sm" name="address" placeholder="<?= translate('direccion_lang'); ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("phone_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_lang'); ?>">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <label><?= translate("person_contac_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" class="form-control input-sm" name="person_contact" placeholder="<?= translate('person_contac_lang'); ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("email_contac_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control input-sm" name="email_contact" placeholder="<?= translate('email_lang') ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("phone_person_contact_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control input-sm" name="phone_contact" placeholder="<?= translate('phone_person_contact_lang'); ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("skype_person_contact_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype_contact" placeholder="<?= translate('skype_person_contact_lang'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("person_pago_lang"); ?></label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" class="form-control input-sm" name="person_pago" placeholder="<?= translate('person_pago_lang'); ?>">
                                        </div>

                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("email_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control input-sm" name="email_pago" placeholder="<?= translate('email_pago_lang') ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("phone_person_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control input-sm" name="phone_person" placeholder="<?= translate('phone_person_pago_lang'); ?>">
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <label><?= translate("skype_person_pago_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype_person" placeholder="<?= translate('skype_person_pago_lang'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label"><?= translate("data_additional_lang"); ?></label>
                                            <textarea name="additional" class="form-control textarea" placeholder="<?= translate("data_additional_lang"); ?>">

                                    </textarea>

                                            <br>


                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label><?= translate("countrys_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                            <select id="pais" name="pais" class="form-control input-sm" data-placeholder="Seleccione una opción" required style="width: 100%">

                                                <?php
                                                if (isset($all_countrys))
                                                    foreach ($all_countrys as $item) { ?>
                                                    <option value="<?= $item->country_id; ?>"><?= $item->name; ?></option>
                                                <?php } ?>
                                            </select>

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
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();
        $('#reservation').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>