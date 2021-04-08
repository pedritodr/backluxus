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
            <?= translate('manage_subports_lang'); ?>
            <small><?= translate('update_subport_lang'); ?></small>
            | <a href="<?= site_url('client/listar_destination/' . $cliente_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_subport_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_subport_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("client/update_marcacion"); ?>
                        <input type="hidden" name="cliente_id" value="<?= $cliente_id; ?>" />
                        <input type="hidden" name="dialing_id" value="<?= $dialing_object->dialing_id; ?>" />


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("nombre_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="text" class="form-control input-sm" name="nombre" placeholder="<?= translate('nombre_lang'); ?>" value="<?= $dialing_object->name; ?>">
                                        </div>
                                    </div>



                                    <div class="col-lg-3">
                                        <label id="titulo"><?= translate("destination_lang"); ?></label>
                                        <div class="input-group" id="destinations">

                                            <span class="input-group-addon"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                                            <select id="destination" name="destination" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%" required>
                                                <option value="">Seleccione una opción</option>
                                                <?php
                                                if (isset($all_destinations))
                                                    foreach ($all_destinations as $item) { ?>
                                                    <option <?php if ($item->destination_id == $dialing_object->destination_id) { ?> selected <?php } ?> value="<?= $item->destination_id; ?>"><?= $item->name; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>

                                    </div>




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