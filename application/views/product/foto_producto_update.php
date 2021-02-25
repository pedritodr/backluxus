<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_photo_lang'); ?>
            <small> <?= translate('update_foto_lang'); ?></small>
            | <a href="<?= site_url('product/foto_coleccion/' . $foto_producto_object->product_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"> <?= translate('update_foto_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_foto_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("product/update_foto_coleccion"); ?>
                        <div class="row">

                            <div class="col-lg-8">
                                <label><?= translate("image_lang"); ?> (600x600)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control" required name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img class="img img-rounded img-responsive" style="margin: 10px" src="<?= base_url($foto_producto_object->photo); ?>" width="200" />
                            </div>


                            <input type="hidden" name="foto_producto_id" value="<?= $foto_producto_object->photo_product_id; ?>" />


                        </div>

                        <div class="row">
                            <div class="col-xs-12" style="text-align: left;">
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
    });
</script>