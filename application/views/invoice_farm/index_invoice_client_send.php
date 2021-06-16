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

    #modalAwb {
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

    .modal-content .modal-header svg {
        width: 28px;
        color: #acb0c3;
    }

    .dot-yellow {
        height: 15px;
        width: 15px;
        background-color: yellow;
        border-radius: 50%;
        display: inline-block;
    }

    .dot-green {
        height: 15px;
        width: 15px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
    }

    .dot-red {
        height: 15px;
        width: 15px;
        background-color: red;
        border-radius: 50%;
        display: inline-block;
    }

    .table>tbody>tr>td {
        border: 1px solid #ebedf2;
        color: #888ea8;
        font-size: 13px;
        letter-spacing: 1px;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('invoice_lang'); ?>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('List_invoice_send_client_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <div class="table-responsive" id="mode1">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("markings_lang"); ?></th>
                                    <th><?= translate("data_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($all_invoice) { ?>
                                    <?php foreach ($all_invoice as $item) {
                                        if (count($item->details) > 0) {
                                            $acumHb = 0;
                                            $acumQb = 0;
                                            $acumEb = 0;
                                            foreach ($item->details as $element) {
                                                if (count($element->boxs) > 0) {
                                                    foreach ($element->boxs as $box) {
                                                        if (trim(strtoupper($box->typeBoxs->name)) === "HB") {
                                                            $acumHb += (int)$box->boxNumber;
                                                        } else if (trim(strtoupper($box->typeBoxs->name)) === "QB") {
                                                            $acumQb += (int)$box->boxNumber;
                                                        } else {
                                                            $acumEb += (int)$box->boxNumber;
                                                        }
                                                    }
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
                                                <p><?= $item->marking->name_company . ' | ' . $item->marking->name_commercial ?></p>
                                                <p><b><?= translate("marking_lang"); ?>: <?= $item->marking->name_marking ?></b></p>
                                            </td>
                                            <td>
                                                <p><strong><?= translate("packing_lang"); ?> : </strong>
                                                    <?php
                                                    echo  printf('%02d', $item->number_invoice) . ' - ' . $fulles . ' (' . $acumHb . 'HB, ' . $acumQb . 'QB, ' . $acumEb . 'EB)';
                                                    ?>
                                                </p>
                                                <p><strong><?= translate("dispatch_day_lang"); ?> : </strong>
                                                    <?php if (isset($item->date_awb)) {
                                                        $newDate = date("d.m.y", strtotime($item->date_awb));
                                                        echo  $newDate;
                                                    } ?>
                                                </p>
                                                <p><strong><?= translate("awb_lang"); ?> : </strong><?= $item->awb; ?></p>
                                                <p><strong><?= translate("airline_lang"); ?> : </strong>
                                                    <?php if (isset($item->airline)) {
                                                        echo $item->airline;
                                                    } ?>
                                                </p>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" id="<?= 'btneyeDetails_' . $item->invoice ?>" href="javascript:void(0)" onclick="verDetails('<?= base64_encode(json_encode($item->details)) ?>','<?= $item->invoice ?>','<?= $item->status ?>')"><i class="fa fa-edit"></i> <?= translate("details_lang"); ?></a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="updateAwb('<?= base64_encode(json_encode($item)) ?>')"><?= translate("edit_awb_lang"); ?></a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><?= translate("send_invoice_lang"); ?></a>
                                                        <a class="dropdown-item" href="<?= site_url('invoice_farm/export_invoice/' . $item->invoice) ?>"><?= translate("export_invoice_lang"); ?></a>
                                                        <a class="dropdown-item" href="javascript:void(0)"><?= translate("cancel_invoice_lang"); ?></a>
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
                <button class="btn btn-success" id="btnUpdateInvoice" onclick="handleUpdateItems()" style="display:none">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAwb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalAwbNo"><?= translate('picture_logistic_lang') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label id="lblNumberAwb"><?= translate("awb_lang"); ?></label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="awbEdit" onkeyup="handleChangeAwbEdit()">
                            <input id="invoiceId" type="hidden">
                        </div>
                    </div>
                    <div class="col-6">
                        <label><?= translate('fecha_lang') ?></label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="date" />
                        </div>
                    </div>
                    <div class="col-12">
                        <label><?= translate('airline_lang') ?></label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="airline" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button id="btnUpdateAwb" class="btn btn-success" onclick="handleSubmitUpdateAwb()">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let activeEdit = false;
    $(() => {
        let table = $('#example1').DataTable({
            "order": [
                [0, "desc"]
            ],
        });
    });

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    let arrayDetails = [];
    let idInvoice = null;

    const verDetails = (details, id, status = '0') => {
        details = decodeB64Utf8(details);
        details = JSON.parse(details);
        idInvoice = id;
        arrayDetails = details;
        arrayDeleteItems = [];
        activeEdit = false;
        if (status === '2') {
            $('#btnUpdateInvoice').hide();
            $('#btnActiveEdit').hide();
        } else {
            $('#btnActiveEdit').show();
        }
        $('#modalDetails').modal({
            backdrop: false
        });
        $('#btnUpdateInvoice').hide();
        $("#bodyModalDetails").empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        let acumTotalCliente = 0;
        let acumHb = 0;
        let acumQb = 0;
        let acumEb = 0;
        if (details.length > 0) {
            let texto_tabla = '';
            texto_tabla +=
                '<table id="datatablesVarieties" class="table table-bordered" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>Finca</th>';
            texto_tabla += '<th>No</th>';
            texto_tabla += '<th>Tipo</th>';
            texto_tabla += '<th>Cat</th>';
            texto_tabla += '<th>Variedad</th>';
            texto_tabla += '<th>Prop</th>';
            texto_tabla += '<th>Emp</th>';
            texto_tabla += '<th>Ramos</th>';
            texto_tabla += '<th>Tallos</th>';
            texto_tabla += '<th>Finca</th>';
            texto_tabla += '<th>Total</th>';
            texto_tabla += '<th>Cliente</th>';
            texto_tabla += '<th>Total Cliente</th>';
            if (status !== '2') {
                texto_tabla += '<th>Acciones</th>';
            }
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody id="bodyTableDetails">';

            texto_tabla += '</tbody>';
            texto_tabla += '</table>';
            $("#bodyModalDetails").html(texto_tabla);

            details.forEach((item, indice, array) => {
                item.boxs.forEach((box, index, boxs) => {
                    box.detailId = item.id;
                    if (box.typeBoxs.name.toUpperCase().trim() === "HB") {
                        acumHb += parseInt(box.boxNumber);
                    } else if (box.typeBoxs.name.toUpperCase().trim() === "QB") {
                        acumQb += parseInt(box.boxNumber);
                    } else {
                        acumEb += parseInt(box.boxNumber);
                    }
                    let textBox = '<tr>';
                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += item.farm.name_commercial;
                    textBox += '</td>';
                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += box.boxNumber;
                    qtyBox += parseInt(box.boxNumber);
                    textBox += '</td>';

                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += box.typeBoxs.name;
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

                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += '</td>';

                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += '</td>';

                    textBox += '<td bgcolor= "#f1f2f3">';
                    textBox += '</td>';
                    if (status !== '2') {
                        textBox += '<td bgcolor= "#f1f2f3">';
                        textBox += '<div class="edit-item-invoices" style="display:none">';
                        textBox += '<button class="btn btn-primary" id="delete_' + item.id + '" onclick=deleteItem("' + encodeB64Utf8(JSON.stringify(box)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                        textBox += '<button class="btn btn-danger" style="display:none" id="cancel_' + item.id + '" onclick=cancelDeleteItem("' + encodeB64Utf8(JSON.stringify(box)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg></button>';
                        textBox += '</div>';
                        textBox += '</td>';
                    }
                    textBox += '</tr>';
                    let acumBoxStems = 0;
                    let acumBoxBunches = 0;
                    let acumTotalBox = 0;
                    let acumBoxTotalStems = 0;
                    $('#bodyTableDetails').append(textBox);
                    if (box.varieties.length > 0) {
                        box.varieties.forEach(element => {
                            element.idBox = box.id;
                            element.detailId = item.id;
                            let textVariety = '<tr>';
                            textVariety += '<td>';
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.products.categoria.name;
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.products.name;
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.measures.name;
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.stems;
                            acumBoxStems += parseInt(element.stems) * parseInt(box.boxNumber);
                            qtyStems += parseInt(element.stems) * parseInt(box.boxNumber);

                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.bunches;
                            acumBoxBunches += parseInt(element.bunches) * parseInt(box.boxNumber);
                            qtyBouquets += parseInt(element.bunches) * parseInt(box.boxNumber);
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += parseInt(element.stems) * parseInt(element.bunches);
                            acumTotalStm += parseInt(element.stems) * parseInt(box.boxNumber) * parseInt(
                                element.bunches);
                            acumBoxTotalStems += parseInt(element.stems) * parseInt(element.bunches) *
                                parseInt(box.boxNumber);
                            textVariety += '</td>';

                            textVariety += '<td>';
                            textVariety += element.price;
                            textVariety += '</td>';


                            textVariety += '<td>';
                            let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) *
                                parseInt(element.bunches));
                            let totalTable = parseFloat(element.price) * (parseInt(element.stems) *
                                parseInt(box.boxNumber) * parseInt(element.bunches));
                            acumTotal += totalTable;
                            acumTotalBox += totalTable
                            let totalPriceFarm = parseFloat(element.price) * (parseInt(element.stems) * parseInt(element.bunches));
                            textVariety += totalPriceFarm.toFixed(2);
                            textVariety += '</td>';

                            textVariety += '<td>';
                            let priceCliente = 0;
                            let totalPriceCliente = 0;
                            let spanTotalCliente = '';
                            if (element.priceClient !== undefined) {
                                priceCliente = element.priceClient;
                                if (status !== '2') {
                                    textVariety += '<span class="text-success" id="priceCliente' + element + '">' + parseFloat(priceCliente).toFixed(2) + '</span> <span><button type="button" class="close" onclick=handleEditPrice("' + encodeB64Utf8(JSON.stringify(element)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button></span>';
                                } else {
                                    textVariety += '<span class="text-success" id="priceCliente' + element + '">' + parseFloat(priceCliente).toFixed(2) + '</span>';
                                }
                                totalPriceCliente = parseFloat(priceCliente) * (parseInt(element.stems) * parseInt(element.bunches));
                                spanTotalCliente = '<span class="text-success">' + totalPriceCliente.toFixed(2) + '</span>';
                            } else {
                                priceCliente = element.price;
                                if (status !== '2') {
                                    textVariety += '<span id="priceCliente' + element + '">' + parseFloat(priceCliente).toFixed(2) + '</span> <span><button type="button" class="close" onclick=handleEditPrice("' + encodeB64Utf8(JSON.stringify(element)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button></span>';
                                } else {
                                    textVariety += '<span id="priceCliente' + element + '">' + parseFloat(priceCliente).toFixed(2) + '</span>';
                                }
                                totalPriceCliente = parseFloat(priceCliente) * (parseInt(element.stems) * parseInt(element.bunches));
                                spanTotalCliente = '<span>' + totalPriceCliente.toFixed(2) + '</span>';

                            }
                            acumTotalCliente += totalPriceCliente;

                            textVariety += '</td>';

                            textVariety += '<td>';

                            textVariety += spanTotalCliente
                            textVariety += '</td>';
                            if (status !== '2') {
                                textVariety += '<td></td>';
                            }
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

                    textFooterBox += '</td>';

                    textFooterBox += '<td bgcolor= "#b9e0f1">';
                    textFooterBox += '</td>';

                    textFooterBox += '<td bgcolor= "#b9e0f1">';
                    textFooterBox += acumTotalBox.toFixed(2);
                    textFooterBox += '</td>';
                    if (status !== '2') {
                        textFooterBox += '<td bgcolor= "#b9e0f1">';
                        textFooterBox += '</td>';
                    }
                    textFooterBox += '</tr>';
                    $('#bodyTableDetails').append(textFooterBox);

                });

            });
            let textFooter = '<tfoot>';
            textFooter += '<tr>';
            textFooter += '<td>';
            textFooter += '</td>';

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

            textFooter += '<td>';
            textFooter += '</td>';

            textFooter += '<td>';
            textFooter += acumTotalCliente.toFixed(2);
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
            textResumen += '<div class="col-6">';
            textResumen += '<div class="table-responsive">';
            textResumen += '<table class="table table-bordered mb-4">';
            textResumen += '<tbody>';
            textResumen += '<tr>';
            textResumen += '<td class="text-right">Fulles</td>';
            textResumen += '<td class="text-right">' + fulles + '</td>';
            textResumen += '<td class="text-right">Total finca</td>';
            textResumen += '<td class="text-right">' + acumTotal.toFixed(2) + '</td>';
            textResumen += '</tr>';
            textResumen += '<tr>';
            textResumen += '<td class="text-right">Piezas</td>';
            textResumen += '<td class="text-right">' + qtyBox + '</td>';
            textResumen += '<td class="text-right">Total Cliente</td>';
            textResumen += '<td class="text-right">' + acumTotalCliente.toFixed(2) + '</td>';
            textResumen += '</tr>';
            textResumen += '<tr>';
            textResumen += '<td class="text-right">Tallos</td>';
            textResumen += '<td class="text-right">' + acumTotalStm + '</td>';
            textResumen += '<td class="text-right">Diferencia</td>';
            const diferencia = acumTotalCliente - acumTotal;
            if (diferencia > 0) {
                textResumen += '<td class="text-right">' + diferencia.toFixed(2) + '</td>';
            } else {
                textResumen += '<td class="text-right text-danger">' + diferencia.toFixed(2) + '</td>';
            }
            textResumen += '</tr>';
            textResumen += '<tr>';
            textResumen += '<td></td>';
            textResumen += '<td></td>';
            textResumen += '<td class="text-right">Comision</td>';
            textResumen += '<td class="text-right"></td>';
            textResumen += '</tr>';
            textResumen += '</tbody>';
            textResumen += '</table>';
            textResumen += '</div>';
            /*    textResumen +=
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
                   acumTotal.toFixed(2) + '</span></p>'; */
            textResumen += '</div>';
            textResumen += '</div>';
            $('#datatablesVarieties').after(textResumen);
        } else {
            $('#bodyModalDetails').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    const updateAwb = (objInvoice) => {
        objInvoice = decodeB64Utf8(objInvoice);
        objInvoice = JSON.parse(objInvoice);
        $('#titleModalAwb').text('<?= translate("invoice_number_lang"); ?>: ' + objInvoice.number_invoice);
        $('#lblNumberAwb').text('<?= translate("awb_lang"); ?>: ' + objInvoice.awb);
        $('#invoiceId').val(objInvoice.invoice);
        $("#awbEdit").val(objInvoice.awb);
        $('#modalAwb').modal({
            backdrop: false
        });
        $("#awbEdit").inputmask({
            mask: "999-9999-9999"
        })
        let until = flatpickr(document.getElementById('date'), {
            defaultDate: objInvoice.date_awb ? objInvoice.date_awb : 'today'
        });
        $('#airline').val(objInvoice.airline ? objInvoice.airline : '');
        if (objInvoice.status === 2) {
            $("#awbEdit").prop('disabled', true);
            $('#airline').prop('disabled', true);
            $('#date').prop('disabled', true);
            $('#btnUpdateAwb').hide();
        } else {
            $("#awbEdit").prop('disabled', false);
            $('#airline').prop('disabled', false);
            $('#date').prop('disabled', false);
            $('#btnUpdateAwb').show();
        }
    }

    const handleSubmitUpdateAwb = () => {
        let invoice = $('#invoiceId').val();
        let awb = $('#awbEdit').val().trim();
        let airline = $('#airline').val().trim();
        let dateAwb = $('#date').val().trim();
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
        } else if (airline == '') {
            swal({
                title: '¡Información!',
                text: "La Aerolínea es un campo obligatorio",
                type: 'info',
                showConfirmButton: true,
                padding: '2em'
            })
        } else if (dateAwb == '') {
            swal({
                title: '¡Información!',
                text: "La fecha es un campo obligatorio",
                type: 'info',
                showConfirmButton: true,
                padding: '2em'
            })
        } else {
            $('#modalAwb').modal('hide');
            Swal.fire({
                title: 'Completando operación',
                text: 'Actualizando Awb...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            let data = {
                invoice,
                awb,
                dateAwb,
                airline
            }
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/update_awb') ?>",
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
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.close();
                            swal({
                                title: '¡Error!',
                                text: `Existe una Awb:${awb}, asociada a la factura: ${result.data.number_invoice}`,
                                padding: '2em'
                            });
                            $('#modalAwb').modal({
                                backdrop: false
                            });
                        }
                    }
                });
            }, 1500)

        }
    }
</script>