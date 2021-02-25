<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_comments_lang'); ?>
            <small><?= translate('listar_comments_lang'); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_comments_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_comments_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><?= translate("usuario_lang"); ?></th>
                                <th><?= translate("evento_lang"); ?></th>
                                <th><?= translate("comment_lang"); ?></th>
                                <th><?= translate("state_lang"); ?></th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_comments as $item) { ?>
                                <tr>
                                    <td><?= $item->user_object->fullname;?></td>
                                    <td> <?= $item->evento_object->nombre;?> </td>
                                    <td> <?= $item->comment;?></td>
                                    <?php if($item->state =='0' ) {?>
                                        <td>Desactivado</td>
                                    <td>
                                        <a href="<?= site_url('comments/change/' . $item->comment_id); ?>"
                                           class="btn btn-success"><i class="fa fa-edit"></i>  Activar </a>
                                    </td>
                                    <?php } else { ?>
                                        <td>Activado</td>
                                    <td>
                                            <a href="<?= site_url('comments/change/' . $item->comment_id); ?>"
                                               class="btn btn-danger"><i class="fa fa-remove"></i>Desactivar </a>
                                    </td>
                                    <?php } ?>
                                </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th><?= translate("usuario_lang"); ?></th>
                                <th><?= translate("evento_lang"); ?></th>
                                <th><?= translate("comment_lang"); ?></th>
                                <th><?= translate("state_lang"); ?></th>
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