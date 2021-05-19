<style>
    .nav-margin-bottom {
        margin-bottom: 20px;
    }

    #modalDetails {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalImages {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<link href="<?= base_url('admin_template/assets/css/components/tabs-accordian/custom-tabs.css'); ?>" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <p class="titulo">
            <?= translate('management_credit_lang'); ?>
            <small class="titulo-2"></small>
            | <a href="<?= site_url('credit/add_index'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?= translate('add_item_lang'); ?></a>
        </p>
        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('ready_credit_lang'); ?></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <div class="table-responsive">
                        <br />
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("markings_lang"); ?></th>
                                    <th><?= translate("farms_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($credits) { ?>
                                    <?php foreach ($credits as $item) { ?>
                                        <tr>
                                            <td>
                                                <p><?= $item->marking->name_company . ' | ' . $item->marking->name_commercial ?></p>
                                                <p><b><?= translate("marking_lang"); ?>: <?= $item->marking->name_marking ?></b></p>
                                                <p><strong><?= translate("invoice_number_lang"); ?> : </strong><?= $item->inovice->number_invoice; ?></p>
                                            </td>
                                            <td>
                                                <p><?= $item->farm->farm->name_commercial; ?></p>
                                                <p><?= $item->farm->farm->address_farm; ?></p>
                                                <p><strong><?= translate("invoice_number_lang"); ?> : </strong><?= $item->farm->farm->invoice_number; ?></p>
                                            </td>
                                            <td>
                                                <a href="<?= site_url('credit/update_index/' . $item->credit_id); ?>" class="btn btn-warning"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="handleDetails('<?= base64_encode(json_encode($item->items)) ?>')" class="btn btn-primary"><i class="fa fa-remove"></i> <?= translate("details_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="handleImages('<?= base64_encode(json_encode($item->images)) ?>')" class="btn btn-info"><i class="fa fa-remove"></i> <?= translate("images_lang"); ?></a>
                                                <a href="javascript:void(0)" onclick="deleteCredit('<?= $item->credit_id ?>')" class="btn btn-danger"><i class="fa fa-remove"></i> <?= translate("delete_lang"); ?></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("markings_lang"); ?></th>
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
<div class="modal fadeInDown" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('details_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive" id="bodyDetails">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fadeInDown" id="modalImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('images_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="container" style="max-width: 928px;">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-5 p-0">
                                    <div id="carouselExampleCaptions" class="carousel slide style-custom-1" data-ride="carousel">
                                        <div class="carousel-inner">

                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const deleteCredit = (creditId) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                let urlDelete = '<?= site_url("credit/delete"); ?>' + '/' + creditId;
                window.location.href = urlDelete;
            }
        })
    }
    $(function() {

        $("#example1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });

    const encodeB64Uft8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Uft8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const handleDetails = (items) => {
        let arrItemsCredit = JSON.parse(decodeB64Uft8(items));
        $('#modalDetails').modal({
            backdrop: false
        })
        $('#bodyDetails').empty();
        let acumTotalStm = 0;
        let acumTotal = 0;
        if (arrItemsCredit.length > 0) {
            let textVariety = '';
            textVariety +=
                '<table id="datatablesVarieties" class="table table-striped" cellspacing="0" width="100%" style="width:100%">';
            textVariety += '<thead>';
            textVariety += '<tr>';
            textVariety += '<th>VARIETIES</th>';
            textVariety += '<th>CM</th>';
            textVariety += '<th>CANTIDAD DE TALLOS</th>';
            textVariety += '<th>DESCRIPCIÓN</th>';
            textVariety += '<th>PRICE</th>';
            textVariety += '<th>TOTAL</th>';
            textVariety += '</tr>';
            textVariety += '</thead>';
            textVariety += '<tbody id="bodyTableDetails">';
            arrItemsCredit.forEach((element, indice, varieties) => {
                textVariety += '<tr>';

                textVariety += '<td>';
                textVariety += element.itemSelected.products.name;
                textVariety += '</td>';

                textVariety += '<td>';
                textVariety += element.itemSelected.measures.name;
                textVariety += '</td>';

                textVariety += '<td>';
                textVariety += element.qtyStems;
                acumTotalStm += parseInt(element.qtyStems);
                textVariety += '</td>';

                textVariety += '<td>';
                textVariety += element.reasonCredit.reason;
                textVariety += '</td>';

                textVariety += '<td>';
                textVariety += parseFloat(element.itemSelected.price).toFixed(2);
                textVariety += '</td>';

                textVariety += '<td>';
                let totalBoxItem = parseFloat(element.itemSelected.price) * (parseInt(element.qtyStems));

                acumTotal += totalBoxItem;
                textVariety += totalBoxItem.toFixed(2);
                textVariety += '</td>';

                textVariety += '<td>';

                textVariety += '</td>';

                textVariety += '</tr>';

            });
            textVariety += '</tbody>';
            textVariety += '</table>';
            $('#bodyDetails').html(textVariety);
        } else {
            $('#bodyDetails').append('<div class="alert alert-info"><?= translate('msg_load_invoice_lang') ?></div>');
        }
    }

    const handleImages = (images) => {
        const baseUrl = '<?= base_url() ?>';
        images = JSON.parse(decodeB64Uft8(images));
        console.log(images);
        $('.carousel-inner').empty();
        let stringImages = '';
        images.forEach((element, index) => {
            if (index === 0) {
                stringImages += '<div class="carousel-item active">';
                stringImages += '<img class="d-block w-100 slide-image" src="' + baseUrl + element.img + '" alt="' + element.img_id + '">';
                stringImages += '</div>';
            } else {
                stringImages += '<div class="carousel-item">';
                stringImages += '<img class="d-block w-100 slide-image" src="' + baseUrl + element.img + '" alt="' + element.img_id + '">';
                stringImages += '</div>';
            }

        });
        $('.carousel-inner').append(stringImages);
        $('#modalImages').modal({
            backdrop: false
        })
    }
</script>