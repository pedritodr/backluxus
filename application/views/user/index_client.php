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
                                                <p><b><?= translate('name_commercial_lang') ?>:</b> <?= $item->name_commercial ?></p>
                                                <p><b><?= translate('email_lang') ?>:</b> <?= $item->email ?></p>
                                            </td>
                                            <td>
                                                <?= $item->observations ?>
                                            </td>
                                            <td>
                                                <?php if ($item->address) { ?>
                                                    <p><b><?= translate('country_lang') ?>:</b> <?= $item->address->name ?></p>
                                                    <p><b><?= translate('ciudad_lang') ?>:</b> <?= $item->address->city->name ?></p>
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
                                                        <?php if (!$item->address) { ?>
                                                            <a style="cursor:pointer" onclick="addAdress('<?= $item->user_id; ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("add_location_lang"); ?></a>
                                                        <?php } else { ?>
                                                            <a style="cursor:pointer" onclick="editAdress('<?= base64_encode(json_encode($item->address)); ?>','<?= $item->user_id ?>');" class="dropdown-item"><i class="fa fa-remove"></i> <?= translate("edit_location_lang"); ?></a>
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
                                        <option itemId="<?= $item->country_id ?>" value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
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
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
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
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditAddress()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditAddress" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditAddress"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const sureUser = (pUserId)=> {
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
        console.log(address)
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
                    if(address.city.city_id==item.city_id){
                        cadena += '<option selected value="' + encodeB64Utf8(JSON.stringify(item)) + '" itemId="' + item.city_id + '">' + item.name + '</option>';
                    }else{
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
    $(()=> {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });
    $('[name=country]').change(() => {
        $('#citys').prop('disabled', true);
        $('#citys').empty();
        let country = $('select[name=country] option').filter(':selected').val();
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option value="' + encodeB64Utf8(JSON.stringify(item)) + '" itemId="' + item.city_id + '">' + item.name + '</option>'
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
    $('[name=countryEdit]').change(() => {
        $('#citys').prop('disabled', true);
        $('#citysEdit').empty();
        let country = $('select[name=countryEdit] option').filter(':selected').attr('itemId');
        if (country != 0) {
            country = JSON.parse(decodeB64Utf8(country));
            if (country.citys.length > 0) {
                let cadena = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
                country.citys.forEach(item => {
                    cadena += '<option value="' + encodeB64Utf8(JSON.stringify(item)) + '" itemId="' + item.city_id + '">' + item.name + '</option>'
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
    const submitAddAddress = () => {
        let country = $('select[name=country] option').filter(':selected').val();
        let city = $('select[name=citys] option').filter(':selected').val();
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
                            $('#spinnerAddAddress').hide();
                            $('#spanAddAddress').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }
    const submitEditAddress = () => {
        let country = $('select[name=countryEdit] option').filter(':selected').attr('itemId');
        let city = $('select[name=citysEdit] option').filter(':selected').val();
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
                            $('#spinnerEditAddress').hide();
                            $('#spanEditAddress').text('<?= translate('guardar_info_lang') ?>');
                        }
                    }
                });
            }, 1500)
        }
    }
</script>