<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_carguera_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('carguera/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('ready_carguera_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("name_carguera_lang"); ?></th>
                                    <th><?= translate("direccion_lang"); ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("person_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($cargueras) { ?>
                                    <?php foreach ($cargueras as $item) { ?>
                                        <tr>
                                            <td> <?= $item->name; ?>
                                            </td>
                                            <td> <?= $item->address; ?>
                                            </td>
                                            <td> <?= $item->phone; ?>
                                            </td>
                                            <td> <?= $item->person; ?>
                                            </td>
                                            <td> <?= $item->email; ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('carguera/update_index/' . $item->carguera_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="deleteCarguera('<?= $item->carguera_id ?>')" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("name_carguera_lang"); ?></th>
                                    <th><?= translate("direccion_lang"); ?></th>
                                    <th><?= translate("phone_lang"); ?></th>
                                    <th><?= translate("person_lang"); ?></th>
                                    <th><?= translate("email_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->


<script>
    const deleteCarguera = (id) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("carguera/delete"); ?>' + '/' + id;
                window.location.href = urlDelete;
            }
        })
    }
    $(function() {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });
</script>