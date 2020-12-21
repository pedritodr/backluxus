<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_banners_lang'); ?>
            <small><?= translate('update_banner_lang'); ?></small>
            | <a href="<?= site_url('banner/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('update_banner_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= translate('update_banner_lang'); ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>
                        <?= form_open_multipart("banner/update"); ?>
                        <input type="hidden" name="banner_id" value="<?= $banner_object->_id; ?>" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label><?= translate("image_lang"); ?> (1170X500)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                            <input type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= translate("url_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                            <input type="url" class="form-control input-sm" name="url" value="<?= $banner_object->url; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= "Titulo" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control" name="titulo" placeholder="<?= "Aqui un texto..." ?>" value="<?= $banner_object->texto_1; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label><?= "Sub Titulo" ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control" name="sub_titulo" placeholder="<?= "Aqui un texto..." ?>" value="<?= $banner_object->texto_2; ?>">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
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
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
    });
</script>