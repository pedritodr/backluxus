<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url();?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url();?>admin_lte/dist/css/AdminLTE.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_services_lang'); ?>
            <small><?= translate('add_service_lang'); ?></small>
            | <a href="<?= site_url('service/index'); ?>" class="btn btn-default"><i
                    class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('add_service_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_service_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>

                        <?= form_open_multipart("service/add"); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6" >
                                        <label><?= translate("nombre_lang");?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                                            <input type="text" class="form-control" name="nombre"
                                                   placeholder="<?= translate('nombre_lang'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6" >
                                    <label>Resumen</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                            <input type="text" class="form-control" name="resumen" required />
                                                   
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-lg-6" >
                                        <label><?= translate("image_lang");?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control" name="archivo" required
                                                   placeholder="<?= translate('image_lang'); ?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-6" >
                                        <label>Pictografía</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                            <input type="text" class="form-control" name="icono" required />
                                                   
                                        </div>
                                    </div>

                                    

                                     

                                </div>

                                


                                <div class="row">
                                <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label"><?= translate('description_lang'); ?></label>
                                    <textarea name="desc" class="form-control textarea" required  placeholder="<?= translate('description_lang'); ?>">

                                    </textarea>
                                </div>
                                </div>

                                </div>
                                </div>

                                    <div class="col-xs-12" style="text-align: right;">

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang');?></button>
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

    $(function () {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();

    });
</script>
<!-- Select2 -->
<script src="<?= base_url();?>admin_lte/plugins/select2/select2.full.min.js"></script>