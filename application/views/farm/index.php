<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_providers_lang'); ?>
            <small><?= translate('listar_providers_lang'); ?></small>
            <a href="<?= site_url('provider/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_providers_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_providers_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("nombre_comercial_lang"); ?></th>
                                    <th style="width:15%; display:none"></th>
                                    <th style="width:15%;"><?= translate("categories_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_providers as $item) { ?>
                                    <tr>
                                        <td style="width:35%">
                                            <p> <strong><?= $item->name; ?> </strong>
                                            </p>
                                        </td>
                                        <td style="width:35%">
                                            <p> <strong><?= $item->name_commercial; ?> </strong>
                                            </p>
                                        </td>
                                        <td style="width:15%; display:none">
                                            <?php foreach ($item->products as $product) { ?>

                                                <p><strong><?= translate("product_lang"); ?>:</strong> <?= $product->name; ?>
                                                </p>

                                            <?php } ?>
                                        </td>
                                        <td style="width:15%;">
                                            <?php foreach ($item->categories as $categorias) { ?>

                                                <p class="label label-info"><strong><?= $categorias->name; ?></strong>
                                                </p>&nbsp;

                                            <?php } ?>
                                        </td>
                                        <td style="width:15%">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li> <a href="<?= site_url('provider/ver_index/' . $item->provider_id); ?>"><i class="fa fa-eye"></i> <?= translate("ver_ficha_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('provider/update_index/' . $item->provider_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                    </li>
                                                    <li> <a href="<?= site_url('provider/products/' . $item->provider_id); ?>"><i class="fa fa-thumb-tack"></i> <?= translate("manage_variety_lang"); ?></a>
                                                    </li>
                                                    <li role="separator" class="divider"></li>

                                                    <li><a href="<?= site_url('provider/delete/' . $item->provider_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                    </li>
                                                </ul>
                                            </div>


                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("nombre_comercial_lang"); ?></th>
                                    <th style="width:15%; display:none"></th>
                                    <th style="width:15%;"><?= translate("categories_lang"); ?></th>
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