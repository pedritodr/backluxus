<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestionar marcaciones del cliente
            <small><?= translate("listar_subports_lang"); ?></small>
            | <a href="<?= site_url('client/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a> <a href="<?= site_url('client/add_destination_index/' . $client_id); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate("listar_subports_lang"); ?></li>

            <input type="hidden" name="client_id" value="<?= $client_id; ?>" />

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate("listar_subports_lang"); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("datos_marcacion_lang"); ?></th>

                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($destinations as $item) { ?>
                                    <tr>
                                        <td>
                                            <p>
                                                <strong><?= translate("subport_lang"); ?>:</strong> <?= $item->name; ?> <br>
                                                <strong><?= translate("destino_lang"); ?>:</strong> <?= $item->name_destination; ?> <br>


                                            </p>




                                        </td>
                                        <td>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?= site_url('client/update_marcacion_index/' . $item->dialing_id . '/' . $item->cliente_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></li>

                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="<?= site_url('client/delete_marcacion/' . $item->dialing_id); ?>"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a></li>
                                                </ul>
                                            </div>




                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>

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