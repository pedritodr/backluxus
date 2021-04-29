<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    .table-bordered {
        border: 1px solid #dee2e6 !important;
    }

    #modalDetails {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalLoadInvoice {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #table-example-1 {
        border: solid thin;
        border-collapse: collapse;
    }

    #table-example-1 caption {
        padding-bottom: 0.5em;
    }

    #table-example-1 th,
    #table-example-1 td {
        border: solid thin;
        padding: 0.5rem 2rem;
    }

    #table-example-1 td {
        white-space: nowrap;
    }

    #table-example-1 th {
        font-weight: normal;
    }

    #table-example-1 td {
        border-style: none solid;
        vertical-align: top;
    }

    #table-example-1 th {
        padding: 0.2em;
        vertical-align: middle;
        text-align: center;
    }

    #table-example-1 tbody td:first-child::after {
        content: leader(". ");
    }

    .table>tbody:before {
        line-height: 1em;
        content: "";
        color: white;
        display: block;
    }

    .swal2-modal .swal2-image {
        margin: 20px auto;
        max-width: 100%;
        width: 100%;
        border-radius: 6px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('manage_invoice_wait_lang'); ?>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_invoice_wait_lang'); ?> <span><button class="btn btn-info" onclick="changeVisualization()" type="button">Cambiar
                                visualización</button></span><span><button class="btn btn-success" id="btnInvoiceClient" onclick="loadingInvoice()" type="button"><?= translate('mode_billing_lang') ?>
                            </button></span><span><button class="btn btn-primary" id="btnLoadInvoice" onclick="showModalInvoiceClients()" type="button"><?= translate('add_items_invoice_clients_lang') ?>
                            </button></span><span><button class="btn btn-danger" id="btnCancel" onclick="cancel()" style="display:none" type="button"><?= translate('cancel_lang') ?>
                            </button></span></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>

                    <div class="table-responsive" id="mode1">
                        <table id="example" class="table table-striped table-no-bordered table-hover non-hover dataTable" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Marcación</th>
                                    <th>Nro cajas</th>
                                    <th>Nro factura</th>
                                    <th>Finca</th>
                                    <th>Tallos</th>
                                    <th>Tamaño</th>
                                    <th>Total tallos</th>
                                    <th>Precio</th>
                                    <th>total</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Marcación</th>
                                    <th>Nro cajas</th>
                                    <th>Nro factura</th>
                                    <th>Finca</th>
                                    <th>Tallos</th>
                                    <th>Tamaño</th>
                                    <th>Total tallos</th>
                                    <th>Precio</th>
                                    <th>total</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php foreach ($all_invoice_farm as $item) { ?>
                                    <?php $item->farms->invoice_farm = $item->invoice_farm;
                                    $item->farms->dispatch_day = $item->dispatch_day;
                                    $item->farms->invoice_number = $item->invoice_number;
                                    foreach ($item->details as $detail) {
                                        if ($detail->status == 0) {
                                    ?>
                                            <tr>
                                                <td><?= $item->dispatch_day ?></td>
                                                <td><?= $item->markings->name_marking ?></td>
                                                <td><?= $detail->boxNumber . $detail->typeBoxs->name ?></td>
                                                <td><?= $item->invoice_number ?></td>
                                                <td><?= $item->farms->name_commercial ?></td>
                                                <?php
                                                $varieties = "";
                                                $totalStringStems = "";
                                                $totalStems = 0;
                                                $priceString = "";
                                                $size = "";
                                                $i = 0;
                                                $priceAcum = 0;
                                                foreach ($detail->varieties as $variety) {
                                                    if ($i == 0) {
                                                        $varieties = $variety->products->name;
                                                        $totalStringStems = $variety->bunches * $variety->stems;
                                                        $priceString = number_format($variety->price, 2);
                                                        $size = $variety->measures->name;
                                                    } else {
                                                        $varieties .= '/' . $variety->products->name;
                                                        $totalStringStems .= '/' . $variety->bunches * $variety->stems;
                                                        $priceString .= '/' . number_format($variety->price, 2);
                                                        $size .= '/' . $variety->measures->name;
                                                    }
                                                    $totalStems += $variety->bunches * $variety->stems;
                                                    $priceAcum += $variety->price;
                                                    $i++;
                                                }
                                                $total = $totalStems * $priceAcum;
                                                ?>
                                                <td><?= $varieties ?></td>
                                                <td><?= $size ?></td>
                                                <td><?= $totalStringStems ?></td>
                                                <td><?= $priceString ?></td>
                                                <td><?= number_format($total, 2) ?></td>
                                                <td class="text-center" style="width:10%">
                                                    <div class="n-chk" style="display:none">
                                                        <label id="<?= $detail->id ?>" onclick="addItemBox((this),'<?= base64_encode(json_encode($item->markings)) ?>','<?= base64_encode(json_encode($item->farms)) ?>','<?= base64_encode(json_encode($detail)) ?>')" class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                            <input id="input_<?= $detail->id ?>" type="checkbox" class="new-control-input">
                                                            <span class="new-control-indicator"></span><?= translate('add_box_lang') ?>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="mode2">
                        <table id="example2" class="table table-striped table-no-bordered table-hover non-hover dataTable" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Marcación / Finca (nombre comercial y jurídico) / No de factura / Dia de
                                        despacho / Total fulles / Total piezas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Marcación / Finca (nombre comercial y jurídico) / No de factura / Dia de
                                        despacho / Total fulles / Total piezas</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php foreach ($all_invoice_farm as $item) { ?>
                                    <?php foreach ($item->details as $detail) {
                                        if ($detail->status == 0) {
                                    ?>
                                            <tr>
                                                <?php
                                                $acumQB = 0;
                                                $acumHB = 0;
                                                $acumEB = 0;
                                                $piezas = 0;
                                                $item->farms->invoice_farm = $item->invoice_farm;
                                                $item->farms->dispatch_day = $item->dispatch_day;
                                                $item->farms->invoice_number = $item->invoice_number;
                                                if ($detail->typeBoxs->name == 'QB') {
                                                    $acumQB += (int)$detail->boxNumber;
                                                } elseif ($detail->typeBoxs->name == 'HB') {
                                                    $acumHB += (int)$detail->boxNumber;
                                                } else {
                                                    $acumEB += (int)$detail->boxNumber;
                                                }
                                                $piezas += (int)$detail->boxNumber;
                                                $fulles = ($acumHB * 0.50) + ($acumQB * 0.25) + ($acumEB * 0.125);
                                                if ($acumEB > 0) {
                                                    $fulles = number_format($fulles, 3);
                                                } else {
                                                    $fulles = number_format($fulles, 2);
                                                }
                                                ?>
                                                <td><?= $item->markings->name_marking . '<b>/</b>' . $item->farms->name_commercial . '(' . $item->farms->name_legal . ')<b>/</b>' . $item->invoice_number . '<b>/</b>' . $item->dispatch_day . '<b>/</b>' . $fulles . '<b>/</b>' . $piezas . '<b>/</b>' . $item->awb ?>
                                                </td>
                                                <td class="text-center" style="width:10%">
                                                    <div class="n-chk" style="display:none">
                                                        <label id="mode_<?= $detail->id ?>" onclick="addItemBox((this),'<?= base64_encode(json_encode($item->markings)) ?>','<?= base64_encode(json_encode($item->farms)) ?>','<?= base64_encode(json_encode($detail)) ?>')" class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                            <input id="input_mode_<?= $detail->id ?>" type="checkbox" class="new-control-input">
                                                            <span class="new-control-indicator"></span><?= translate('add_box_lang') ?>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                <?php } ?>
                            </tbody>
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
<div class="modal fade" id="modalLoadInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lblHeaderInvoice"><?= translate('mode_billing_lang') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body table-responsive" id="bodyModalLoadInvoice">
                <div class="row">
                    <div class="col-lg-6" id="bodySearchAwb">
                        <label><?= translate("search_invoice_number_awb_lang"); ?></label>
                        <div class="input-group">
                            <input id="searchAwb" type="text" class="form-control" placeholder="<?= translate('search_invoice_number_awb_lang') ?>" aria-label="<?= translate('search_awb_lang') ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="searchInvoiceByAwb()" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg></button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label><?= translate("markings_lang"); ?></label>
                        <div class="input-group">
                            <select class="form-control select2 input-sm" data-placeholder="Seleccione una opción" id="markings" onchange="changeMarking()" style="width: 100%">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6" id="bodyAwb">
                        <label><?= translate("awb_lang"); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="awb" name="awb" onchange="validAwb()">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="table-responsive col-lg-12">
                        <table class="table table-bordered" id="table-example-1">
                            <!--     <caption>Specification values: <b>Steel</b>, <b>Castings</b>,
                                Ann. A.S.T.M. A27-16, Class B;* P max. 0.06; S max. 0.05.</caption> -->
                            <thead>
                                <tr>
                                    <th rowspan="2">Export Name</th>
                                    <th rowspan="2">FULL BXS</th>
                                    <th colspan="5">Piezas Confirmadas</th>
                                </tr>
                                <tr>
                                    <th>Full</th>
                                    <th>1/2</th>
                                    <th>1/4</th>
                                    <th>1/8</th>
                                    <th>1/16</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTableLoadInvoice">
                                <tr>
                                    <td>Vacio</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="border:none"></th>
                                    <th id="fulles">0</th>
                                    <th id="full">0</th>
                                    <th id="hb">0</th>
                                    <th id="qb">0</th>
                                    <th id="eb">0</th>
                                    <th id="ebb">0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
            <div class=" modal-footer">
                <button class="btn" onclick="validSelectedItems()"><i class="flaticon-cancel-12"></i> Seleccionar items</button>
                <button class="btn btn-success" id="btnInvoice" onclick="generateInvoice()" type="button">generar invoice</button>
            </div>
        </div>
    </div>
</div>

<script>
    let listInvoice = '<?= json_encode($all_invoice_farm) ?>';
    let arraySelectedInvoice = [];
    $(() => {
        $('#awb').inputmask("999-9999-9999");
        if (change == 0) {
            $('#mode2').hide();
        }
        table = $('#example').DataTable({
            "order": [
                [1, "desc"]
            ],
        });
        table2 = $('#example2').DataTable({
            "order": [
                [1, "desc"]
            ],
        });
        $("#example thead th").each(function(i) {

            if ($(this).text() !== '') {
                let isStatusColumn = (($(this).text() == 'Status') ? true : false);
                let select = $('<select class="selectedFilter"><option value="">' + $(this).text() +
                        '</option></select>')
                    .appendTo($(this).empty())
                    .on('change', function() {
                        let val = $(this).val();
                        table.column(i)
                            .search(val ? '^' + $(this).val() + '$' : val, true, false)
                            .draw();
                    });

                // Get the Status values a specific way since the status is a anchor/image
                if (isStatusColumn) {
                    let statusItems = [];
                    /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
                    table.column(i).nodes().to$().each(function(d, j) {
                        let thisStatus = $(j).attr("data-filter");
                        if ($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
                    });

                    statusItems.sort();

                    $.each(statusItems, function(i, item) {
                        select.append('<option value="' + item + '">' + item + '</option>');
                    });

                }
                // All other non-Status columns (like the example)
                else {
                    table.column(i).data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
                }
            }
        });
        $("#markings").select2({
            tags: false,
            dropdownParent: $("#modalLoadInvoice"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });
        loadMarkings();
    });
    let table;
    let table2;
    const loadingInvoice = () => {
        $('#btnInvoice').attr('onclick', 'generateInvoice()');
        $('#btnInvoice').text('Generar invoice');
        $('#markings').prop('disabled', false);
        $('#bodySearchAwb').hide();
        $('#bodyAwb').show();
        printSelectedInvoice();
        $('#lblHeaderInvoice').text('<?= translate('mode_billing_lang') ?>');
        $('#modalLoadInvoice').modal({
            backdrop: false
        })
        let marking = $('select[id=markings] option').filter(':selected').attr('itemId');
        if (marking != 0) {
            marking = JSON.parse(decodeB64Utf8(marking));
            $.ajax({
                type: 'POST',
                url: "<?= site_url('invoice_farm/search_user_by_marking') ?>",
                data: {
                    marking: marking.marking_id
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        if (result.data) {
                            let secuencial;
                            result.data.secuencial ? secuencial = result.data.secuencial + 1 : secuencial = 1;
                            $('#lblHeaderInvoice').text('Factura nro: ' + secuencial);
                        }
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
        }


    }

    const cancel = () => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cancelar todo',
            padding: '2em',
            allowOutsideClick: false,
        }).then(function(result) {
            if (result.value) {
                location.reload();
            }
        })
    }

    const loadMarkings = () => {
        listInvoice = JSON.parse(listInvoice);
        let arrayTemp = [];
        listInvoice.forEach(item => {
            item.markings.awb = item.awb;
            if (arrayTemp.length == 0) {
                arrayTemp.push(item.markings);
            } else {
                let result = arrayTemp.filter(e => {
                    return e.marking_id === item.markings.marking_id
                });
                if (result.length == 0) {
                    arrayTemp.push(item.markings);
                }
            }
        });
        let cadena = '<option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
        arrayTemp.forEach(item => {
            cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.marking_id + '">' + item.name_marking + ' | ' + item.name_commercial + '</option>';
        });
        $('#markings').empty();
        $('#markings').html(cadena);
    }

    const printSelectedInvoice = () => {
        $('#bodyTableLoadInvoice').empty();
        if (arraySelectedInvoice.length > 0) {
            if (arrayInvoiceUpdate > 0) {
                $('#btnInvoiceClient').hide();
                $('#btnLoadInvoice').show();
            } else {
                $('#btnInvoiceClient').show();
                $('#btnLoadInvoice').hide();
            }
            let acumHb = 0;
            let acumQb = 0;
            let acumEb = 0;
            let stringSelected = '';
            arraySelectedInvoice.forEach((item, index, array) => {
                item.boxs.forEach((box) => {
                    let hb = 0;
                    let qb = 0;
                    let eb = 0;
                    if (box.typeBoxs.name.toUpperCase().trim() === "HB") {
                        hb = parseInt(box.boxNumber);
                        acumHb += parseInt(box.boxNumber);
                    } else if (box.typeBoxs.name.toUpperCase().trim() === "QB") {
                        qb = parseInt(box.boxNumber);
                        acumQb += parseInt(box.boxNumber);
                    } else {
                        eb = parseInt(box.boxNumber);
                        acumEb += parseInt(box.boxNumber);
                    }
                    stringSelected += '<tr>';
                    stringSelected += '<td>';
                    stringSelected += item.farm.name_commercial + ' (' + item.farm.name_legal + ')';
                    stringSelected += '</td>';
                    stringSelected += '<td class="text-center">';
                    if (hb > 0) {
                        stringSelected += (0.50 * hb).toFixed(3);
                    } else if (qb > 0) {
                        stringSelected += (0.25 * qb).toFixed(3);
                    } else {
                        stringSelected += (0.125 * eb).toFixed(3);
                    }

                    stringSelected += '</td>';
                    stringSelected += '<td>';

                    stringSelected += '</td>';
                    stringSelected += '<td class="text-center">';
                    stringSelected += hb > 0 ? hb : '';
                    stringSelected += '</td>';
                    stringSelected += '<td class="text-center">';
                    stringSelected += qb > 0 ? qb : '';
                    stringSelected += '</td>';
                    stringSelected += '<td class="text-center">';
                    stringSelected += eb > 0 ? eb : '';
                    stringSelected += '</td>';
                    stringSelected += '<td class="text-center">';

                    stringSelected += '</td>';
                    stringSelected += '</tr>';
                })
            });
            $('#bodyTableLoadInvoice').html(stringSelected);
            let fulles = (acumHb * 0.50) + (acumQb * 0.25) + (acumEb * 0.125);
            $('#fulles').text(fulles.toFixed(3));
            $('#full').text(0);
            $('#hb').text(acumHb);
            $('#qb').text(acumQb);
            $('#eb').text(acumEb);
            $('#ebb').text(0);
        } else {
            let stringDefault = '<tr><td>Vacio</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
            $('#bodyTableLoadInvoice').html(stringDefault);
            $('#ebb').text(0);
            $('#full').text(0);
            $('#hb').text(0);
            $('#qb').text(0);
            $('#eb').text(0);
            $('#fulles').text(0);
        }
        validBtnCancel();
    }

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const addItemBox = (e, marking, farm, box) => {
        let markingS = $('select[id=markings] option').filter(':selected').attr('itemId');
        markingS = JSON.parse(decodeB64Utf8(marking));
        marking = JSON.parse(decodeB64Utf8(marking));
        farm = JSON.parse(decodeB64Utf8(farm));
        box = JSON.parse(decodeB64Utf8(box));
        box.invoice_farm = farm.invoice_farm;
        if ($('#input_' + e.id).prop('checked')) {
            if (arraySelectedInvoice.length > 0) {
                if (arraySelectedInvoice[0].marking.name_marking === markingS.name_marking) {
                    let encontro = false;
                    arraySelectedInvoice.forEach(item => {
                        if (item.farm.farm_id == farm.farm_id) {
                            encontro = true;
                            item.boxs.push(box);
                        }
                    });
                    if (!encontro) {
                        let arrayBoxs = [];
                        arrayBoxs.push(box);
                        let temp = {
                            farm: farm,
                            boxs: arrayBoxs,
                            marking: marking
                        }
                        arraySelectedInvoice.push(temp);
                    }
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '3em'
                    });
                    toast({
                        type: 'success',
                        title: 'item agregado correctamente',
                        padding: '3em',
                    })
                    if (e.id.indexOf("mode_") >= 0) {
                        let idTemp = e.id;
                        let dividido = idTemp.split("mode_");
                        $('#input_' + dividido[1]).prop('checked', true);
                    } else {
                        $('#input_mode_' + e.id).prop('checked', true);
                    }
                } else {
                    swal({
                        title: 'Información',
                        text: `${arraySelectedInvoice[0].marking.name_marking} es diferente de ${marking.name_marking}`,
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Continuar',
                        padding: '2em',
                        allowOutsideClick: false,
                    }).then(function(result) {
                        if (result.value) {
                            if (e.id.indexOf("mode_") >= 0) {
                                let idTemp = e.id;
                                let dividido = idTemp.split("mode_");
                                $('#input_' + e.id).prop('checked', false);
                                $('#input_' + dividido[1]).prop('checked', false);
                            } else {
                                $('#input_mode_' + e.id).prop('checked', false);
                                $('#input_' + e.id).prop('checked', false);
                            }
                        }
                    })
                }
            } else {
                let arrayBoxs = [];
                arrayBoxs.push(box);
                let temp = {
                    farm: farm,
                    boxs: arrayBoxs,
                    marking: marking
                }
                arraySelectedInvoice.push(temp);
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '3em'
                });
                toast({
                    type: 'success',
                    title: 'item agregado correctamente',
                    padding: '3em',
                })

                if (e.id.indexOf("mode_") >= 0) {
                    let idTemp = e.id;
                    let dividido = idTemp.split("mode_");
                    $('#input_' + dividido[1]).prop('checked', true);
                } else {
                    $('#input_mode_' + e.id).prop('checked', true);
                }
            }
        } else {
            arraySelectedInvoice.forEach((element, indice, array) => {
                const index = element.boxs.findIndex(x => x.id === box.id);
                if (index > -1) {
                    element.boxs.splice(index, 1);
                }
                if (element.boxs.length == 0) {
                    arraySelectedInvoice.splice(indice, 1);
                }
            });
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'success',
                title: 'item removido correctamente',
                padding: '3em',
            })
        }
        validBtnCancel();
        /*   swal({
              title: '¿ Quieres ir al detalle de la factura ?',
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Si',
              cancelButtonText: 'No',
              padding: '2em'
          }).then(function(result) {
              if (result.value) {
                  if (arrayInvoiceUpdate.length > 0) {
                      showModalInvoiceClients();
                  } else {
                      loadingInvoice();
                  }
              } else {
                  if (arrayInvoiceUpdate.length > 0) {
                      $('#btnInvoiceClient').hide();
                      $('#btnLoadInvoice').show();
                  } else {
                      $('#btnInvoiceClient').show();
                      $('#btnLoadInvoice').hide();
                  }
              }
          }) */

    }

    const changeMarking = () => {
        let marking = $('select[id=markings] option').filter(':selected').attr('itemId');
        marking !== '0' ? marking = JSON.parse(decodeB64Utf8(marking)) : marking = 0;
        if (marking !== 0) {

            $("#awb").inputmask("setvalue", marking.awb);
            table.column(1)
                .search(marking.name_marking ? '^' + marking.name_marking + '$' : marking.name_marking, true, false)
                .draw();
            $('.n-chk').show();
            table2.search(marking.name_marking).draw();
            if (marking.awb !== '') {
                validAwb();
            }
            $.ajax({
                type: 'POST',
                url: "<?= site_url('invoice_farm/search_user_by_marking') ?>",
                data: {
                    marking: marking.marking_id
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        if (result.data) {
                            let secuencial;
                            result.data.secuencial ? secuencial = result.data.secuencial + 1 : secuencial = 1;
                            $('#lblHeaderInvoice').text('Factura nro: ' + secuencial);
                        }
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
        }
    }

    let change = 0;

    const changeVisualization = () => {
        Swal.fire({
            title: 'Completando operación',
            text: 'Cambiando la visualización...',
            imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
            imageAlt: 'No realice acciones sobre la página',
            showConfirmButton: false,
            allowOutsideClick: false,
            footer: '<a href>No realice acciones sobre la página</a>',
        });
        setTimeout(() => {
            if (change == 0) {
                change = 1;
                $('#mode1').hide();
                $('#mode2').show();
            } else {
                change = 0;
                $('#mode1').show();
                $('#mode2').hide();
            }
            Swal.close();
        }, 1500);

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
            texto_tabla +=
                '<table id="datatablesVarieties" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
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
                        acumTotalStm += parseInt(element.stems) * parseInt(item.boxNumber) * parseInt(
                            element.bunches);
                        acumBoxTotalStems += parseInt(element.stems) * parseInt(element.bunches) *
                            parseInt(item.boxNumber);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        textVariety += parseFloat(element.price).toFixed(2);
                        textVariety += '</td>';

                        textVariety += '<td>';
                        let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) *
                            parseInt(element.bunches));
                        let totalTable = parseFloat(element.price) * (parseInt(element.stems) *
                            parseInt(item.boxNumber) * parseInt(element.bunches));
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
            textResumen +=
                '<p class="text-left"><b>FULLES= </b> <span id="spanFulles" style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' +
                fulles + '</span></p>';
            textResumen +=
                '<p class="text-left"><b>PIEZAS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' +
                qtyBox + '</span></p>';
            textResumen +=
                '<p class="text-left"><b>TALLOS= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">' +
                acumTotalStm + '</span></p>';
            textResumen +=
                '<p class="text-left"><b>TOTAL= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">$ ' +
                acumTotal.toFixed(2) + '</span></p>';
            textResumen += '</div>';
            textResumen += '</div>';
            $('#datatablesVarieties').after(textResumen);
        } else {
            $('#bodyModalDetails').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    const generateInvoice = () => {

        if (arraySelectedInvoice.length > 0) {

            let marking = $('select[id=markings] option').filter(':selected').attr('itemId');
            marking = JSON.parse(decodeB64Utf8(marking));
            let awb = $('#awb').val();
            let awbDividido = awb.split('-');
            let format = true;
            for (let i = 0; i < awbDividido.length; i++) {
                let position = awbDividido[i].indexOf('_');
                if (position >= 0) {
                    format = false
                    break;
                }
            }
            if (!format) {
                swal({
                    title: '¡Información!',
                    text: "La Awb no cumple con el formato adecuado",
                    type: 'info',
                    showConfirmButton: true,
                    padding: '2em'
                })
            } else {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Creando invoice del cliente...',
                    imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                let arrayRequest = JSON.stringify(arraySelectedInvoice);
                let data = {
                    awb,
                    arrayRequest,
                    marking
                }
                setTimeout(function() {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('invoice_farm/add_invoice_client') ?>",
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
                                    window.location = '<?= site_url('invoice_farm/index_invoice_client') ?>';
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
        } else {
            swal({
                title: 'Información',
                text: 'La factura se encuentra vacio',
                type: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Continuar',
                padding: '2em',
                allowOutsideClick: false,
            }).then(function(result) {
                if (result.value) {}
            })
        }
    }

    const showModalInvoiceClients = () => {
        $('#btnInvoice').attr('onclick', 'updateInvoice()');
        $('#btnInvoice').text('Adicionar items');
        $('#markings').prop('disabled', true);
        $('#bodySearchAwb').show();
        $('#bodyAwb').hide();
        printSelectedInvoice();
        $('#modalLoadInvoice').modal({
            backdrop: false
        })
    }

    let arrayInvoiceUpdate = [];

    const searchInvoiceByAwb = () => {
        let searchAwb = $('#searchAwb').val().trim();
        if (searchAwb === '') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'error',
                title: 'El campo buscar invoice por AWB es requerido',
                padding: '3em',
            })
        } else {
            Swal.fire({
                title: 'Completando operación',
                text: 'Buscando factura...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            let data = {
                searchAwb
            };
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/search_invoice_by_awb') ?>",
                    data: data,
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status == 200) {
                            if (result.data) {
                                const details = result.data.details;
                                arraySelectedInvoice = details;
                                arrayInvoiceUpdate = 0;
                                let countBoxs = 0;
                                details.forEach(element => {
                                    countBoxs += element.boxs.length;
                                })
                                arrayInvoiceUpdate = countBoxs;
                                invoiceClientUpdate = result.data.invoice;
                                let cadena = '<option itemId="' + encodeB64Utf8(JSON.stringify(result.data.marking)) + '" value="' + result.data.marking.marking_id + '">' + result.data.marking.name_marking + ' | ' + result.data.marking.name_commercial + '</option>';
                                $('#markings').html(cadena);
                                $('#markings').trigger('change');
                                $('#lblHeaderInvoice').text('<?= translate("invoice_number_lang"); ?>: ' + result.data.number_invoice);
                                printSelectedInvoice();
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
                            } else {
                                $('#markings').val(0);
                                $('#markings').trigger('change');
                                arraySelectedInvoice = [];
                                arrayInvoiceUpdate = 0;
                                printSelectedInvoice();
                                Swal.close();
                                swal({
                                    title: '¡Mensaje!',
                                    text: `No se encontró la factura asociada a ${searchAwb}`,
                                    padding: '2em'
                                });
                            }

                        } else {
                            $('#markings').val(0);
                            $('#markings').trigger('change');
                            arraySelectedInvoice = [];
                            arrayInvoiceUpdate = 0;
                            printSelectedInvoice();
                            Swal.close();
                            swal({
                                title: '¡Error!',
                                text: result.msj,
                                padding: '2em'
                            });
                        }
                    }
                });
            }, 2000)

        }
        validBtnCancel();
    }

    const validBtnCancel = () => {
        if (arraySelectedInvoice.length > 0) {
            $('#btnCancel').show();
        } else {
            $('#btnCancel').hide();
        }
    }

    const validSelectedItems = () => {
        let markingS = $('select[id=markings] option').filter(':selected').attr('itemId');
        let bodySearchAwb = $('#bodySearchAwb').css('display');
        if (bodySearchAwb === 'block') {
            if (arrayInvoiceUpdate > 0) {
                $('#modalLoadInvoice').modal('hide');
            } else {
                swal({
                    title: '¡Mensaje!',
                    text: 'La factura no esta cargada para continuar',
                    padding: '2em'
                });
            }
        } else {
            if (markingS == 0) {
                swal({
                    title: '¡Mensaje!',
                    text: 'Seleccione una marcación para continuar con la selección de facturas',
                    padding: '2em'
                });
            } else {
                $('#modalLoadInvoice').modal('hide');
            }
        }
    }

    const validAwb = () => {
        let bodySearchAwb = $('#bodySearchAwb').css('display');
        if (bodySearchAwb === 'none') {
            let searchAwb = $('#awb').val().trim();
            let awbDividido = searchAwb.split('-');
            let format = true;
            for (let i = 0; i < awbDividido.length; i++) {
                let position = awbDividido[i].indexOf('_');
                if (position >= 0) {
                    format = false
                    break;
                }
            }
            if (!format) {
                swal({
                    title: '¡Información!',
                    text: "La Awb no cumple con el formato adecuado",
                    type: 'info',
                    showConfirmButton: true,
                    padding: '2em'
                })

            } else {
                if (searchAwb !== '') {
                    $.ajax({
                        type: 'POST',
                        url: "<?= site_url('invoice_farm/search_invoice_by_awb_id') ?>",
                        data: {
                            searchAwb
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            if (result.status == 200) {
                                if (result.data) {
                                    swal({
                                        title: '¡Mensaje!',
                                        text: `Existe una factura asociada a ${searchAwb}`,
                                        padding: '2em'
                                    });
                                    $('#awb').val('')
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
            }

        }
    }

    let invoiceClientUpdate = null;

    const updateInvoice = () => {
        let valid = validAddItem();
        if (valid) {
            Swal.fire({
                title: 'Completando operación',
                text: 'Actualizando invoice del cliente...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            let invoice = invoiceClientUpdate;
            let arrayRequest = JSON.stringify(arraySelectedInvoice);
            let data = {
                invoice,
                arrayRequest
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/update_invoice_client') ?>",
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
                                window.location = '<?= site_url('invoice_farm/index_invoice_client') ?>';
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
                title: 'Información',
                text: 'No se ha ingresado items a la factura',
                type: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Continuar',
                padding: '2em',
                allowOutsideClick: false,
            }).then(function(result) {
                if (result.value) {}
            })
        }
    }

    const validAddItem = () => {
        countQtyB = 0;
        if (arrayInvoiceUpdate > 0) {
            if (arraySelectedInvoice.length > 0) {
                arraySelectedInvoice.forEach((item) => {
                    countQtyB += item.boxs.length;
                });
            } else {
                return false;
            }
            if (countQtyB > arrayInvoiceUpdate) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>