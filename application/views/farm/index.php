<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    #modalPersonLuxus {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalAddManagers {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalEditManagers {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalMarkets {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalVarieties {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalAddVariety {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_farms_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('farm/add_index_provider'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
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
                                    <th><?= translate("person_luxus_commercial_lang"); ?></th>
                                    <th><?= translate("farms_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_providers) { ?>
                                    <?php foreach ($all_providers as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><b><?= translate("owner_lang") . ":</b> " . $item->owner; ?></p>
                                                <p><b><?= translate("days_credit_lang") . ":</b> " . $item->days_credit; ?></p>
                                                <p><b><?= translate("name_legal_lang") . ":</b> " . $item->name_legal; ?></p>
                                                <p><b><?= translate("name_commercial_lang") . ": </b>" . $item->name_commercial; ?></p>
                                                <p><b><?= translate("address_farm_lang") . ": </b>" . $item->address_farm; ?></p>
                                                <p><b><?= translate("address_oficce_lang") . ": </b>" . $item->address_office; ?></p>
                                                <p><b><?= translate("hectare_lang") . ": </b>" . $item->hectare; ?></p>
                                            </td>
                                            <td>
                                                <?php if (isset($item->person_luxus)) { ?>
                                                    <?= $item->person_luxus->name . ' ' . $item->person_luxus->surname ?>
                                                <?php } ?>

                                            </td>
                                            <td style="width:40%">
                                                <?php if ($item->farm_father) { ?>
                                                    <h6><b><?= translate("farm_father_lang") . "</b> " ?></h6>
                                                    <p><b><?= translate("owner_lang") . ":</b> " . $item->farm_father->owner; ?></p>
                                                    <p><b><?= translate("name_legal_lang") . ":</b> " . $item->farm_father->name_legal; ?></p>
                                                    <p><b><?= translate("name_commercial_lang") . ": </b>" . $item->farm_father->name_commercial; ?></p>
                                                <?php } else { ?>
                                                    <?php if (isset($item->farms_sons)) { ?>
                                                        <?php if ($item->farms_sons) { ?>
                                                            <h6><b><?= translate("farm_group_lang") . "</b> " ?></h6>
                                                            <div class="row">
                                                                <?php foreach ($item->farms_sons as $sons) { ?>
                                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                                        <p><b><?= translate("owner_lang") . ":</b> " . $sons->owner; ?></p>
                                                                        <p><b><?= translate("name_legal_lang") . ":</b> " . $sons->name_legal; ?></p>
                                                                        <p><b><?= translate("name_commercial_lang") . ": </b>" . $sons->name_commercial; ?></p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php  } ?>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="<?= site_url('farm/update_index_provider/' . $item->farm_id); ?>"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                        <?php if (isset($item->person_luxus)) { ?>
                                                            <a style="cursor:pointer" href="javascript:void(0)" onclick="loadPersonLuxus('<?= $item->farm_id; ?>','<?= base64_encode(json_encode($item->person_luxus)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" href="javascript:void(0)" onclick="loadPersonLuxus('<?= $item->farm_id; ?>','<?= false ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if (isset($item->markets)) { ?>
                                                            <?php if (count($item->markets) > 0) { ?>
                                                                <a style="cursor:pointer" href="javascript:void(0)" onclick="markets('<?= $item->farm_id; ?>','<?= base64_encode(json_encode($item->markets)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markets_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <a style="cursor:pointer" href="javascript:void(0)" onclick="markets('<?= $item->farm_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markets_lang"); ?></a>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" href="javascript:void(0)" onclick="markets('<?= $item->farm_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markets_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if (isset($item->personal)) {
                                                            if (count($item->personal) > 0) { ?>
                                                                <a id="btnManagePerson" href="javascript:void(0)" style="cursor:pointer" onclick="loadPersonal('<?= $item->farm_id; ?>','<?= base64_encode(json_encode($item->personal)) ?>','1');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("manage_personal_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <a id="btnManagePerson" href="javascript:void(0)" style="cursor:pointer" onclick="loadPersonal('<?= $item->farm_id; ?>','','0');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("manage_personal_lang"); ?></a>
                                                            <?php  } ?>
                                                        <?php  } else { ?>
                                                            <a id="btnManagePerson" href="javascript:void(0)" style="cursor:pointer" onclick="loadPersonal('<?= $item->farm_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("manage_personal_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if (isset($item->varieties)) {
                                                            if (count($item->varieties) > 0) { ?>
                                                                <a id="btnManageVariety" href="javascript:void(0)" style="cursor:pointer" onclick="loadVarieties('<?= $item->farm_id; ?>','<?= base64_encode(json_encode($item->varieties)) ?>','1');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("productos_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <a id="btnManageVariety" href="javascript:void(0)" style="cursor:pointer" onclick="loadVarieties('<?= $item->farm_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("productos_lang"); ?></a>
                                                            <?php  } ?>
                                                        <?php  } else { ?>
                                                            <a id="btnManageVariety" href="javascript:void(0)" style="cursor:pointer" onclick="loadVarieties('<?= $item->farm_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("productos_lang"); ?></a>
                                                        <?php } ?>
                                                        <a class="dropdown-item btn btn-danger" href="javascript:void(0)" onclick="deleteFarm('<?= $item->farm_id ?>')"><i class="fa fa-edit"></i> <?= translate("delete_lang"); ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("data_farm_lang"); ?></th>
                                    <th><?= translate("person_luxus_commercial_lang"); ?></th>
                                    <th><?= translate("farms_lang"); ?></th>
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
<div class="modal fade" id="modalAddManagers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_person_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("nombre_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="nameManager" placeholder="<?= translate('nombre_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("email_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="emailManager" placeholder="<?= translate('email_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("phone_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="phoneManager" placeholder="<?= translate('phone_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("skype_lang"); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="skypeAddPerson" placeholder="<?= translate('skype_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("functions_lang"); ?></label>
                        <div class="input-group">
                            <select id="functions" name="functions" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <option value="1"><?= translate('seller_lang') ?></option>
                                <option value="2"><?= translate('seller_payment_lang') ?></option>
                                <option value="3"><?= translate('owner_lang') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="farmIdAddPerson">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalAddManager" class="btn" onclick="cancelAddPerson()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddPerson()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddManager" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddManager"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalManagers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('personal_lang') ?></h5> <a id="btnAddManager" onclick="" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_manager_lang'); ?></a>
            </div>
            <div class="modal-body" id="bodyModalManagers">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditManagers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('edit_manager_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("nombre_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="nameEditManager" placeholder="<?= translate('nombre_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("email_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="emailEditManager" placeholder="<?= translate('email_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("phone_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="phoneEditManager" placeholder="<?= translate('phone_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("skype_lang"); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="skypeEditPerson" placeholder="<?= translate('skype_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("functions_lang"); ?></label>
                        <div class="input-group">
                            <select id="functionsEdit" name="functionsEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <option value="1"><?= translate('seller_lang') ?></option>
                                <option value="2"><?= translate('seller_payment_lang') ?></option>
                                <option value="3"><?= translate('owner_lang') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="personId">
                <input type="hidden" id="farmIdEditPerson">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalEditManager" class="btn" onclick="cancelEditPerson()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditPerson()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditManager" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditManager"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal  fade" id="modalMarkets" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('markets_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("countrys_lang"); ?></label>
                        <div class="input-group">
                            <select id="countrysMarkets" name="countrysMarkets" class="form-control tagging" multiple="multiple" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option disabled itemId="0" value="0"><?= translate('select_opction_lang') ?>...</option>
                                <?php if (isset($countrys)) { ?>
                                    <?php if ($countrys) { ?>
                                        <?php foreach ($countrys as $item) { ?>
                                            <option value="<?= $item->country_id ?>"><?= $item->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="farmIdMarket">
            </div>
            <div class="modal-footer">
                <button id="btnCancelMarkets" class="btn" onclick="cancelMarkets()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button id="btnAddMarkers" onclick="submitAddMarkets()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddMarkets" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddMarkets"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalVarieties" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('productos_lang') ?></h5> <a id="btnAddVarieties" onclick="addVariety()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_producto_lang'); ?></a>
            </div>
            <div class="modal-body" id="bodyModalVarieties">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddVariety" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_producto_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label><?= translate("categorias_lang"); ?></label>
                        <div class="input-group">
                            <select id="categories" name="categories" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("productos_lang"); ?></label>
                        <div class="input-group">
                            <select id="product" disabled name="product" class="form-control tagging" multiple="multiple" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>

                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="farmIdAddVariety">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalAddVariety" class="btn" onclick="cancelAddVariety()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddVariety()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddVariety" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddVariety"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const deleteFarm = (providerId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("farm/delete_provider"); ?>' + '/' + providerId;
                window.location.href = urlDelete;
            }
        })
    }
    $(function() {
        $("#countrysMarkets").select2({
            tags: true,
            dropdownParent: $("#modalMarkets"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: true,
        });
        $("#product").select2({
            tags: true,
            dropdownParent: $("#modalAddVariety"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: true,
        });
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
        $('#btnCancelModalPersonLuxus').prop('disabled', true);
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
                                $('#btnCancelModalPersonLuxus').prop('disabled', false);
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
                            $('#btnCancelModalPersonLuxus').prop('disabled', false);
                        }

                    }
                });
            }, 1500)
        }

    }
    const addPerson = (farmId) => {
        $('#farmIdAddPerson').val(farmId);
        $('#modalManagers').modal('hide');
        $('#modalAddManagers').modal({
            backdrop: false
        })
    }
    const submitAddPerson = () => {
        $('#btnCancelModalAddManager').prop('disabled', true);
        let functions = $('select[name=functions] option').filter(':selected').val();
        let farmId = $('#farmIdAddPerson').val();
        let name = $('#nameManager').val().trim();
        let phone = $('#phoneManager').val().trim();
        let email = $('#emailManager').val().trim();
        let skype = $('#skypeAddPerson').val().trim();
        if (name == '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El nombre es requerida',
                padding: '3em',
            })
        } else if (email == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL email es requerido',
                padding: '3em',
            })
        } else if (phone == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL teléfono es requerido',
                padding: '3em',
            })
        } else if (skype == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL skype es requerido',
                padding: '3em',
            })
        } else if (functions == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una función',
                padding: '3em',
            })
        } else {

            $('#spinnerAddManager').show();
            $('#spanAddManager').text('<?= translate('processing_lang') ?>' + '...');

            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/add_persona') ?>",
                    data: {
                        name,
                        email,
                        phone,
                        functions,
                        farmId,
                        skype
                    },
                    success: (result) => {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalAddManagers').modal('hide');
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
                                $('#btnCancelModalAddManager').prop('disabled', false);
                                $('#spinnerAddManager').hide();
                                $('#spanAddManager').text('<?= translate('guardar_info_lang') ?>');
                                loadPersonal(farmId, result.data, '0');
                                $('#btnManagePerson').attr('onclick', 'loadPersonal("' + farmId + '","' + encodeB64Utf8(JSON.stringify(result.data)) + '","1")');
                                //location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalAddManager').prop('disabled', false);
                            $('#spinnerAddManager').hide();
                            $('#spanAddManager').text('<?= translate('guardar_info_lang') ?>');
                        }

                    },
                    error: (error) => {
                        console.log(error);
                    }

                });
            }, 1500)
        }
    }
    const loadPersonal = (farmId, personal = [], type = 0) => {
        if (type == "1") {
            personal = decodeB64Utf8(personal);
            personal = JSON.parse(personal);
        }
        $('#btnAddManager').attr('onclick', 'addPerson("' + farmId + '")');
        $("#modalManagers").modal('show');
        $("#bodyModalManagers").empty();
        if (personal.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesManagers" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Personal</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            personal.forEach((item, indice, array) => {
                item.farmId = farmId;
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += '<p><b><?= translate('nombre_lang') ?>: </b> ' + item.name + '</p>';
                texto_tabla += '<p><b><?= translate('email_lang') ?>: </b> ' + item.email + '</p>';
                texto_tabla += '<p><b><?= translate('phone_lang') ?>: </b> ' + item.phone + '</p>';
                texto_tabla += '<p><b><?= translate('skype_lang') ?>: </b> ' + item.skype + '</p>';
                if (item.function == 1) {
                    let funcitonManager = '<?= translate('seller_lang') ?>';
                    texto_tabla += '<p><b><?= translate('function_lang') ?>: </b> ' + funcitonManager + '</p>';
                } else if (item.function == 2) {
                    let funcitonManager = '<?= translate('seller_payment_lang') ?>';
                    texto_tabla += '<p><b><?= translate('function_lang') ?>: </b> ' + funcitonManager + '</p>';
                } else if (item.function == 3) {
                    let funcitonManager = '<?= translate('owner_lang') ?>';
                    texto_tabla += '<p><b><?= translate('function_lang') ?>: </b> ' + funcitonManager + '</p>';
                } else {
                    let funcitonManager = '';
                    texto_tabla += '<p><b><?= translate('function_lang') ?>: </b> ' + funcitonManager + '</p>';
                }
                texto_tabla += '</td>';

                texto_tabla += '<td>';

                texto_tabla += '<a class="btn btn-primary" href="javascript:void(0);"  onclick=editPerson("' + encodeB64Utf8(JSON.stringify(item)) + '");> Editar</a>';
                texto_tabla += '<a class="btn btn-danger" href="javascript:void(0);"   onclick=deletePerson("' + encodeB64Utf8(JSON.stringify(item)) + '");> Eliminar</a>';

                texto_tabla += '</td>';
                texto_tabla += '</tr>';
            });
            texto_tabla += '</tbody>';

            texto_tabla += '</table>'
            $("#bodyModalManagers").html(texto_tabla);
            $("#datatablesManagers").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#bodyModalManagers').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }
    const editPerson = (objectPerson) => {

        objectPerson = decodeB64Utf8(objectPerson);
        objectPerson = JSON.parse(objectPerson);
        $("#modalManagers").modal('hide');
        $('#nameEditManager').val(objectPerson.name);
        $('#phoneEditManager').val(objectPerson.phone);
        $('#emailEditManager').val(objectPerson.email);
        $('#functionsEdit').val(objectPerson.function);
        $('#personId').val(objectPerson.person_id);
        $('#farmIdEditPerson').val(objectPerson.farmId);
        $('#skypeEditPerson').val(objectPerson.skype)
        $('#modalEditManagers').modal({
            backdrop: false
        })
    }
    const cancelEditPerson = () => {
        $("#modalEditManagers").modal('hide');
        $('#modalManagers').modal({
            backdrop: false
        })
    }
    const cancelAddPerson = () => {
        $("#modalAddManagers").modal('hide');
        $('#modalManagers').modal({
            backdrop: false
        })
    }
    const submitEditPerson = () => {
        $('#btnCancelModalEditManager').prop('disabled', true);
        let functions = $('select[name=functionsEdit] option').filter(':selected').val();
        let farmId = $('#farmIdEditPerson').val();
        let personId = $('#personId').val();
        let name = $('#nameEditManager').val().trim();
        let phone = $('#phoneEditManager').val().trim();
        let email = $('#emailEditManager').val().trim();
        let skype = $('#skypeEditPerson').val().trim();
        if (name == '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El nombre es requerida',
                padding: '3em',
            })
        } else if (email == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL email es requerido',
                padding: '3em',
            })
        } else if (phone == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL teléfono es requerido',
                padding: '3em',
            })
        } else if (skype == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'EL skype es requerido',
                padding: '3em',
            })
        } else if (functions == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una función',
                padding: '3em',
            })
        } else {

            $('#spinnerEditManager').show();
            $('#spanEditManager').text('<?= translate('processing_lang') ?>' + '...');

            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/update_person') ?>",
                    data: {
                        name,
                        email,
                        phone,
                        functions,
                        farmId,
                        personId,
                        skype
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalEditManagers').modal('hide');
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
                                $('#btnCancelModalEditManager').prop('disabled', false);
                                $('#spinnerEditManager').hide();
                                $('#spanEditManager').text('<?= translate('guardar_info_lang') ?>');
                                loadPersonal(farmId, result.data, '0');
                                $('#btnManagePerson').attr('onclick', 'loadPersonal("' + farmId + '","' + encodeB64Utf8(JSON.stringify(result.data)) + '","1")');
                                /// location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalEditManager').prop('disabled', false);
                            $('#spinnerEditManager').hide();
                            $('#spanEditManager').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }
    const deletePerson = (person) => {
        person = decodeB64Utf8(person);
        person = JSON.parse(person);
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/delete_person') ?>",
                    data: {
                        personId: person.person_id,
                        farmId: person.farmId
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
                                loadPersonal(person.farmId, result.data, '0');
                                $('#btnManagePerson').attr('onclick', 'loadPersonal("' + person.farmId + '","' + encodeB64Utf8(JSON.stringify(result.data)) + '","1")');
                                //location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                        }

                    }
                });
            }
        })
    }
    const markets = (farmId, markets = false) => {

        $('#farmIdMarket').val(farmId);
        if (markets) {
            markets = JSON.parse(decodeB64Utf8(markets));
            let countrySelecteds = [];
            if (markets.length > 0) {
                markets.forEach(item => {
                    countrySelecteds.push(item.country_id);
                });
                $("#countrysMarkets").select2().val(countrySelecteds).trigger("change");
            } else {
                $('#countrysMarkets').val(null).trigger('change');
            }
        } else {
            $('#countrysMarkets').val(null).trigger('change');
        }
        $('#modalMarkets').modal({
            backdrop: false
        })
        $("#countrysMarkets").select2({
            tags: true,
            dropdownParent: $("#modalMarkets"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: true,
        });
        $('#btnAddMarkers').attr('onclick', 'submitAddMarkets("' + markets + '")');
    }
    const cancelMarkets = () => {
        $('#modalMarkets').modal('hide');
    }
    const submitAddMarkets = (markers = false) => {
        $('#btnCancelMarkets').prop('disabled', true);
        let farmId = $('#farmIdMarket').val();
        let country = $('#countrysMarkets').val();
        if (!markets) {
            if (country == 0) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });
                toast({
                    type: 'error',
                    title: 'Seleccione un país para continuar ',
                    padding: '2em',
                })
            } else {
                $('#spinnerAddMarkets').show();
                $('#spanAddMarkets').text('<?= translate('processing_lang') ?>' + '...');
                let countrys = [];
                let countrysMarket = '<?= json_encode($countrys) ?>';
                countrysMarket = JSON.parse(countrysMarket);
                country.forEach((item) => {
                    let results = countrysMarket.filter((element) => {
                        return element.country_id == item;
                    });
                    let objCountry = (results.length > 0) ? results[0] : null;

                    if (objCountry) {
                        countrys.push(objCountry);
                    }
                });
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('farm/markets') ?>",
                        data: {
                            countrys,
                            farmId
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                $('#modalMarkets').modal('hide');
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
                                    $('#btnCancelMarkets').prop('disabled', false);
                                    $('#spinnerAddMarkets').hide();
                                    $('#spanAddMarkets').text('<?= translate('guardar_info_lang') ?>');
                                    location.reload();
                                }, 1000);
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                                $('#btnCancelMarkets').prop('disabled', false);
                                $('#spinnerAddMarkets').hide();
                                $('#spanAddMarkets').text('<?= translate('guardar_info_lang') ?>');
                            }

                        }
                    });
                }, 1500)
            }
        } else {
            $('#spinnerAddMarkets').show();
            $('#spanAddMarkets').text('<?= translate('processing_lang') ?>' + '...');
            let countrys = [];
            let countrysMarket = '<?= json_encode($countrys) ?>';
            countrysMarket = JSON.parse(countrysMarket);
            country.forEach((item) => {
                let results = countrysMarket.filter((element) => {
                    return element.country_id == item;
                });
                let objCountry = (results.length > 0) ? results[0] : null;

                if (objCountry) {
                    countrys.push(objCountry);
                }
            });
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/markets') ?>",
                    data: {
                        countrys,
                        farmId
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalMarkets').modal('hide');
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
                                $('#btnCancelMarkets').prop('disabled', false);
                                $('#spinnerAddMarkets').hide();
                                $('#spanAddMarkets').text('<?= translate('guardar_info_lang') ?>');
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelMarkets').prop('disabled', false);
                            $('#spinnerAddMarkets').hide();
                            $('#spanAddMarkets').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }

    }
    let varietiesLoad = [];
    const loadVarieties = (farmId, varieties = [], type = 0) => {

        if (type == "1") {
            varieties = decodeB64Utf8(varieties);
            varietiesLoad = JSON.parse(varieties);
        } else {
            varietiesLoad = varieties;
        }
        $('#btnAddVarieties').attr('onclick', 'addVariety("' + farmId + '")');
        $("#modalVarieties").modal('show');
        $("#bodyModalVarieties").empty();
        if (varietiesLoad.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesVarieties" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Variedades</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            varietiesLoad.forEach((item, indice, array) => {
                item.farmId = farmId;
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += '<p><b><?= translate('nombre_lang') ?>: </b> ' + item.name + '</p>';
                texto_tabla += '</td>';

                texto_tabla += '<td>';

                texto_tabla += '<a class="btn btn-danger" href="javascript:void(0);"   onclick=deleteVariety("' + encodeB64Utf8(JSON.stringify(item)) + '");> Eliminar</a>';

                texto_tabla += '</td>';
                texto_tabla += '</tr>';
            });
            texto_tabla += '</tbody>';

            texto_tabla += '</table>'
            $("#bodyModalVarieties").html(texto_tabla);
            $("#datatablesVarieties").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#bodyModalVarieties').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }
    const addVariety = (farmId) => {
        $('#farmIdAddVariety').val(farmId);
        $('#modalVarieties').modal('hide');
        $('#modalAddVariety').modal({
            backdrop: false
        })
        $('#categories').empty();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('categoria/categories') ?>",
            success: function(result) {
                result = JSON.parse(result);
                if (result.status == 200) {
                    if (result.categories.length > 0) {
                        let cadenaCategories = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
                        result.categories.forEach(item => {
                            cadenaCategories += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.category_id + '">' + item.name + '</option>';
                        });
                        $('#categories').append(cadenaCategories);
                        $('#product').prop('disabled', true);
                    } else {
                        swal({
                            title: '¡Error!',
                            text: 'No se encontraron categorías',
                            padding: '2em'
                        });
                    }
                } else {
                    swal({
                        title: '¡Error!',
                        text: result.msj,
                        padding: '2em'
                    });
                }

            }
        });
    }
    const cancelAddVariety = () => {
        $("#modalAddVariety").modal('hide');
        $('#modalVarieties').modal({
            backdrop: false
        })
    }
    let productsLoad = null;

    $('[name=categories]').change(() => {
        productsLoad = null;
        $('#product').prop('disabled', true);
        $('#product').empty();
        let categorie = $('select[name=categories] option').filter(':selected').val();
        if (categorie != 0) {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('invoice_farm/search_products') ?>",
                data: {
                    categorie
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        if (result.products.length > 0) {
                            productsLoad = result.products;
                            let cadenaProducts = ' <option disabled itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';

                            result.products.forEach(item => {
                                if (varietiesLoad.length > 0) {
                                    let results = varietiesLoad.filter((element) => {
                                        return element.product_id == item.product_id;
                                    });
                                    let objVariety = (results.length > 0) ? results[0] : null;
                                    if (objVariety) {
                                        cadenaProducts += '<option selected itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>';
                                    } else {
                                        cadenaProducts += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>';
                                    }
                                } else {
                                    cadenaProducts += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>';
                                }

                            });
                            $('#product').append(cadenaProducts);
                            $('#product').prop('disabled', false);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: 'La categoria se encuentra sin productos',
                                padding: '2em'
                            });
                        }
                    } else {
                        swal({
                            title: '¡Error!',
                            text: result.msj,
                            padding: '2em'
                        });
                        $('#spinnerFinalize').hide();
                        $('#spanFinalize').text('<?= translate('finalize_lang') ?>');
                    }

                }
            });
        }

    })
    const submitAddVariety = () => {
        $('#btnCancelModalAddVariety').prop('disabled', true);
        let farmId = $('#farmIdAddVariety').val();
        let products = $('#product').val();
        if (products == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una variedad para continuar ',
                padding: '2em',
            })
        } else {
            $('#spinnerAddVariety').show();
            $('#spanAddVariety').text('<?= translate('processing_lang') ?>' + '...');
            let varieties = [];
            products.forEach((item) => {
                let results = productsLoad.filter((element) => {
                    return element.product_id == item;
                });
                let objVariety = (results.length > 0) ? results[0] : null;

                if (objVariety) {
                    varieties.push(objVariety);
                }
            });
            if (varietiesLoad.length > 0) {
                varieties.forEach(item => {
                    let results = varietiesLoad.filter((element) => {
                        return element.product_id == item.product_id;
                    });
                    let objVariety = (results.length > 0) ? results[0] : null;
                    if (!objVariety) {
                        varietiesLoad.push(item);
                    }
                });
            } else {
                varietiesLoad = varieties;
            }
            varietiesLoad = JSON.stringify(varietiesLoad);
           // return
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/add_varieties') ?>",
                    data: {
                        varietiesLoad,
                        farmId
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalAddVariety').modal('hide');
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
                                $('#btnCancelModalAddVariety').prop('disabled', false);
                                $('#spinnerAddVariety').hide();
                                $('#spanAddVariety').text('<?= translate('guardar_info_lang') ?>');
                                loadVarieties(farmId, result.data, '0');
                                varietiesLoad = result.data;
                                productsLoad = null;
                                $('#product').empty();
                                $('#btnManageVariety').attr('onclick', 'loadVarieties("' + farmId + '","' + encodeB64Utf8(JSON.stringify(result.data)) + '","1")');
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalAddVariety').prop('disabled', false);
                            $('#spinnerAddVariety').hide();
                            $('#spanAddVariety').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }
    const deleteVariety = (variety) => {
        variety = decodeB64Utf8(variety);
        variety = JSON.parse(variety);
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('farm/delete_variety') ?>",
                    data: {
                        productId: variety.product_id,
                        farmId: variety.farmId
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
                                varietiesLoad = result.data;
                                loadVarieties(variety.farmId, result.data, '0');
                                productsLoad = null;
                                $('#product').empty();
                                $('#btnManageVariety').attr('onclick', 'loadVarieties("' + variety.farmId + '","' + encodeB64Utf8(JSON.stringify(result.data)) + '","1")');
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                        }

                    }
                });
            }
        })
    }
</script>