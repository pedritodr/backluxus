<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_countrys_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('country/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_countrys_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_countrys) { ?>
                                    <?php foreach ($all_countrys as $item) { ?>
                                        <tr>
                                            <td> <?= $item->name; ?>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('country/update_index/' . $item->country_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="addCity('<?= $item->country_id ?>')" class="btn btn-info"><i class="fa fa-remove"></i> <?= translate("add_ciudad_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="loadCitys('<?= base64_encode(json_encode($item->citys)) ?>','1')" class="btn btn-primary"><i class="fa fa-remove"></i> <?= translate("citys_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="deleteCountry('<?= $item->country_id ?>')" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
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
<div class="modal fade" id="modalAddCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_ciudad_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("nombre_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" class="form-control input-sm" id="nameCityAdd" name="name" placeholder="<?= translate('nombre_lang'); ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="countryIdAdd">
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitAddCity()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerAddCity" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanAddCity"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEditCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('edit_ciudad_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("nombre_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input required type="text" id="nameCityEdit" class="form-control input-sm" name="name" placeholder="<?= translate('nombre_lang'); ?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="cityIdEdit">
                <input type="hidden" id="countryIdEdit">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="submitEditCity()" type="button" class="btn btn-primary"><i class="fa fa-check-square"></i>
                    <div style="display:none;    width: 17px;height: 17px;" id="spinnerEditCity" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                    <span id="spanEditCity"><?= translate('guardar_info_lang') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCitys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('citys_lang') ?></h5>
            </div>
            <div class="modal-body" id="bodyModalCitys">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }
    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }
    const deleteCountry = (countryId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("country/delete"); ?>' + '/' + countryId;
                window.location.href = urlDelete;
            }
        })
    }
    $(()=> {
        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });
    });
    const addCity = (countryId) => {
        $('#countryIdAdd').val(countryId);
        $('#modalAddCity').modal({
            backdrop: false
        })
    }
    const editCity = (city) => {
        city = decodeB64Utf8(city);
        city = JSON.parse(city);
        $('#cityIdEdit').val(city.city_id);
        $('#countryIdEdit').val(city.country_id);
        $('#nameCityEdit').val(city.name);
        $("#modalCitys").modal('hide');
        $('#modalEditCity').modal({
            backdrop: false
        })
    }
    const deleteCity = (city) => {
        city = decodeB64Utf8(city);
        city = JSON.parse(city);
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('country/delete_city') ?>",
                        data: {
                            cityId: city.city_id,
                            countryId: city.country_id
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                swal.close();
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
                                loadCitys(result.citys,0);
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: result.msj,
                                    padding: '2em'
                                });
                            }

                        }
                    });
                }, 1500)
            }
        })
    }
    const submitAddCity = () => {
        let nameCityAdd = $('#nameCityAdd').val().trim();
        let countryId = $('#countryIdAdd').val();
        if (nameCityAdd == "") {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo nombre no puede estar vacio',
                padding: '3em',
            })
        } else {
            $('#spinnerAddCity').show();
            $('#spanAddCity').text('<?= translate('processing_lang') ?>' + '...');
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('country/add_city') ?>",
                    data: {
                        nameCityAdd,
                        countryId
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalAddCity').modal('hide');
                            setTimeout(function() {
                                $('#spinnerAddCity').hide();
                                $('#spanAddCity').text('<?= translate('guardar_info_lang') ?>');
                            }, 1000);
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
                            loadCitys(result.citys,0);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#spinnerAddCity').hide();
                            $('#spanAddCity').text('<?= translate('guardar_info_lang') ?>');
                        }

                    }
                });
            }, 1500)
        }
    }
    const loadCitys = (citys=[],type=0) => {
        if(type=="1"){
            citys = decodeB64Utf8(citys);
        citys = JSON.parse(citys);
        }
        $("#modalCitys").modal('show');
        $("#bodyModalCitys").empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        if (citys.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesCitys" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Ciudades</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            citys.forEach((item, indice, array) => {

                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += item.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';

                texto_tabla += '<a class="btn btn-primary" href="javascript:void(0);"  onclick=editCity("' + encodeB64Utf8(JSON.stringify(item)) + '");> Editar</a>';
                texto_tabla += '<a class="btn btn-danger" href="javascript:void(0);"   onclick=deleteCity("' + encodeB64Utf8(JSON.stringify(item)) + '");> Eliminar</a>';

                texto_tabla += '</td>';
                texto_tabla += '</tr>';
            });
            texto_tabla += '</tbody>';

            texto_tabla += '</table>'
            $("#bodyModalCitys").html(texto_tabla);
            $("#datatablesCitys").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#bodyModalCitys').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }
    const submitEditCity = () => {
        let nameCityEdit = $('#nameCityEdit').val().trim();
        let cityId = $('#cityIdEdit').val();
        let countryId = $('#countryIdEdit').val();
        if (nameCityAdd == "") {
            const nameCityEdit = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo nombre no puede estar vacio',
                padding: '3em',
            })
        } else {
            $('#spinnerEditCity').show();
            $('#spanEditCity').text('<?= translate('processing_lang') ?>' + '...');
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('country/update_city') ?>",
                    data: {
                        nameCityEdit,
                        cityId,
                        countryId
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            $('#modalEditCity').modal('hide');
                            setTimeout(function() {
                                $('#spinnerEditCity').hide();
                                $('#spanEditCity').text('<?= translate('guardar_info_lang') ?>');
                            }, 1000);
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
                            loadCitys(result.citys,0);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                            $('#spinnerEditCity').hide();
                            $('#spanEditCity').text('<?= translate('guardar_info_lang') ?>');
                        }
                    }
                });
            }, 1500)
        }
    }
</script>