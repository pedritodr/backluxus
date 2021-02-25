<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
    #modalPersonLuxus {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_farms_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('farm/add_farm_index/') . $provider_object->provider_id; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
            | <a href="<?= site_url('farm/index_provider'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_farms_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("data_farm_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($provider_object) { ?>
                                    <?php if (isset($provider_object->farms)) { ?>
                                        <?php foreach ($provider_object->farms as $item) { ?>
                                            <tr>
                                                <td>
                                                    <p><b><?= translate("name_legal_lang") . ":</b> " . $item->name_legal; ?></p>
                                                    <p><b><?= translate("name_commercial_lang") . ": </b>" . $item->name_commercial; ?></p>
                                                    <p><b><?= translate("address_farm_lang") . ": </b>" . $item->address_farm; ?></p>
                                                    <p><b><?= translate("address_oficce_lang") . ": </b>" . $item->address_office; ?></p>
                                                    <p><b><?= translate("hectare_lang") . ": </b>" . $item->hectare; ?></p>
                                                </td>
                                                <td>
                                                    <div class="btn-group mb-4 mr-2" role="group">
                                                        <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg></button>
                                                        <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                            <a class="dropdown-item" href="<?= site_url('farm/update_index/' . $item->farm_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                            <a class="dropdown-item" href="<?= site_url('farm/index_personal/' . $provider_object->provider_id.'/'. $item->farm_id); ?>"> <?= translate("personal_lang"); ?></a>
                                                            <?php if (isset($item->person_luxus)) { ?>
                                                            <a style="cursor:pointer" onclick="loadPersonLuxus('<?= $item->farm_id; ?>','<?= base64_encode(json_encode($item->person_luxus)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" onclick="loadPersonLuxus('<?= $item->farm_id; ?>','<?= false ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } ?>
                                                            <a class="dropdown-item btn btn-danger" href="javascript:void(0)" onclick="deleteFarm('<?= $item->farm_id ?>')"><i class="fa fa-edit"></i> <?= translate("delete_lang"); ?></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("data_farm_lang"); ?></th>
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
<div class="modal fade" id="modalPersonLuxus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('person_luxus_commercial_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("users_luxus_lang"); ?></label>
                        <div class="input-group">
                            <select id="userLuxus" name="userLuxus" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($users_luxus) { ?>
                                    <?php foreach ($users_luxus as $item) { ?>
                                        <option value="<?= $item->user_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="farmId">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalPersonLuxus" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitPersonLuxus()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerPersonLuxus" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanPersonLuxus"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteFarm = (farmId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("farm/delete_farm"); ?>' + '/' + farmId;
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
    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }
    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }
    const loadPersonLuxus = (farmId, object) => {
        $('#farmId').val(farmId);
        if (object) {
            object = decodeB64Utf8(object);
            object = JSON.parse(object);
            $('#userLuxus').val(object.user_id);
        }
        $('#modalPersonLuxus').modal({
            backdrop: false
        })

    }
    const submitPersonLuxus = () => {
        $('#btnCancelModalPersonLuxus').prop('disabled',true);
        let personLuxus = $('select[name=userLuxus] option').filter(':selected').attr('itemId');
        let farmId = $('#farmId').val();
        if (personLuxus == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una persona',
                padding: '3em',
            })
        } else {

            $('#spinnerPersonLuxus').show();
            $('#spanPersonLuxus').text('<?= translate('processing_lang') ?>' + '...');
            personLuxus = JSON.parse(decodeB64Utf8(personLuxus));
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/add_person_luxus') ?>",
                    data: {
                        farmId,
                        personLuxus
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            const toast = swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                padding: '2em'
                            });
                            toast({
                                type: 'success',
                                title: '¡Correcto!',
                                padding: '2em',
                            })
                            setTimeout(function() {
                                $('#spinnerPersonLuxus').hide();
                                $('#spanPersonLuxus').text('<?= translate('guardar_info_lang') ?>');
                                $('#btnCancelModalPersonLuxus').prop('disabled',false);
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#spinnerEditManager').hide();
                            $('#spanEditManager').text('<?= translate('guardar_info_lang') ?>');
                            $('#btnCancelModalPersonLuxus').prop('disabled',false);
                        }

                    }
                });
            }, 1500)
        }

    }
</script>