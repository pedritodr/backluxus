<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_photos_lang'); ?>
            <small> <?= translate('listar_photos_lang'); ?></small>
            | <a href="<?= site_url('product/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('manage_photo_lang'); ?>
            </li>


        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('add_photo_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("product/add_foto"); ?>

                        <div class="row">
                            <div class="col-lg-12">

                                <input type="hidden" name="producto_id" value="<?= $producto_id; ?>" />
                                <label><?= translate("image_lang"); ?> (600x600)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                    <input type="file" class="form-control input-sm" name="archivo" required placeholder="<?= translate('image_lang'); ?>">
                                </div>

                                <div class="row">
                                    <br>
                                    <div class="col-xs-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                                    </div>
                                </div>

                            </div>


                            <?= form_close(); ?>


                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->
            </div><!-- /.row -->
    </section><!-- /.content -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_photos_lang'); ?>
                        </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_fotos) { ?>
                                    <?php foreach ($all_fotos as $item) { ?>
                                        <tr>
                                            <td><img style="width:50%" class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" /></td>
                                            <td>
                                                <!--    <a href="<?= site_url('product/update_foto_coleccion_index/' . $item->_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a> -->
                                                <a href="<?= site_url('product/delete_foto/' . $item->_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();

    });
</script>