<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_banners_lang'); ?>
            <small><?= translate('listar_banner_lang'); ?></small>
            | <a href="<?= site_url('banner/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_banner_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_banner_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("url_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_banners) { ?>
                                    <?php foreach ($all_banners as $item) { ?>
                                        <tr>
                                            <td style="width: 30%;"><img class="img img-rounded img-responsive" src="<?= base_url($item->photo); ?>" style="width: 100%" /></td>
                                            <td><?= $item->url; ?>
                                                <br>
                                                <p>Titulo : <?= $item->texto_1; ?></p>
                                                <p>Sub titulo : <?= $item->texto_2; ?></p>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('banner/update_index/' . $item->_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                <a href="<?= site_url('banner/delete/' . $item->_id); ?>" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("url_lang"); ?></th>
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