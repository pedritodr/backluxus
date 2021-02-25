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
            <?= translate('manage_invoice_farms_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('invoice_farm/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
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
                                    <?php foreach ($all_invoice_farm as $item) { ?>
                                        <tr>
                                            <td>
                                            <p><?= $item->client->name_company.' | '. $item->client->name_commercial?></p>
                                            <p><b><?= translate("marking_lang"); ?>: <?= $item->markings->name_marking?></b></p>
                                            </td>
                                            <td>
                                                <p><strong><?= translate("invoice_number_lang"); ?> : </strong><?= $item->invoice_number; ?></p>
                                                <p><strong><?= translate("dispatch_day_lang"); ?> : </strong><?= $item->dispatch_day; ?></p>
                                                <p><strong><?= translate("awb_lang"); ?> : </strong><?= $item->awb; ?></p>
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
            <div class="modal-body" id="bodyModalDetails">

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
    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }
    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const verDetails = (details) => {
        details = decodeB64Utf8(details);
        details = JSON.parse(details);
        console.log(details)
        $("#modalDetails").modal('show');
        $("#bodyModalDetails").empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        if (details.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesVarieties" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
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
            texto_tabla += '<tbody>';
            details.forEach((item, indice, array) => {
                item.indice = indice;
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += item.boxNumber;
                qtyBox += parseInt(item.boxNumber);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.typeBoxs.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.products.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.measures.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.stems;
                qtyStems += parseInt(item.stems);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.bouquets;
                qtyBouquets += parseInt(item.bouquets);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += parseInt(item.stems) * parseInt(item.boxNumber) * parseInt(item.bouquets);
                acumTotalStm += parseInt(item.stems) * parseInt(item.boxNumber) * parseInt(item.bouquets);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += parseFloat(item.price).toFixed(2);
                acumPrice += parseFloat(item.price);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                let totalTable = parseFloat(item.price) * (parseInt(item.stems) * parseInt(item.boxNumber) * parseInt(item.bouquets));
                acumTotal += totalTable;
                texto_tabla += totalTable.toFixed(2);
                texto_tabla += '</td>';


                texto_tabla += '</tr>';
            });
            texto_tabla += '</tbody>';
            texto_tabla += '<tfoot>';
            texto_tabla += '<tr>';

            texto_tabla += '<td>';
            texto_tabla += qtyBox;
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += qtyStems;
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += qtyBouquets;
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += acumTotalStm;
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += acumPrice.toFixed(2);
            texto_tabla += '</td>';

            texto_tabla += '<td>';
            texto_tabla += acumTotal.toFixed(2);
            texto_tabla += '</td>';

            texto_tabla += '</tr>';
            texto_tabla += '</tfoot>'
            texto_tabla += '</table>'
            $("#bodyModalDetails").html(texto_tabla);
            $("#datatablesVarieties").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#bodyModalDetails').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }
</script>