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
            <?= translate('manage_providers_lang'); ?>
            <small><?= translate('add_provider_lang'); ?></small>
            | <a href="<?= site_url('provider/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_provider_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_provider_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("provider/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-3">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="name" placeholder="<?= translate('nombre_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("tax_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="identificacion" placeholder="<?= translate('tax_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("email_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control input-sm" name="email" placeholder="<?= translate('email_lang'); ?>">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("phone_provider_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control input-sm" name="phone" placeholder="<?= translate('phone_provider_lang'); ?>">
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("person_payment_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control input-sm" name="person_payment" placeholder="<?= translate('person_payment_lang'); ?>">
                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("email_payment_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control input-sm" name="email_payment" placeholder="<?= translate('email_payment_lang') ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("phone_payment_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control input-sm" name="phone_payment" placeholder="<?= translate('phone_payment_lang'); ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("skype_payment_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype_payment" placeholder="<?= translate('skype_payment_lang'); ?>">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label><?= translate("seller_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control input-sm" name="seller" placeholder="<?= translate('seller_lang'); ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("email_seller_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" class="form-control input-sm" name="email_seller" placeholder="<?= translate('email_seller_lang') ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("phone_seller_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control input-sm" name="phone_seller" placeholder="<?= translate('phone_seller_lang'); ?>">
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <label><?= translate("skype_seller_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-skype"></i></span> <input type="text" class="form-control input-sm" name="skype_seller" placeholder="<?= translate('skype_seller_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <label><?= translate("address_lang"); ?></label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control input-sm" name="address" placeholder="<?= translate('address_lang'); ?>">
                                    </div>

                                </div>

                                <div class="col-lg-5">
                                    <label>Nombre comercial</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cogs"></i></span> <input type="text" class="form-control input-sm" name="nombre_comercial" placeholder="Nombre comercial">
                                    </div>
                                </div>




                            </div>


                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label"><?= translate("data_banking_lang"); ?></label>
                                    <textarea name="banking" class="form-control textarea" placeholder="<?= translate("data_banking_lang"); ?>">

                                    </textarea>

                                    <br>


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
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;">

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
        $(".select2").select2();
        $(".textarea").wysihtml5();

    });
</script>
<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.js"></script>