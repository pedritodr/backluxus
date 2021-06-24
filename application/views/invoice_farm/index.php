<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    #modalDetails {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalFixedOrder {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalDetailsFixedOrder {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalComision {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>admin_template/assets/css/forms/theme-checkbox-radio.css">
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?= base_url('admin_template/assets/css/elements/alert.css') ?>">
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_invoice_farms_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('invoice_farm/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <?php if ($all_fixed_orders) { ?>
            <?php if (count($all_fixed_orders) > 0) { ?>
                <div class="alert custom-alert-1 mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></button>
                    <div class="media">
                        <div class="alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>
                        </div>
                        <div class="media-body">
                            <div class="alert-text"><span> <?= translate('msg_fixed_order_lang') ?></span>
                            </div>
                            <div class="alert-btn">
                                <button type="button" class="btn btn-default btn-dismiss" onclick="handleShowFixedOrder()"><?= translate('eye_fixed_order_lang') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_invoice_farms_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("markings_lang"); ?></th>
                                    <th><?= translate("data_lang"); ?></th>
                                    <th><?= translate("farms_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_invoice_farm) { ?>
                                    <?php foreach ($all_invoice_farm as $item) {
                                        if (count($item->details) > 0) {
                                            $acumHb = 0;
                                            $acumQb = 0;
                                            $acumEb = 0;
                                            foreach ($item->details as $element) {

                                                if (trim(strtoupper($element->typeBoxs->name)) === "HB") {
                                                    $acumHb += (int)$element->boxNumber;
                                                } else if (trim(strtoupper($element->typeBoxs->name)) === "QB") {
                                                    $acumQb += (int)$element->boxNumber;
                                                } else {
                                                    $acumEb += (int)$element->boxNumber;
                                                }
                                            }
                                            $fulles = ($acumHb * 0.50) + ($acumQb * 0.25) + ($acumEb * 0.125);
                                            if ($acumEb > 0) {
                                                $fulles = number_format($fulles, 3);
                                            } else {
                                                $fulles = number_format($fulles, 2);
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <p><?= $item->markings->name_company . ' | ' . $item->markings->name_commercial ?></p>
                                                <p><b><?= translate("marking_lang"); ?>: <?= $item->markings->name_marking ?></b></p>
                                                <?php

                                                if (property_exists($item->markings, 'comision')) {
                                                    echo '<p><b>' . translate("comision_lang") . ': ' . number_format($item->markings->comision, 2) . '%</b></p>';
                                                } else {
                                                    if ($item->farms->farm_id === 'farm_60256e217cb10') {
                                                        echo '<p><b>' . translate("comision_lang") . ':0.00%</b></p>';
                                                    } else {
                                                        echo '<p><b>' . translate("comision_lang") . ':8.00%</b></p>';
                                                    }
                                                }
                                                if (property_exists($item, 'packing')) {
                                                    echo '<b>' . translate("packing_lang") . ':</b> ';
                                                    printf('%02d', $item->packing);
                                                } else {
                                                    echo '<span class="badge outline-badge-warning">' . translate('invoice_wait_lang') . ' </span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <p><strong><?= translate("invoice_number_lang"); ?> : </strong>
                                                    <?php
                                                    echo  $item->invoice_number . ' - ' . $fulles . ' (' . $acumHb . 'HB, ' . $acumQb . 'QB, ' . $acumEb . 'EB)';
                                                    ?>
                                                </p>
                                                <p><strong><?= translate("dispatch_lang"); ?> : </strong>
                                                    <?php if (isset($item->dispatch_day)) {
                                                        $newDate = date("d.m.y", strtotime($item->dispatch_day));
                                                        echo  $newDate;
                                                    } ?>
                                                </p>
                                                <p><strong><?= translate("awb_lang"); ?> : </strong><?= $item->awb; ?></p>
                                            </td>
                                            <td>
                                                <p><?= $item->farms->name_commercial; ?></p>
                                                <p><?= $item->farms->name_legal; ?></p>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="verDetails('<?= base64_encode(json_encode($item->details)) ?>')"><i class="fa fa-edit"></i> <?= translate("details_lang"); ?></a>
                                                        <?php if (in_array($this->session->userdata('role_id'), [1, 2])) { ?>
                                                            <a class="dropdown-item" href="javascript:void(0)" onclick="handleComision('<?= base64_encode(json_encode($item))  ?>')"><i class="fa fa-edit"></i> <?= translate("comision_lang"); ?></a>
                                                        <?php } ?>
                                                        <?php
                                                        $separado = explode(' ', $item->date_create);
                                                        $dateCreate = $separado[0];
                                                        $dateDays =  date("Y-m-d", strtotime($dateCreate . "+ 2 week"));
                                                        if (strtotime(date('Y-m-d')) <= strtotime($dateDays)) {
                                                            if (in_array($this->session->userdata('role_id'), [1, 2, 7, 6, 5, 4, 3])) {
                                                                if (property_exists($item, 'packing')) {
                                                                    if (in_array($this->session->userdata('role_id'), [1, 2, 3])) {
                                                                        echo '<a class="dropdown-item" href="' . site_url('invoice_farm/update_invoice_farm_index/' . $item->invoice_farm) . '"><i class="fa fa-edit"></i>' . translate("update_invoice_farm_lang") . '</a>';
                                                                    } else {
                                                                        $arrValid = [];
                                                                        if (property_exists($item->farms, 'person_luxus')) {
                                                                            foreach ($item->farms->person_luxus as $person) {
                                                                                $arrValid[] = $person->user_id;
                                                                            }
                                                                            if (in_array($this->session->userdata('user_id'), $arrValid)) {
                                                                                if (in_array($this->session->userdata('role_id'), [1, 7, 6, 5])) {
                                                                                    echo '<a class="dropdown-item" href="' . site_url('invoice_farm/update_invoice_farm_index/' . $item->invoice_farm) . '"><i class="fa fa-edit"></i>' . translate("update_invoice_farm_lang") . '</a>';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '<a class="dropdown-item" href="' . site_url('invoice_farm/update_invoice_farm_index/' . $item->invoice_farm) . '"><i class="fa fa-edit"></i>' . translate("update_invoice_farm_lang") . '</a>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("markings_lang"); ?></th>
                                    <th><?= translate("data_lang"); ?></th>
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
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('details_lang') ?></h5>
            </div>
            <div class="modal-body table-responsive" id="bodyModalDetails">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFixedOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('listar_order_fixed_lang') ?></h5>
            </div>
            <div class="modal-body table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?= translate("markings_lang"); ?></th>
                            <th><?= translate("data_lang"); ?></th>
                            <th><?= translate("farms_lang"); ?></th>
                            <th><?= translate("actions_lang"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($all_fixed_orders) { ?>
                            <?php foreach ($all_fixed_orders as $item) { ?>
                                <tr>
                                    <td>
                                        <p><?= $item->markings->name_company . ' | ' . $item->markings->name_commercial ?></p>
                                        <p><b><?= translate("marking_lang"); ?>: <?= $item->markings->name_marking ?></b></p>
                                    </td>
                                    <td>
                                        <p><strong><?= translate("number_order_lang"); ?> : </strong><?= $item->invoice_number; ?></p>
                                        <?php if ($item->dispatch_day == 1) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("monday_lang") . '</p>';
                                        } else if ($item->dispatch_day == 2) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("tuesday_lang") . '</p>';
                                        } else if ($item->dispatch_day == 3) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("wednesday_lang") . '</p>';
                                        } else if ($item->dispatch_day == 4) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("thursdaylang") . '</p>';
                                        } else if ($item->dispatch_day == 5) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("friday_lang") . '</p>';
                                        } else if ($item->dispatch_day == 6) {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("saturday_lang") . '</p>';
                                        } else {
                                            echo ' <p><strong>' . translate("dispatch_day_lang") . ' : </strong>' . translate("sunday_lang") . '</p>';
                                        }
                                        if ($item->dayCreate == 1) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("monday_lang") . '</p>';
                                        } else if ($item->dayCreate == 2) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("tuesday_lang") . '</p>';
                                        } else if ($item->dayCreate == 3) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("wednesday_lang") . '</p>';
                                        } else if ($item->dayCreate == 4) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("thursdaylang") . '</p>';
                                        } else if ($item->dayCreate == 5) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("friday_lang") . '</p>';
                                        } else if ($item->dayCreate == 6) {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("saturday_lang") . '</p>';
                                        } else {
                                            echo ' <p><strong>' . translate("day_create_order_lang") . ' : </strong>' . translate("sunday_lang") . '</p>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <p><?= $item->farms->name_commercial; ?></p>
                                        <p><?= $item->farms->address_farm; ?></p>
                                    </td>
                                    <td>
                                        <div class="btn-group mb-4 mr-2" role="group">
                                            <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg></button>
                                            <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="verDetailsFixedOrder('<?= base64_encode(json_encode($item->details)) ?>')"><i class="fa fa-edit"></i> <?= translate("details_lang"); ?></a>

                                            </div>
                                        </div>
                                        <div class="n-chk" style="margin-top:8px"><label class="new-control new-checkbox checkbox-outline-secondary new-checkbox-text"><input type="checkbox" class="new-control-input" id="check<?= $item->fixed_orders ?>" onclick="handleSelectedOrder('<?= base64_encode(json_encode($item)) ?>')"><span class="new-control-indicator"></span><span class="new-chk-content" id="spanCheck<?= $item->fixed_orders ?>"><?= translate('selected_order_fixed_lang') ?></span></label> </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?= translate("markings_lang"); ?></th>
                            <th><?= translate("data_lang"); ?></th>
                            <th><?= translate("farms_lang"); ?></th>
                            <th><?= translate("actions_lang"); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button class="btn btn-success" id="btnGenerateFixedOrder" onclick="handleSubmitOrderFixed()"><?= translate('generate_order_fixed_lang') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailsFixedOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('details_lang') ?></h5>
            </div>
            <div class="modal-body table-responsive" id="bodyModalDetailsFixedOrder">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalComision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('comision_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                    <input autocomplete="new-comision" type="number" step=any class="form-control input-sm" id="comision" required placeholder="<?= translate('comision_lang') ?>">
                    <input type="hidden" id="invoiceFarmComision">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button class="btn btn-primary" onclick="handleSubmitUpdateComision()">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            "ordering": false
        });
        $("#example2").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });
    const handleComision = (object) => {
        object = JSON.parse(decodeB64Utf8(object));

        if (object.markings.comision !== undefined) {
            $('#comision').val(object.markings.comision);
        } else {
            if (object.farms.farm_id === 'farm_60256e217cb10') {
                $('#comision').val(0);
            } else {
                $('#comision').val(8);
            }
        }
        $('#invoiceFarmComision').val(object.invoice_farm);
        $('#modalComision').modal('show');
    }

    const handleSubmitUpdateComision = () => {
        const comision = $('#comision').val();
        const invoice = $('#invoiceFarmComision').val();
        if (comision === '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: 'La comisión no puede estar en vacía',
                padding: '2em',
            })
        } else {
            $('#modalComision').modal('hide');
            Swal.fire({
                title: 'Completando operación',
                text: 'Actualizando la comisión...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });

            let data = {
                comision,
                invoice
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/update_comision') ?>",
                    data: data,
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
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.close();
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
    }

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }
    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const verDetails = (details) => {
        details = decodeB64Utf8(details);
        details = JSON.parse(details);
        $("#modalDetails").modal('show');
        $("#bodyModalDetails").empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        let acumHb = 0;
        let acumQb = 0;
        let acumEb = 0;
        if (details.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesVarieties" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>NRO BOX</th>';
            texto_tabla += '<th>BOX TYPE</th>';
            texto_tabla += '<th>VARIETIES</th>';
            texto_tabla += '<th>CM</th>';
            texto_tabla += '<th>STEMS</th>';
            texto_tabla += '<th>BOUQUETS</th>';
            texto_tabla += '<th>TOTAL STM</th>';
            texto_tabla += '<th>PRICE</th>';
            texto_tabla += '<th>TOTAL</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody id="bodyTableDetails">';

            texto_tabla += '</tbody>';
            texto_tabla += '</table>';
            $("#bodyModalDetails").html(texto_tabla);

            details.forEach((item, indice, array) => {

                if (item.typeBoxs.name.toUpperCase().trim() === "HB") {
                    acumHb += parseInt(item.boxNumber);
                } else if (item.typeBoxs.name.toUpperCase().trim() === "QB") {
                    acumQb += parseInt(item.boxNumber);
                } else {
                    acumEb += parseInt(item.boxNumber);
                }

                item.indice = indice;
                let textBox = '<tr>';
                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += item.boxNumber;
                qtyBox += parseInt(item.boxNumber);
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += item.typeBoxs.name;
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '</tr>';
                let acumBoxStems = 0;
                let acumBoxBunches = 0;
                let acumTotalBox = 0;
                let acumBoxTotalStems = 0;
                $('#bodyTableDetails').append(textBox);
                if (item.varieties.length > 0) {
                    item.varieties.forEach(element => {
                        let textVariety = '<tr>';
                        textVariety += '<td>';
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.products.name;
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.measures.name;
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.stems;
                        acumBoxStems += parseInt(element.stems) * parseInt(item.boxNumber);
                        qtyStems += parseInt(element.stems) * parseInt(item.boxNumber);

                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.bunches;
                        acumBoxBunches += parseInt(element.bunches) * parseInt(item.boxNumber);
                        qtyBouquets += parseInt(element.bunches) * parseInt(item.boxNumber);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += parseInt(element.stems) * parseInt(element.bunches);
                        acumTotalStm += parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches);
                        acumBoxTotalStems += parseInt(element.stems) * parseInt(element.bunches) * parseInt(item.boxNumber);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += parseFloat(element.price).toFixed(2);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) * parseInt(element.bunches));
                        let totalTable = parseFloat(element.price) * (parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches));
                        acumTotal += totalTable;
                        acumTotalBox += totalTable
                        textVariety += totalBoxItem.toFixed(2);
                        textVariety += '</td>';

                        textVariety += '</tr>';
                        $('#bodyTableDetails').append(textVariety);
                    });
                }
                let textFooterBox = '<tr>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumBoxBunches;
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumBoxTotalStems;
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumTotalBox.toFixed(2);
                textFooterBox += '</td>';

                textFooterBox += '</tr>';
                $('#bodyTableDetails').append(textFooterBox);

            });
            let textFooter = '<tfoot>';
            textFooter += '<tr>';

            textFooter += '<td>';
            textFooter += qtyBox;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += qtyBouquets;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += acumTotalStm;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += acumTotal.toFixed(2);
            textFooter += '</td>';

            textFooter += '</tr>';
            textFooter += '</tfoot>';
            $('#bodyTableDetails').after(textFooter);
            let fulles = (acumHb * 0.50) + (acumQb * 0.25) + (acumEb * 0.125);
            if (acumEb > 0) {
                fulles = fulles.toFixed(3);
            } else {
                fulles = fulles.toFixed(2);
            }
            let textResumen = '<div class="row">';
            textResumen += '<div class="col-3" style="background:#f9f9c6">';
            textResumen += '<p class="text-left"><b>FULLES= </b> <span id="spanFulles" style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + fulles + '</span></p>';
            textResumen += '<p class="text-left"><b>PIEZAS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + qtyBox + '</span></p>';
            textResumen += '<p class="text-left"><b>TALLOS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + acumTotalStm + '</span></p>';
            textResumen += '<p class="text-left"><b>TOTAL= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">$ ' + acumTotal.toFixed(2) + '</span></p>';
            textResumen += '</div>';
            textResumen += '</div>';
            $('#datatablesVarieties').after(textResumen);
        } else {
            $('#bodyModalDetails').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    const handleShowFixedOrder = () => {
        $('#modalFixedOrder').modal('show');
        $('#btnGenerateFixedOrder').hide();
    }

    const verDetailsFixedOrder = (details) => {
        details = decodeB64Utf8(details);
        details = JSON.parse(details);
        $("#modalDetailsFixedOrder").modal('show');
        $("#bodyModalDetailsFixedOrder").empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        let acumHb = 0;
        let acumQb = 0;
        let acumEb = 0;
        if (details.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesVarieties2" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>NRO BOX</th>';
            texto_tabla += '<th>BOX TYPE</th>';
            texto_tabla += '<th>VARIETIES</th>';
            texto_tabla += '<th>CM</th>';
            texto_tabla += '<th>STEMS</th>';
            texto_tabla += '<th>BOUQUETS</th>';
            texto_tabla += '<th>TOTAL STM</th>';
            texto_tabla += '<th>PRICE</th>';
            texto_tabla += '<th>TOTAL</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody id="bodyTableDetailsOrderFixed">';

            texto_tabla += '</tbody>';
            texto_tabla += '</table>';
            $("#bodyModalDetailsFixedOrder").html(texto_tabla);

            details.forEach((item, indice, array) => {

                if (item.typeBoxs.name.toUpperCase().trim() === "HB") {
                    acumHb += parseInt(item.boxNumber);
                } else if (item.typeBoxs.name.toUpperCase().trim() === "QB") {
                    acumQb += parseInt(item.boxNumber);
                } else {
                    acumEb += parseInt(item.boxNumber);
                }

                item.indice = indice;
                let textBox = '<tr>';
                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += item.boxNumber;
                qtyBox += parseInt(item.boxNumber);
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += item.typeBoxs.name;
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += '</td>';

                textBox += '</tr>';
                let acumBoxStems = 0;
                let acumBoxBunches = 0;
                let acumTotalBox = 0;
                let acumBoxTotalStems = 0;
                $('#bodyTableDetailsOrderFixed').append(textBox);
                if (item.varieties.length > 0) {
                    item.varieties.forEach(element => {
                        let textVariety = '<tr>';
                        textVariety += '<td>';
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.products.name;
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.measures.name;
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.stems;
                        acumBoxStems += parseInt(element.stems) * parseInt(item.boxNumber);
                        qtyStems += parseInt(element.stems) * parseInt(item.boxNumber);

                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += element.bunches;
                        acumBoxBunches += parseInt(element.bunches) * parseInt(item.boxNumber);
                        qtyBouquets += parseInt(element.bunches) * parseInt(item.boxNumber);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += parseInt(element.stems) * parseInt(element.bunches);
                        acumTotalStm += parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches);
                        acumBoxTotalStems += parseInt(element.stems) * parseInt(element.bunches) * parseInt(item.boxNumber);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += parseFloat(element.price).toFixed(2);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) * parseInt(element.bunches));
                        let totalTable = parseFloat(element.price) * (parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(element.bunches));
                        acumTotal += totalTable;
                        acumTotalBox += totalTable
                        textVariety += totalBoxItem.toFixed(2);
                        textVariety += '</td>';

                        textVariety += '</tr>';
                        $('#bodyTableDetailsOrderFixed').append(textVariety);
                    });
                }
                let textFooterBox = '<tr>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumBoxBunches;
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumBoxTotalStems;
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += '</td>';

                textFooterBox += '<td bgcolor= "#b9e0f1">';
                textFooterBox += acumTotalBox.toFixed(2);
                textFooterBox += '</td>';

                textFooterBox += '</tr>';
                $('#bodyTableDetailsOrderFixed').append(textFooterBox);

            });
            let textFooter = '<tfoot>';
            textFooter += '<tr>';

            textFooter += '<td>';
            textFooter += qtyBox;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += qtyBouquets;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += acumTotalStm;
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += acumTotal.toFixed(2);
            textFooter += '</td>';

            textFooter += '</tr>';
            textFooter += '</tfoot>';
            $('#bodyTableDetails').after(textFooter);
            let fulles = (acumHb * 0.50) + (acumQb * 0.25) + (acumEb * 0.125);
            if (acumEb > 0) {
                fulles = fulles.toFixed(3);
            } else {
                fulles = fulles.toFixed(2);
            }
            let textResumen = '<div class="row">';
            textResumen += '<div class="col-3" style="background:#f9f9c6">';
            textResumen += '<p class="text-left"><b>FULLES= </b> <span id="spanFulles" style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + fulles + '</span></p>';
            textResumen += '<p class="text-left"><b>PIEZAS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + qtyBox + '</span></p>';
            textResumen += '<p class="text-left"><b>TALLOS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' + acumTotalStm + '</span></p>';
            textResumen += '<p class="text-left"><b>TOTAL= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">$ ' + acumTotal.toFixed(2) + '</span></p>';
            textResumen += '</div>';
            textResumen += '</div>';
            $('#datatablesVarieties2').after(textResumen);
        } else {
            $('#bodyModalDetailsFixedOrder').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    let arrFixedOrders = [];

    const handleSelectedOrder = (item) => {
        item = JSON.parse(decodeB64Utf8(item));
        arrFixedOrders.push(item);
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: 'Orden seleccionada correctamente',
            padding: '2em',
        })
        $('#spanCheck' + item.fixed_orders).text('<?= translate('quit_order_fixed_lang') ?>');
        $('#check' + item.fixed_orders).attr('onclick', 'handleQuitSelected("' + encodeB64Utf8(JSON.stringify(item)) + '")');
        $('#btnGenerateFixedOrder').show();
    }

    const handleQuitSelected = (item) => {
        item = JSON.parse(decodeB64Utf8(item));
        if (arrFixedOrders.length > 0) {
            const index = arrFixedOrders.findIndex(arr => arr.fixed_orders === item.fixed_orders);
            if (index > -1) {
                arrFixedOrders.splice(index, 1);
                $('#spanCheck' + item.fixed_orders).text('<?= translate('selected_order_fixed_lang') ?>');
                $('#check' + item.fixed_orders).attr('onclick', 'handleSelectedOrder("' + encodeB64Utf8(JSON.stringify(item)) + '")');
            }
        }
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: 'Orden cancelada correctamente',
            padding: '2em',
        })
        arrFixedOrders.length > 0 ? $('#btnGenerateFixedOrder').show() : $('#btnGenerateFixedOrder').hide();
    }

    const handleSubmitOrderFixed = () => {
        if (arrFixedOrders.length > 0) {
            $('#modalFixedOrder').modal('hide');
            Swal.fire({
                title: 'Completando operación',
                text: 'Generando facturas...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            let arrayRequest = JSON.stringify(arrFixedOrders);
            let data = {
                arrayRequest
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/create_invoice_fixed') ?>",
                    data: data,
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
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.close();
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                        }
                    }
                });
            }, 1500)
        } else {
            swal({
                title: '¡Error!',
                text: 'No tiene ordenes seleccionadas',
                padding: '2em'
            });
        }
    }
</script>