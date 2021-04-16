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

    .modal-content .modal-header svg {
        width: 28px;
        color: #acb0c3;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('invoice_client_lang'); ?>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('listar_invoice_clients_lang'); ?></h3>
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
                                    <?php foreach ($all_invoice as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><?= $item->marking->name_company . ' | ' . $item->marking->name_commercial ?></p>
                                                <p><b><?= translate("marking_lang"); ?>: <?= $item->marking->name_marking ?></b></p>
                                            </td>
                                            <td>
                                                <p><strong><?= translate("dispatch_day_lang"); ?> : </strong><?= $item->details[0]->farm->dispatch_day; ?></p>
                                                <p><strong><?= translate("awb_lang"); ?> : </strong><?= $item->awb; ?></p>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-4 mr-2" role="group">
                                                    <button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                        </svg></button>
                                                    <div class="dropdown-menu" aria-labelledby="btnOutline">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="verDetails('<?= base64_encode(json_encode($item->details)) ?>','<?= $item->invoice ?>')"><i class="fa fa-edit"></i> <?= translate("details_lang"); ?></a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="cancelInvoice('<?= $item->invoice ?>')"><i class="fa fa-edit"></i> <?= translate("cancel_invoice_lang"); ?></a>
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
                <button type="button" class="close" onclick="handleActiveEdit()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </button>
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
    const verDetails = (details, id) => {
        details = decodeB64Utf8(details);
        details = JSON.parse(details);
        idInvoice = id;
        arrayDetails = details;
        arrayDeleteItems = [];
        $('#modalDetails').modal({
            backdrop: false
        })
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
                '<table id="datatablesVarieties" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>FARM</th>';
            texto_tabla += '<th>NRO BOX</th>';
            texto_tabla += '<th>BOX TYPE</th>';
            texto_tabla += '<th>VARIETIES</th>';
            texto_tabla += '<th>CM</th>';
            texto_tabla += '<th>STEMS</th>';
            texto_tabla += '<th>BOUQUETS</th>';
            texto_tabla += '<th>TOTAL STM</th>';
            texto_tabla += '<th>PRICE</th>';
            texto_tabla += '<th>TOTAL</th>';
            texto_tabla += '<th>Acciones</th>';
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
                    textBox += '<div class="edit-item-invoices" style="display:none">';
                    textBox += '<button class="btn btn-primary" id="delete_' + item.id + '" onclick=deleteItem("' + encodeB64Utf8(JSON.stringify(box)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                    textBox += '<button class="btn btn-danger" style="display:none" id="cancel_' + item.id + '" onclick=cancelDeleteItem("' + encodeB64Utf8(JSON.stringify(box)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg></button>';
                    textBox += '</div>';
                    textBox += '</td>';

                    textBox += '</tr>';
                    let acumBoxStems = 0;
                    let acumBoxBunches = 0;
                    let acumTotalBox = 0;
                    let acumBoxTotalStems = 0;
                    $('#bodyTableDetails').append(textBox);
                    if (box.varieties.length > 0) {
                        box.varieties.forEach(element => {
                            let textVariety = '<tr>';
                            textVariety += '<td>';
                            textVariety += '</td>';

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
                            textVariety += parseFloat(element.price).toFixed(2);
                            textVariety += '</td>';

                            textVariety += '<td>';
                            let totalBoxItem = parseFloat(element.price) * (parseInt(element.stems) *
                                parseInt(element.bunches));
                            let totalTable = parseFloat(element.price) * (parseInt(element.stems) *
                                parseInt(box.boxNumber) * parseInt(element.bunches));
                            acumTotal += totalTable;
                            acumTotalBox += totalTable
                            textVariety += totalBoxItem.toFixed(2);
                            textVariety += '</td>';

                            textVariety += '<td></td>';

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
                    textFooterBox += '<td bgcolor= "#b9e0f1">';
                    textFooterBox += '</td>';

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

    const cancelInvoice = (id) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cancelar factura',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlCancel = '<?= site_url("invoice_farm/cancel_invoice_client"); ?>' + '/' + id;
                window.location.href = urlCancel;
            }
        })
    }

    const handleActiveEdit = () => {
        if (!activeEdit) {
            activeEdit = true;
            $('.edit-item-invoices').show()
            $('#btnUpdateInvoice').show();
        } else {
            activeEdit = false;
            $('#btnUpdateInvoice').hide();
            $('.edit-item-invoices').hide();
        }
    }

    let arrayDeleteItems = [];

    const deleteItem = (item) => {
        swal({
            title: '¿ Quieres eliminar este item ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                item = JSON.parse(decodeB64Utf8(item));
                arrayDeleteItems.push(item);
                $('#delete_' + item.detailId).hide();
                $('#cancel_' + item.detailId).show();
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
            }
        })
    }

    const cancelDeleteItem = (item) => {

        swal({
            title: '¿ Quieres volver este item a la factura ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                item = JSON.parse(decodeB64Utf8(item));
                if (arrayDeleteItems.length > 0) {
                    const index = arrayDeleteItems.findIndex(x => x.detailId === item.detailId);
                    if (index > -1) {
                        arrayDeleteItems.splice(index, 1);
                        $('#delete_' + item.detailId).show();
                        $('#cancel_' + item.detailId).hide();
                    }
                }
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
            }
        })
    }

    const handleUpdateItems = () => {
        if (arrayDeleteItems.length > 0) {
            if (arrayDeleteItems.length == arrayDetails.length) {
                cancelInvoice(idInvoice);
            } else {
                Swal.fire({
                    title: 'Completando operación',
                    text: 'Actualizando invoice del cliente...',
                    imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                    imageAlt: 'No realice acciones sobre la página',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    footer: '<a href>No realice acciones sobre la página</a>',
                });
                let invoice = idInvoice;
                let arrayRequest = JSON.stringify(arrayDeleteItems);
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
                title: '¡Error!',
                text: 'No tiene items seleccionados',
                padding: '2em'
            });
        }
    }
</script>