<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    #modalDetails {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('management_fixed_orders_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('fixed_orders/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('list_fixed_orders_lang'); ?></h3>
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
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="verDetails('<?= base64_encode(json_encode($item->details)) ?>')"><i class="fa fa-edit"></i> <?= translate("details_lang"); ?></a>
                                                        <a class="dropdown-item" href="<?= site_url('fixed_orders/update_index/' . $item->fixed_orders) ?>"><i class="fa fa-edit"></i> <?= translate("edit_fixed_orders_lang"); ?></a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteOrder('<?= $item->fixed_orders ?>')"><i class="fa fa-edit"></i> <?= translate("delete_fixed_orders_lang"); ?></a>
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

<script>
    $(function() {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });

    const deleteOrder = (id) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("fixed_orders/delete"); ?>' + '/' + id;
                window.location.href = urlDelete;
            }
        })
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
</script>