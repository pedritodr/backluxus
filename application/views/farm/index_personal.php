<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_farms_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('farm/add_persona_index/') . $provider_id . '/' . $farm_id; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a> | <a href="<?= site_url('farm/index/' . $provider_id); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_personal_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("data_personal_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_personal) { ?>
                                    <?php foreach ($all_personal as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><b><?= translate("nombre_lang") . ":</b> " . $item->farms->personal->name; ?></p>
                                                <p><b><?= translate("phone_lang") . ": </b>" . $item->farms->personal->phone; ?></p>
                                                <p><b><?= translate("skype_lang") . ": </b>" . $item->farms->personal->skype; ?></p>
                                                <p><b><?= translate("whatsapp_lang") . ": </b>" . $item->farms->personal->whatsapp; ?></p>
                                                <?php if ($item->farms->personal->function == 1) { ?>
                                                    <p><b><?= translate('function_lang') ?>: </b><?= translate('seller_lang')?></p>
                                                <?php  } else if ($item->farms->personal->function == 2) { ?>
                                                    <p><b><?= translate('function_lang') ?>: </b><?= translate('seller_payment_lang')?></p>
                                                <?php  } else if ($item->farms->personal->function == 3) { ?>
                                                    <p><b><?= translate('function_lang') ?>: </b><?= translate('owner_lang')?></p>
                                                <?php } else { ?>
                                                    <p><b><?= translate('function_lang') ?>: </b></p>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="<?= site_url('farm/update_persona_index/' . $provider_id . '/' . $item->farms->personal->farm_id . '/' . $item->farms->personal->person_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                        <a class="dropdown-item btn btn-danger" href="javascript:void(0)" onclick="deletePerson('<?= $provider_id ?>','<?= $item->farms->personal->farm_id ?>','<?= $item->farms->personal->person_id ?>')"><i class="fa fa-edit"></i> <?= translate("delete_lang"); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("data_personal_lang"); ?></th>
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
    const deletePerson = (providerId, farmId, personId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("farm/delete_persona"); ?>' + '/' + providerId + '/' + farmId + '/' + personId;
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