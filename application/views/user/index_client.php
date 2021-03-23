<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    #modalEditAddress {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalAddAddress {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalAddMarking {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalEditMarking {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalMarings {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalAddManagers {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalEditManagers {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalPersonLuxus {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_clients_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('user/add_index_client'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?>
            </a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_clients_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("data_lang"); ?></th>
                                    <th><?= translate("observations_lang"); ?></th>
                                    <th><?= translate("person_luxus_commercial_lang"); ?></th>
                                    <th><?= translate("direccion_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_users) { ?>
                                    <?php foreach ($all_users as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><b><?= translate('name_company_lang') ?>:</b> <?= $item->name_company ?></p>
                                                <p><b><?= translate('director_lang') ?>:</b> <?= $item->name_commercial ?></p>
                                                <p><b><?= translate('email_lang') ?>:</b> <?= $item->email ?></p>
                                                <p><b><?= translate('phone_lang') ?>:</b> <?= $item->phone ?></p>
                                            </td>
                                            <td>
                                                <?= $item->observations ?>
                                            </td>
                                            <td>
                                                <?php if (isset($item->person_luxus)) { ?>
                                                    <p><b><?= translate('nombre_lang') ?>:</b> <?= $item->person_luxus->name ?></p>
                                                    <p><b><?= translate('email_lang') ?>:</b> <?= $item->person_luxus->email ?></p>
                                                    <p><b><?= translate('phone_lang') ?>:</b> <?= $item->person_luxus->phone ?></p>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (isset($item->address)) { ?>
                                                    <?php if (($item->address)) { ?>
                                                        <p><b><?= translate('country_lang') ?>:</b> <?= $item->address->name ?></p>
                                                        <p><b><?= translate('ciudad_lang') ?>:</b> <?= $item->address->city->name ?></p>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($item->is_active == 1) { ?>
                                                    <span class="badge outline-badge-success"> <?= translate('active_lang') ?> </span>
                                                <?php } else if ($item->is_active == 2) { ?>
                                                    <span class="badge outline-badge-warning"> <?= translate('inactive_lang') ?> </span>
                                                <?php } else { ?>
                                                    <span class="badge outline-badge-danger"> <?= translate('management_lang') ?> </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="<?= site_url('user/update_index_client/' . $item->user_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                        <a class="dropdown-item" href="<?= site_url('user/change_status/' . $item->user_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("change_lang"); ?></a>
                                                        <?php $address = null; ?>
                                                        <?php if (isset($item->address)) { ?>
                                                            <?php if (!$item->address) { ?>
                                                                <?php $address = $item->address; ?>
                                                                <a style="cursor:pointer" onclick="addAdress('<?= $item->user_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("add_location_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <?php $address = $item->address; ?>
                                                                <a style="cursor:pointer" onclick="editAdress('<?= base64_encode(json_encode($item->address)); ?>','<?= $item->user_id ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("edit_location_lang"); ?></a>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" onclick="addAdress('<?= $item->user_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("add_location_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php $array = [] ?>
                                                        <?php if (isset($item->markings)) {
                                                            if (count($item->markings) > 0) { ?>
                                                                <a id="btnActionMarking" style="cursor:pointer" onclick="loadMarkings('<?= $item->user_id; ?>','<?= base64_encode(json_encode($item->markings)) ?>','1','<?= base64_encode(json_encode($address)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markings_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <a id="btnActionMarking" style="cursor:pointer" onclick="loadMarkings('<?= $item->user_id; ?>','<?= base64_encode(json_encode($array)) ?>','1','<?= base64_encode(json_encode($address)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markings_lang"); ?></a>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <a id="btnActionMarking" style="cursor:pointer" onclick="loadMarkings('<?= $item->user_id; ?>','<?= base64_encode(json_encode($array)) ?>','1','<?= base64_encode(json_encode($address)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("markings_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if (isset($item->managers)) {
                                                            if (count($item->managers) > 0) { ?>
                                                                <a id="btnActionManagers" style="cursor:pointer" onclick="loadManagers('<?= $item->user_id; ?>','<?= base64_encode(json_encode($item->managers)) ?>','1');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("managers_lang"); ?></a>
                                                            <?php } else { ?>
                                                                <a id="btnActionManagers" style="cursor:pointer" onclick="loadManagers('<?= $item->user_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("managers_lang"); ?></a>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <a id="btnActionManagers" style="cursor:pointer" onclick="loadManagers('<?= $item->user_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("managers_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if (isset($item->person_luxus)) { ?>
                                                            <a style="cursor:pointer" onclick="loadPersonLuxus('<?= $item->user_id; ?>','<?= base64_encode(json_encode($item->person_luxus)) ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" onclick="loadPersonLuxus('<?= $item->user_id; ?>','<?= false ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("person_luxus_commercial_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php if ($item->user_id != $this->session->userdata('user_id')) { ?>
                                                            <a onclick="sureUser('<?= $item->user_id; ?>');" class="dropdown-item btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                                        <?php } ?>
                                                    </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("data_lang"); ?></th>
                                    <th><?= translate("observations_lang"); ?></th>
                                    <th><?= translate("person_luxus_commercial_lang"); ?></th>
                                    <th><?= translate("direccion_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
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
<div class="modal fade" id="modalAddAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_location_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("countrys_lang"); ?></label>
                        <div class="input-group">
                            <select id="country" name="country" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($countrys) { ?>
                                    <?php foreach ($countrys as $item) { ?>
                                        <option value="<?= $item->country_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("citys_lang"); ?></label>
                        <div class="input-group">
                            <select id="citys" name="citys" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userIdAdd">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalAddAddress" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddAddress()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddAddress" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddAddress"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('edit_location_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("countrys_lang"); ?></label>
                        <div class="input-group">
                            <select id="countryEdit" name="countryEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($countrys) { ?>
                                    <?php foreach ($countrys as $item) { ?>
                                        <option value="<?= $item->country_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("citys_lang"); ?></label>
                        <div class="input-group">
                            <select id="citysEdit" name="citysEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userIdEdit">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalEditAddress" class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditAddress()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditAddress" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditAddress"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddMarking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_marking_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("marking_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="nameMarking" name="name" placeholder="<?= translate('marking_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label"><?= translate('comment_lang') ?></label>
                            <div id="editor-container1" class="form-control"></div>
                            <textarea style="display:none" name="comment" id="comment" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("countrys_lang"); ?></label>
                        <div class="input-group">
                            <select id="countryMarking" name="countryMarking" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($countrys) { ?>
                                    <?php foreach ($countrys as $item) { ?>
                                        <option value="<?= $item->country_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("citys_lang"); ?></label>
                        <div class="input-group">
                            <select id="citysMarking" name="citysMarking" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="clienteMarking">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalAddMarking" class="btn" onclick="cancelaAddMarking()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddMarking()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddMarking" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddMarking"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditMarking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('edit_marking_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("marking_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="nameMarkingEdit" placeholder="<?= translate('marking_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label"><?= translate('comment_lang') ?></label>
                            <div id="editor-container1Edit" class="form-control"></div>
                            <textarea style="display:none" name="commentEdit" id="commentEdit" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("countrys_lang"); ?></label>
                        <div class="input-group">
                            <select id="countryMarkingEdit" name="countryMarkingEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($countrys) { ?>
                                    <?php foreach ($countrys as $item) { ?>
                                        <option value="<?= $item->country_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("citys_lang"); ?></label>
                        <div class="input-group">
                            <select id="citysMarkingEdit" name="citysMarkingEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="clienteMarkingEdit">
                <input type="hidden" id="markingId">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalEditMarking" class="btn" onclick="cancelEditMarking()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditMarking()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditMarking" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditMarking"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalMarings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('markings_lang') ?></h5> <a id="btnAddMarking" onclick="" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_marking_lang'); ?>
                </a>
            </div>
            <div class="modal-body" id="bodyModalMarkings">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddManagers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_manager_lang') ?></h5>
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
                        <label><?= translate("functions_lang"); ?></label>
                        <div class="input-group">
                            <select id="functions" name="functions" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if (isset($roles)) { ?>
                                    <?php if ($roles) { ?>
                                        <?php foreach ($roles as $rol) { ?>
                                            <option value="<?= $rol->role_id ?>"><?= $rol->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userIdManager">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalAddManager" class="btn" onclick="cancelAddManager()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddManager()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
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
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('managers_lang') ?></h5> <a id="btnAddManager" onclick="" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_manager_lang'); ?></a>
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
                        <label><?= translate("functions_lang"); ?></label>
                        <div class="input-group">
                            <select id="functionsEdit" name="functionsEdit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if (isset($roles)) { ?>
                                    <?php if ($roles) { ?>
                                        <?php foreach ($roles as $rol) { ?>
                                            <option value="<?= $rol->role_id ?>"><?= $rol->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userIdEditManager">
                <input type="hidden" id="managerId">
            </div>
            <div class="modal-footer">
                <button id="btnCancelModalEditManager" class="btn" onclick="cancelEditManager()"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditManager()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditManager" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditManager"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
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
                                        <option value="<?= $item->user_id ?>" itemId="<?= base64_encode(json_encode($item)) ?>"><?= $item->name . ' ' . $item->surname ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userIdPerson">
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
    const sureUser = (pUserId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("user/delete_cliente"); ?>' + '/' + pUserId;
                window.location.href = urlDelete;
            }
        })
    }

    const addAdress = (userId) => {
        $('#citys').prop('disabled', true);
        $('#userIdAdd').val(userId);
        $('#modalAddAddress').modal({
            backdrop: false
        })
    }

    const editAdress = (address, userId) => {
        address = JSON.parse(decodeB64Utf8(address));
        $('#userIdEdit').val(userId);
        $('#modalEditAddress').modal({
            backdrop: false
        })
        $('#countryEdit').val(address.country_id);
        let country = $('select[name=countryEdit] option').filter(':selected').attr('itemId');
        country = JSON.parse(decodeB64Utf8(country));
        if (country.citys.length > 0) {
            let cadena = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
            country.citys.forEach(item => {
                if (address.city.city_id == item.city_id) {
                    cadena += '<option selected value="' + encodeB64Utf8(JSON.stringify(item)) + '" itemId="' + item.city_id + '">' + item.name + '</option>';
                } else {
                    cadena += '<option value="' + encodeB64Utf8(JSON.stringify(item)) + '" itemId="' + item.city_id + '">' + item.name + '</option>';
                }

            });
            $('#citysEdit').append(cadena);
        } else {
            swal({
                title: '¡Error!',
                text: 'El país se encuentra sin ciudades',
                padding: '2em'
            });
        }
    }

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    let quill;
    let quillEdit;

    $(() => {

        $("#functions").select2({
            tags: true,
            dropdownParent: $("#modalAddManagers"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: true,
        });

        $("#functionsEdit").select2({
            tags: true,
            dropdownParent: $("#modalEditManagers"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: true,
        });

        quill = new Quill('#editor-container1', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: '<?= translate("comment_lang"); ?>...',
            theme: 'snow' // or 'bubble'
        });

        quillEdit = new Quill('#editor-container1Edit', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: '<?= translate("comment_lang"); ?>...',
            theme: 'snow' // or 'bubble'
        });

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });
    });

    $('[name=countryMarking]').change(() => {
        $('#citysMarking').prop('disabled', true);
        $('#citysMarking').empty();
        let country = $('select[name=countryMarking] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                });
                $('#citysMarking').append(cadena);
                $('#citysMarking').prop('disabled', false);
            } else {
                swal({
                    title: '¡Error!',
                    text: 'El país se encuentra sin ciudades',
                    padding: '2em'
                });
            }
        } else {
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
        }

    })

    $('[name=countryEdit]').change(() => {
        $('#citys').prop('disabled', true);
        $('#citysEdit').empty();
        let country = $('select[name=countryEdit] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                });
                $('#citysEdit').append(cadena);
                $('#citysEdit').prop('disabled', false);
            } else {
                swal({
                    title: '¡Error!',
                    text: 'El país se encuentra sin ciudades',
                    padding: '2em'
                });
            }
        } else {
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
        }

    })

    $('[name=country]').change(() => {
        $('#citys').prop('disabled', true);
        $('#citys').empty();
        let country = $('select[name=country] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                });
                $('#citys').append(cadena);
                $('#citys').prop('disabled', false);
            } else {
                swal({
                    title: '¡Error!',
                    text: 'El país se encuentra sin ciudades',
                    padding: '2em'
                });
            }
        } else {
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
        }

    })

    const submitAddAddress = () => {
        $('#btnCancelModalAddAddress').prop('disabled', true);
        let country = $('select[name=country] option').filter(':selected').attr('itemId');
        let city = $('select[name=citys] option').filter(':selected').attr('itemId');
        let userIdAdd = $('#userIdAdd').val();
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
                title: 'Seleccione un país para continuar',
                padding: '3em',
            })
        } else if (city == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una ciudad',
                padding: '3em',
            })
        } else {
            country = JSON.parse(decodeB64Utf8(country));
            city = JSON.parse(decodeB64Utf8(city));
            $('#spinnerAddAddress').show();
            $('#spanAddAddress').text('<?= translate('processing_lang') ?>' + '...');
            let objectCity = {
                city_id: city.city_id,
                name: city.name,
            }
            let objectCountry = {
                country_id: country.country_id,
                name: country.name,
                city: objectCity
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('user/add_address') ?>",
                    data: {
                        objectCountry,
                        userIdAdd
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalAddCity').modal('hide');
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
                                $('#btnCancelModalAddAddress').prop('disabled', false);
                                $('#spinnerAddAddress').hide();
                                $('#spanAddAddress').text('<?= translate('guardar_info_lang') ?>');
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalAddAddress').prop('disabled', false);
                            $('#spinnerAddAddress').hide();
                            $('#spanAddAddress').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }

    const submitEditAddress = () => {
        $('#btnCancelModalEditAddress').prop('disabled', true);
        let country = $('select[name=countryEdit] option').filter(':selected').attr('itemId');
        let city = $('select[name=citysEdit] option').filter(':selected').attr('itemId');
        let userIdAdd = $('#userIdEdit').val();
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
                title: 'Seleccione un país para continuar',
                padding: '3em',
            })
        } else if (city == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una ciudad',
                padding: '3em',
            })
        } else {
            country = JSON.parse(decodeB64Utf8(country));
            city = JSON.parse(decodeB64Utf8(city));
            $('#spinnerEditAddress').show();
            $('#spanEditAddress').text('<?= translate('processing_lang') ?>' + '...');
            let objectCity = {
                city_id: city.city_id,
                name: city.name,
            }
            let objectCountry = {
                country_id: country.country_id,
                name: country.name,
                city: objectCity
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('user/add_address') ?>",
                    data: {
                        objectCountry,
                        userIdAdd
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalEditAddress').modal('hide');
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
                                $('#btnCancelModalEditAddress').prop('disabled', false);
                                $('#spinnerEditAddress').hide();
                                $('#spanEditAddress').text('<?= translate('guardar_info_lang') ?>');
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalEditAddress').prop('disabled', false);
                            $('#spinnerEditAddress').hide();
                            $('#spanEditAddress').text('<?= translate('guardar_info_lang') ?>');
                        }
                    }
                });
            }, 1500)
        }
    }

    const addMarking = (userId, address) => {
        address = decodeB64Utf8(address);
        address = JSON.parse(address);
        $('#citysMarking').empty();
        if (address) {
            $('#countryMarking').val(address.country_id);
            let country = $('select[name=countryMarking] option').filter(':selected').attr('itemId');
            if (country != 0) {
                country = JSON.parse(decodeB64Utf8(country));
                if (country.citys.length > 0) {
                    let cadena = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                    country.citys.forEach(item => {
                        if (address.city.city_id == item.city_id) {
                            cadena += '<option selected itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                        } else {
                            cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                        }
                    });
                    $('#citysMarking').append(cadena);
                    $('#citysMarking').prop('disabled', false);
                } else {
                    swal({
                        title: '¡Error!',
                        text: 'El país se encuentra sin ciudades',
                        padding: '2em'
                    });
                }
            } else {
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
            }
        } else {
            $('#citysMarking').prop('disabled', true);
        }
        $('#clienteMarking').val(userId);
        $('#modalMarings').modal('hide');
        $('#modalAddMarking').modal({
            backdrop: false
        });
    }

    const initQuill = (html) => {
        let delta = quillEdit.clipboard.convert(html);
        quillEdit.setContents(delta, 'silent');
    }

    const editMarking = (objectMarking) => {

        objectMarking = decodeB64Utf8(objectMarking);
        objectMarking = JSON.parse(objectMarking);
        $("#modalMarings").modal('hide');
        $('#clienteMarkingEdit').val(objectMarking.userId);
        if (typeof objectMarking.comment !== 'undefined') {
            if (objectMarking.comment != '') {
                initQuill(objectMarking.comment);
            }
        }
        $('#nameMarkingEdit').val(objectMarking.name_marking);
        $('#countryMarkingEdit').val(objectMarking.country.country_id);
        $('#markingId').val(objectMarking.marking_id);
        let country = $('select[name=countryMarkingEdit] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    if (objectMarking.country.city.city_id == item.city_id) {
                        cadena += '<option selected itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                    } else {
                        cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                    }
                });
                $('#citysMarkingEdit').append(cadena);
                $('#citysMarkingEdit').prop('disabled', false);
            } else {
                swal({
                    title: '¡Error!',
                    text: 'El país se encuentra sin ciudades',
                    padding: '2em'
                });
            }
        } else {
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
        }
        $('#modalEditMarking').modal({
            backdrop: false
        })
    }

    const submitAddMarking = () => {
        $('#btnCancelModalAddMarking').prop('disabled', true);
        let country = $('select[name=countryMarking] option').filter(':selected').attr('itemId');
        console.log('country', country);
        let city = $('select[name=citysMarking] option').filter(':selected').attr('itemId');
        let userIdAdd = $('#clienteMarking').val();
        let nameMarking = $('#nameMarking').val();
        let comment = $('#editor-container1').text();
        console.log('city2', city);
        if (nameMarking == '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El nombre de la marcación es requerida',
                padding: '3em',
            })
        } else if (country == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un país para continuar',
                padding: '3em',
            })
        } else if (city == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una ciudad',
                padding: '3em',
            })
        } else {
            country = JSON.parse(decodeB64Utf8(country));
            city = JSON.parse(decodeB64Utf8(city));
            $('#spinnerAddMarking').show();
            $('#spanAddMarking').text('<?= translate('processing_lang') ?>' + '...');
            let objectCity = {
                city_id: city.city_id,
                name: city.name,
            }
            let objectCountry = {
                country_id: country.country_id,
                name: country.name,
                city: objectCity
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('user/add_marking') ?>",
                    data: {
                        objectCountry,
                        userIdAdd,
                        nameMarking,
                        comment
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalAddMarking').modal('hide');
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
                                $('#btnCancelModalAddMarking').prop('disabled', false);
                                $('#spinnerAddMarking').hide();
                                $('#spanAddMarking').text('<?= translate('guardar_info_lang') ?>');
                                //location.reload();
                                loadMarkings(userIdAdd, result.markings, '0');
                                $('#btnActionMarking').attr('onclick', 'loadMarkings("' + userIdAdd + '","' + encodeB64Utf8(JSON.stringify(result.markings)) + '","1")');

                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalAddMarking').prop('disabled', false);
                            $('#spinnerAddMarking').hide();
                            $('#spanAddMarking').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }

    const loadMarkings = (user_id, markings = [], type = 0, address = null) => {
        if (type == "1") {
            markings = decodeB64Utf8(markings);
            markings = JSON.parse(markings);
        }
        $("#modalMarings").modal('show');
        $('#btnAddMarking').attr('onclick', 'addMarking("' + user_id + '","' + address + '")');
        $("#bodyModalMarkings").empty();
        if (markings.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesMarkings" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Marking</th>';
            texto_tabla += '<th>Comentario</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            markings.forEach((item, indice, array) => {
                item.userId = user_id;
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += '<p><b><?= translate('marking_lang') ?>: </b> ' + item.name_marking + '</p>';
                texto_tabla += '<p><b><?= translate('country_lang') ?>: </b> ' + item.country.name + '</p>';
                texto_tabla += '<p><b><?= translate('ciudad_lang') ?>: </b> ' + item.country.city.name + '</p>';
                texto_tabla += '</td>';
                texto_tabla += '<td>';
                if (typeof item.comment !== 'undefined') {
                    texto_tabla += '<p>' + item.comment + '</p>';
                }
                texto_tabla += ' </td>'
                texto_tabla += '<td>';

                texto_tabla += '<a class="btn btn-primary" href="javascript:void(0);"  onclick=editMarking("' + encodeB64Utf8(JSON.stringify(item)) + '");> Editar</a>';
                texto_tabla += '<a class="btn btn-danger" href="javascript:void(0);"   onclick=deleteMarking("' + encodeB64Utf8(JSON.stringify(item)) + '");> Eliminar</a>';

                texto_tabla += '</td>';
                texto_tabla += '</tr>';
            });
            texto_tabla += '</tbody>';
            texto_tabla += '</table>'
            $("#bodyModalMarkings").html(texto_tabla);
            $("#datatablesMarkings").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#bodyModalMarkings').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    const cancelaAddMarking = () => {
        $("#modalAddMarking").modal('hide');
        $('#modalMarings').modal({
            backdrop: false
        })
    }

    const cancelEditMarking = () => {
        $("#modalEditMarking").modal('hide');
        $('#modalMarings').modal({
            backdrop: false
        })
    }

    $('[name=countryMarkingEdit]').change(() => {
        $('#citysMarkingEdit').prop('disabled', true);
        $('#citysMarkingEdit').empty();
        let country = $('select[name=countryMarkingEdit] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.city_id + '">' + item.name + '</option>'
                });
                $('#citysMarkingEdit').append(cadena);
                $('#citysMarkingEdit').prop('disabled', false);
            } else {
                swal({
                    title: '¡Error!',
                    text: 'El país se encuentra sin ciudades',
                    padding: '2em'
                });
            }
        } else {
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
        }

    })

    const submitEditMarking = () => {
        $('#btnCancelModalEditMarking').prop('disabled', true);
        let country = $('select[name=countryMarkingEdit] option').filter(':selected').attr('itemId');
        let city = $('select[name=citysMarkingEdit] option').filter(':selected').attr('itemId');
        let userIdAdd = $('#clienteMarkingEdit').val();
        let nameMarking = $('#nameMarkingEdit').val();
        let comment = $('#editor-container1Edit').text();
        let markingId = $('#markingId').val();
        if (nameMarking == '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El nombre de la marcación es requerida',
                padding: '3em',
            })
        } else if (country == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un país para continuar',
                padding: '3em',
            })
        } else if (city == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una ciudad',
                padding: '3em',
            })
        } else {
            country = JSON.parse(decodeB64Utf8(country));
            city = JSON.parse(decodeB64Utf8(city));
            $('#spinnerEditMarking').show();
            $('#spanEditMarking').text('<?= translate('processing_lang') ?>' + '...');
            let objectCity = {
                city_id: city.city_id,
                name: city.name,
            }
            let objectCountry = {
                country_id: country.country_id,
                name: country.name,
                city: objectCity
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('user/edit_marking') ?>",
                    data: {
                        objectCountry,
                        userIdAdd,
                        nameMarking,
                        comment,
                        markingId
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalEditMarking').modal('hide');
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
                                $('#spinnerEditMarking').hide();
                                $('#btnCancelModalEditMarking').prop('disabled', false);
                                $('#spanEditMarking').text('<?= translate('guardar_info_lang') ?>');
                                loadMarkings(userIdAdd, result.markings, '0');
                                $('#btnActionMarking').attr('onclick', 'loadMarkings("' + userIdAdd + '","' + encodeB64Utf8(JSON.stringify(result.markings)) + '","1")');
                                //location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalEditMarking').prop('disabled', false);
                            $('#spinnerEditMarking').hide();
                            $('#spanEditMarking').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }

    const deleteMarking = function(marking) {
        marking = decodeB64Utf8(marking);
        marking = JSON.parse(marking);
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
                    url: "<?= site_url('user/delete_marking') ?>",
                    data: {
                        userIdAdd: marking.userId,
                        markingId: marking.marking_id
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
                                loadMarkings(marking.userId, result.markings, '0');
                                $('#btnActionMarking').attr('onclick', 'loadMarkings("' + marking.userId + '","' + encodeB64Utf8(JSON.stringify(result.markings)) + '","1")');
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

    const addManager = (userId) => {
        $('#userIdManager').val(userId);
        $('#modalManagers').modal('hide');
        $('#modalAddManagers').modal({
            backdrop: false
        });
        $('#nameManager').val('');
        $('#emailManager').val('');
        $('#phoneManager').val('');
        $('#functions').val(0);
        $('#functions').trigger('change');
    }

    const submitAddManager = () => {
        $('#btnCancelModalAddManager').prop('disabled', true);
        let functions = $('select[name=functions] option').filter(':selected').val();
        let userId = $('#userIdManager').val();
        let name = $('#nameManager').val().trim();
        let phone = $('#phoneManager').val().trim();
        let email = $('#emailManager').val().trim();
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

            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('user/add_manager') ?>",
                    data: {
                        name,
                        email,
                        phone,
                        functions,
                        userId
                    },
                    success: function(result) {
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
                                loadManagers(userId, result.managers, '0');
                                $('#btnActionManagers').attr('onclick', 'loadManagers("' + userId + '","' + encodeB64Utf8(JSON.stringify(result.managers)) + '","1")');
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

                    }
                });
            }, 1500)
        }
    }

    const loadManagers = (user_id, managers = [], type = 0) => {
        if (type == "1") {
            managers = decodeB64Utf8(managers);
            managers = JSON.parse(managers);
        }
        $('#btnAddManager').attr('onclick', 'addManager("' + user_id + '")');
        $("#modalManagers").modal('show');
        $("#bodyModalManagers").empty();
        if (managers.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesManagers" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Encargados</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            managers.forEach((item, indice, array) => {
                item.userId = user_id;
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += '<p><b><?= translate('nombre_lang') ?>: </b> ' + item.name + '</p>';
                texto_tabla += '<p><b><?= translate('email_lang') ?>: </b> ' + item.email + '</p>';
                texto_tabla += '<p><b><?= translate('phone_lang') ?>: </b> ' + item.phone + '</p>';
                if (typeof item.function !== 'undefined') {
                    if (typeof item.function.name !== 'undefined') {
                        texto_tabla += '<p><b><?= translate('function_lang') ?>: </b> ' + item.function.name + '</p>';
                    }
                }
                texto_tabla += '</td>';

                texto_tabla += '<td>';

                texto_tabla += '<a class="btn btn-primary" href="javascript:void(0);"  onclick=editManager("' + encodeB64Utf8(JSON.stringify(item)) + '");> Editar</a>';
                texto_tabla += '<a class="btn btn-danger" href="javascript:void(0);"   onclick=deleteManager("' + encodeB64Utf8(JSON.stringify(item)) + '");> Eliminar</a>';

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

    const editManager = (objectManager) => {

        objectManager = decodeB64Utf8(objectManager);
        objectManager = JSON.parse(objectManager);
        $("#modalManagers").modal('hide');
        $('#nameEditManager').val(objectManager.name);
        $('#phoneEditManager').val(objectManager.phone);
        $('#emailEditManager').val(objectManager.email);
        if (typeof objectManager.function !== 'undefined') {
            if (typeof objectManager.function.name !== 'undefined') {
                $('#functionsEdit').val(objectManager.function.role_id);
                $('#functionsEdit').trigger('change');
            } else {
                $('#functionsEdit').val(0);
                $('#functionsEdit').trigger('change');
            }
        } else {
            $('#functionsEdit').val(0);
            $('#functionsEdit').trigger('change');
        }
        $('#managerId').val(objectManager.manager_id);
        $('#userIdEditManager').val(objectManager.userId);
        $('#modalEditManagers').modal({
            backdrop: false
        })
    }

    const cancelEditManager = () => {
        $("#modalEditManagers").modal('hide');
        $('#modalManagers').modal({
            backdrop: false
        })
    }

    const cancelAddManager = () => {
        $("#modalAddManagers").modal('hide');
        $('#modalManagers').modal({
            backdrop: false
        })
    }

    const submitEditManager = () => {
        $('#btnCancelModalEditManager').prop('disabled', true);
        let functions = $('select[name=functionsEdit] option').filter(':selected').val();
        let userId = $('#userIdEditManager').val();
        let managerId = $('#managerId').val();
        let name = $('#nameEditManager').val().trim();
        let phone = $('#phoneEditManager').val().trim();
        let email = $('#emailEditManager').val().trim();
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
                    url: "<?= site_url('user/update_manager') ?>",
                    data: {
                        name,
                        email,
                        phone,
                        functions,
                        userId,
                        managerId
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
                                loadManagers(userId, result.managers, '0');
                                $('#btnActionManagers').attr('onclick', 'loadManagers("' + userId + '","' + encodeB64Utf8(JSON.stringify(result.managers)) + '","1")');
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

    const deleteManager = (manager) => {
        manager = decodeB64Utf8(manager);
        manager = JSON.parse(manager);
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
                    url: "<?= site_url('user/delete_manager') ?>",
                    data: {
                        userId: manager.userId,
                        managerId: manager.manager_id
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
                                loadManagers(manager.userId, result.managers, '0');
                                $('#btnActionManagers').attr('onclick', 'loadManagers("' + manager.userId + '","' + encodeB64Utf8(JSON.stringify(result.managers)) + '","1")');
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

    const loadPersonLuxus = (userId, object) => {
        $('#userIdPerson').val(userId);
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
        let userId = $('#userIdPerson').val();
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
                    url: "<?= site_url('user/add_person_luxus') ?>",
                    data: {
                        userId,
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
                                $('#btnCancelModalPersonLuxus').prop('disabled', false);
                                $('#spanPersonLuxus').text('<?= translate('guardar_info_lang') ?>');
                                location.reload();
                            }, 1000);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#btnCancelModalPersonLuxus').prop('disabled', false);
                            $('#spinnerEditManager').hide();
                            $('#spanEditManager').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }

    }
</script>