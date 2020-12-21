<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_services_lang'); ?>
            <small><?= translate('listar_service_lang'); ?></small>
            | <a href="<?= site_url('service/add_index'); ?>" class="btn btn-primary"><i
                    class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_service_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_service_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= translate("nombre_lang"); ?></th>
                                <th><?= translate("image_lang"); ?></th>
                                <th><?= translate("description_lang"); ?></th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_services as $item) { ?>
                                <tr>
                                    <td><?php if($item->estrella==1){?>
                                            <i class="fa fa-star"></i>
                                        <?php }?>
                                        <?= $item->nombre; ?>
                                        <br />
                                        <?= $item->icono;?>
                                    </td>
                                    <td style="max-width: 250px;"><img class="img img-rounded img-responsive" src="<?= base_url($item->imagen);?>" width="250" /></td>
                                    <td style="max-width: 400px;"><?= $item->descripcion; ?></td>
                                    <td>
                                        <a href="<?= site_url('service/update_index/' . $item->service_id); ?>"
                                           class="btn btn-warning"><i
                                                class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>

                                        <a href="<?= site_url('service/estrella/' . $item->service_id); ?>"
                                           class="btn btn-info"><i
                                                    class="fa fa-star"></i> <?= translate("featured_lang"); ?></a>

                                        <a href="<?= site_url('service/delete/' . $item->service_id); ?>"
                                           class="btn btn-danger"><i
                                                class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>

                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><?= translate("nombre_lang"); ?></th>
                                <th><?= translate("image_lang"); ?></th>
                                <th><?= translate("description_lang"); ?></th>
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
    $(function () {
        $("#example1").DataTable();

    });
</script>