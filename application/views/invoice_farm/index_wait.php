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
                                visualización</button></span><span><button class="btn btn-success" onclick="loadingInvoice()" type="button">Generar invoice
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
                                    <?php foreach ($item->details as $detail) { ?>
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
                                                <div class="dropdown custom-dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="19" cy="12" r="1"></circle>
                                                            <circle cx="5" cy="12" r="1"></circle>
                                                        </svg>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">View Response</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
                                    <?php foreach ($item->details as $detail) { ?>
                                        <tr>
                                            <?php
                                            $acumQB = 0;
                                            $acumHB = 0;
                                            $acumEB = 0;
                                            $piezas = 0;
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
                                                <div class="dropdown custom-dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="19" cy="12" r="1"></circle>
                                                            <circle cx="5" cy="12" r="1"></circle>
                                                        </svg>
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">View Response</a>
                                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
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
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('mode_billing_lang') ?></h5>
            </div>
            <div class="modal-body table-responsive" id="bodyModalLoadInvoice">
                <div class="row">
                    <div class="col-lg-6">
                        <label><?= translate("markings_lang"); ?></label>
                        <div class="input-group">
                            <select id="markings" name="markings" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("awb_lang"); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="awb" name="awb" placeholder="<?= translate('awb_lang'); ?>">
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
                                    <th style="border:none"></th>
                                    <th id="full">0</th>
                                    <th id="1/2">0</th>
                                    <th id="1/4">0</th>
                                    <th id="1/8">0</th>
                                    <th id="1/16">0</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
            <div class=" modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let listInvoice = '<?= json_encode($all_invoice_farm) ?>';
    let arraySelectedInvoice = [];
    $(() => {
        if (change == 0) {
            $('#mode2').hide();
        }
        table = $('#example').DataTable({
            "order": [
                [1, "desc"]
            ],
        });
        let table2 = $('#example2').DataTable({
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
    });
    let table;
    const loadingInvoice = () => {
        listInvoice = JSON.parse(listInvoice);
        let arrayTemp = [];
        listInvoice.forEach(item => {
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
        let cadena = '<option value="0"><?= translate('select_opction_lang') ?></option>';
        arrayTemp.forEach(item => {
            cadena += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.marking_id + '">' + item.name_marking + ' | ' + item.name_commercial + '</option>';
        });
        $('#markings').html(cadena);
        $('#modalLoadInvoice').modal({
            backdrop: false
        })
        /* table.column(4)
            .search('Luxus Blumen' ? '^' + 'Luxus Blumen' + '$' : 'Luxus Blumen', true, false)
            .draw(); */
    }

    const printSelectedInvoice = () => {
        $('#bodyTableLoadInvoice').empty();
        if (arraySelectedInvoice.length > 0) {
            arraySelectedInvoice.forEach((item, index, array) => {
                stringSelected += '<tr>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '<td>';

                stringSelected += '</td>';
                stringSelected += '</tr>';
            });
            $('#bodyTableLoadInvoice').html(stringSelected)
        } else {
            let stringDefault = '<tr><td>Vacio</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
            $('#bodyTableLoadInvoice').html(stringDefault)
        }
    }

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }
    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    let change = 0;

    const changeVisualization = () => {
        if (change == 0) {
            change = 1;
            $('#mode1').hide();
            $('#mode2').show();
        } else {
            change = 0;
            $('#mode1').show();
            $('#mode2').hide();
        }
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
</script>