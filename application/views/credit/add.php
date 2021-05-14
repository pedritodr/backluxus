<style>
    #modalItem {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalDetails {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalDescription {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalImages {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>

<link href="<?= base_url() ?>admin_template/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('management_credit_lang') ?> | <a href="<?= site_url('credit/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('add_credit_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("reason_credit/add"); ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <label><?= translate("markings_lang"); ?></label>
                            <div class="input-group">
                                <select id="markings" name="markings" class="form-control select2 input-sm" onchange="handleOnChangeMarking()" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('select_opction_lang') ?></option>
                                    <?php if ($clients) { ?>
                                        <?php foreach ($clients as $item) { ?>
                                            <?php if (isset($item->markings)) { ?>
                                                <?php if (count($item->markings) > 0) { ?>
                                                    <?php foreach ($item->markings as $marking) { ?>
                                                        <?php $marking->name_commercial = $item->name_commercial;
                                                        $marking->name_company = $item->name_company;
                                                        ?>
                                                        <option value="<?= base64_encode(json_encode($marking)) ?>"><?= $marking->name_marking . ' | ' . $item->name_commercial ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php   } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("list_invoice_farm_lang"); ?></label>
                            <div class="input-group">
                                <select id="selectInvoice" name="selectInvoice" class="form-control select2 input-sm" onchange="handleOnChangeInvoice()" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('select_opction_lang') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label><?= translate("farms_lang"); ?></label>
                            <div class="input-group">
                                <select id="selectFarms" name="selectFarms" class="form-control select2 input-sm" onchange="handleOnChangeFarm()" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('select_opction_lang') ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="statbox widget box box-shadow" style="margin-top: 25px;">
                <div class="widget-header">
                    <h3 class="text-simple"><?= translate('invoice_lang') ?> <span>
                            <button class="btn btn-outline-danger mb-2" onclick="handleDescription()"><?= translate('descripcion_lang') ?></button>
                            <button class="btn btn-outline-secondary mb-2" onclick="handleImages()"><?= translate('add_images_lang') ?></button>
                            <button class="btn btn-outline-dark mb-2" onclick="handleDetails()"><?= translate('details_lang') ?></button>
                            <button class="btn btn-outline-info mb-2" onclick="handleSubmitCreateCredit()"><?= translate('create_credit_lang') ?></button>
                        </span></h3>
                </div><!-- /.box-header -->
                <div class="widget-content widget-content-area">
                    <div class="table-responsive" id="zoneContents">
                        <div class="alert alert-info"><?= translate('msg_load_invoice_lang') ?></div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->

<div class="modal fadeInDown" id="modalItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('add_credit_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("ready_reason_credit_lang"); ?></label>
                        <div class="input-group">
                            <select id="reasonCredit" name="reasonCredit" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($reason_credits) { ?>
                                    <?php foreach ($reason_credits as $item) { ?>
                                        <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->reason_credit_id ?>"><?= $item->reason ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("qty_stems_lang"); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            <input autocomplete="off" type="number" class="form-control input-sm" id="qtyStems" placeholder="<?= translate('qty_stems_lang'); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <imput id="indexBox" type="hidden" />
                <imput id="indiceVarieties" type="hidden" />
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button class="btn btn-info" id="btnModalItemCredit" onclick="handleAddItemCredit()"><?= translate('add_item_credit_lang') ?></button>
            </div>
        </div>
    </div>
</div>
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
<div class="modal fadeInDown" id="modalDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('descripcion_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group"><?= translate('escriba_aqui_lang') ?></span>
                        </div>
                        <textarea class="form-control" id="textDescription" aria-label="<?= translate('escriba_aqui_lang') ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
                <button class="btn btn-primary" onclick="handleSaveDescription()"><?= translate('save_description_lang') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fadeInDown" id="modalImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= translate('add_images_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="custom-file-container" data-upload-id="uploadImages">
                            <label>Upload (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file">
                                <input type="file" class="custom-file-container__custom-file__custom-file-input" multiple>
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
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
<script src="<?= base_url() ?>admin_template/plugins/file-upload/file-upload-with-preview.min.js"></script>
<script>
    let uploadImages;
    $(() => {
        $("#markings").select2({
            tags: false,
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });
        $("#markings").select2('open');
        $("#markings").select2({
            tags: false,
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });
        $("#reasonCredit").select2({
            tags: false,
            dropdownParent: $("#modalItem"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });
        uploadImages = new FileUploadWithPreview('uploadImages', {

        })
    })

    const encodeB64Uft8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Uft8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    let invoices = [];

    const handleOnChangeMarking = () => {
        invoices = [];
        let marking = $('select[id=markings] option').filter(':selected').val();
        marking !== '0' ? marking = JSON.parse(decodeB64Uft8(marking)) : marking = '0';
        handleLoadDetail();
        if (marking !== '0') {
            Swal.fire({
                title: 'Completando operación',
                text: 'Buscando facturas del cliente...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('invoice_farm/search_invoice_by_marking') ?>",
                    data: {
                        id: marking.marking_id
                    },
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
                            $("#selectInvoice").empty();
                            if (result.data.length > 0) {
                                invoices = result.data;
                                let stringInvoice = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                                result.data.forEach(item => {
                                    stringInvoice += '<option value="' + encodeB64Uft8(JSON.stringify(item)) + '" itemId="' + item.invoice + '"> Fact-' + item.number_invoice + '</option>'
                                });
                                $('#selectInvoice').append(stringInvoice);
                                $('#selectInvoice').prop('disabled', false);
                                $("#selectInvoice").select2({
                                    tags: false,
                                    placeholder: '<?= translate('select_opction_lang') ?>',
                                    allowClear: false,
                                });
                            } else {
                                swal({
                                    title: '¡Error!',
                                    text: `No se encontraron facturas del cliente ${marking.name_commercial}`,
                                    padding: '2em'
                                });
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
            }, 1500)

        } else {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione la marcación para continuar',
                padding: '2em',
            })
        }
    }

    let farms = [];

    const handleOnChangeInvoice = () => {
        let invoice = $('select[id=selectInvoice] option').filter(':selected').val();
        invoice !== '0' ? invoice = JSON.parse(decodeB64Uft8(invoice)) : invoice = '0';
        $('#selectFarms').empty();
        farms = [];
        handleLoadDetail();
        arrItemsCredit = [];
        if (invoice !== '0') {
            Swal.fire({
                title: 'Completando operación',
                text: 'Buscando fincas asociadas a la factura...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            let stringFarms = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
            invoice.details.forEach(item => {
                stringFarms += '<option value="' + encodeB64Uft8(JSON.stringify(item)) + '" itemId="' + item.id + '">' + item.farm.name_legal + ' | ' + item.farm.name_commercial + '</option>'
            });
            $('#selectFarms').append(stringFarms);
            $('#selectFarms').prop('disabled', false);
            $("#selectFarms").select2({
                tags: false,
                placeholder: '<?= translate('select_opction_lang') ?>',
                allowClear: false,
            });
            setTimeout(() => {
                Swal.close();
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
            }, 1500);
            farms = invoice.details;

        } else {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione la factura para continuar',
                padding: '2em',
            })
        }
    }

    let invoiceSelected = [];

    const handleOnChangeFarm = () => {
        let farm = $('select[id=selectFarms] option').filter(':selected').val();
        farm !== '0' ? farm = JSON.parse(decodeB64Uft8(farm)) : farm = '0';
        invoiceSelected = [];
        arrItemsCredit = [];
        if (farm !== '0') {
            handleLoadDetail(farm);
            Swal.fire({
                title: 'Completando operación',
                text: 'Buscando la factura asociada...',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            setTimeout(() => {
                Swal.close();
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
            }, 1500);
        } else {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione una finca para continuar',
                padding: '2em',
            })
        }
    }

    const handleLoadDetail = (details = false) => {
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        let acumHb = 0;
        let acumQb = 0;
        let acumEb = 0;
        invoiceSelected = details;
        $("#zoneContents").empty();
        if (details) {
            let texto_tabla = '';
            texto_tabla +=
                '<table id="datatablesVarieties" class="table table-striped table-no-bordered" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>NRO FACTURA</th>';
            texto_tabla += '<th>NRO BOX</th>';
            texto_tabla += '<th>BOX TYPE</th>';
            texto_tabla += '<th>VARIETIES</th>';
            texto_tabla += '<th>CM</th>';
            texto_tabla += '<th>STEMS</th>';
            texto_tabla += '<th>BOUQUETS</th>';
            texto_tabla += '<th>TOTAL STM</th>';
            texto_tabla += '<th>PRICE</th>';
            texto_tabla += '<th>TOTAL</th>';
            texto_tabla += '<th>ACCIONES</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody id="bodyTableDetails">';

            texto_tabla += '</tbody>';
            texto_tabla += '</table>';
            $("#zoneContents").html(texto_tabla);

            invoiceSelected.boxs.forEach((box, index, boxs) => {

                if (box.typeBoxs.name.toUpperCase().trim() === "HB") {
                    acumHb += parseInt(box.boxNumber);
                } else if (box.typeBoxs.name.toUpperCase().trim() === "QB") {
                    acumQb += parseInt(box.boxNumber);
                } else {
                    acumEb += parseInt(box.boxNumber);
                }
                let textBox = '<tr>';

                textBox += '<td bgcolor= "#f1f2f3">';
                textBox += invoiceSelected.farm.invoice_number;
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

                textBox += '</tr>';
                let acumBoxStems = 0;
                let acumBoxBunches = 0;
                let acumTotalBox = 0;
                let acumBoxTotalStems = 0;
                $('#bodyTableDetails').append(textBox);
                if (box.varieties.length > 0) {
                    box.varieties.forEach((element, indice, varieties) => {
                        element.invoceFarm = box.invoice_farm;
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

                        textVariety += '<td>';
                        textVariety += '<div class="edit-item-invoices">';
                        textVariety += '<button class="btn btn-primary" id="btnAddCredit' + element.id + '" onclick=handleModalAddCredit("' + index + '","' + indice + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></button>';
                        textVariety += '<button class="btn btn-warning" style="display:none" id="editBtnCredit' + element.id + '" onclick=handleModalEditItemCredit("' + index + '","' + indice + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></button>';
                        textVariety += '<button class="btn btn-danger" style="display:none" id="cancelBtnCredit' + element.id + '" onclick=handleCancelDeleteItem("' + index + '","' + indice + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg></button>';
                        textVariety += '</div>';
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
                '<p class="text-left"><b>PIEZAS= </b> <span style="color: #fd6a6a;font-handleModalItemCreditfont-size: 16px;font-weight: bold;">' +
                acumTotalStm + '</span></p>';
            textResumen +=
                '<p class="text-left"><b>TOTAL= </b> <span style="color: #fd6a6a;font-size: 16px;font-weight: bold;">$ ' +
                acumTotal.toFixed(2) + '</span></p>';
            textResumen += '</div>';
            textResumen += '</div>';
            $('#datatablesVarieties').after(textResumen);
        } else {
            $('#zoneContents').append('<div class="alert alert-info"><?= translate('msg_load_invoice_lang') ?></div>');
        }
    }

    const handleModalAddCredit = (indexBox, indiceVarieties) => {
        $('#indexBox').val(indexBox);
        $('#indiceVarieties').val(indiceVarieties);
        $('#qtyStems').val('');
        $('[id=reasonCredit]').val(0);
        $('#reasonCredit').trigger('change');
        $('#btnModalItemCredit').text('<?= translate('add_item_credit_lang') ?>').attr('onclick', 'handleAddItemCredit()');
        $('#modalItem').modal({
            backdrop: false
        })
    }

    let arrItemsCredit = [];

    const handleAddItemCredit = () => {
        let indexBox = $('#indexBox').val();
        let indiceVarieties = $('#indiceVarieties').val();
        let qtyStems = $('#qtyStems').val().trim() !== '' ? parseFloat($('#qtyStems').val().trim()) : 0;
        let reasonCredit = $('select[id=reasonCredit] option').filter(':selected').attr('itemId');
        reasonCredit !== '0' ? reasonCredit = JSON.parse(decodeB64Uft8(reasonCredit)) : reasonCredit = '0';
        let itemSelected = invoiceSelected.boxs[indexBox].varieties[indiceVarieties];
        let totalStems = parseInt(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].stems) * parseInt(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].bunches);
        if (reasonCredit === '0') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione el motivo del crédito para continuar',
                padding: '2em',
            })
        } else if (qtyStems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Cantidad de tallos es un campo obligatorio',
                padding: '2em',
            })
        } else if (qtyStems > totalStems) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Cantidad de tallos es mayor que la registrada en el pedido',
                padding: '2em',
            })
        } else {
            let obj = {
                reasonCredit,
                qtyStems,
                itemSelected
            };
            invoiceSelected.boxs[indexBox].varieties[indiceVarieties].credit = obj;
            $('#editBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).show();
            $('#cancelBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).show();
            $('#btnAddCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).hide();
            handleAddItemArr(obj);
            $('#modalItem').modal('hide');
        }
    }

    const handleModalEditItemCredit = (indexBox, indiceVarieties) => {
        $('#indexBox').val(indexBox);
        $('#indiceVarieties').val(indiceVarieties);
        $('#qtyStems').val(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].credit.qtyStems);
        $('[id=reasonCredit]').val(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].credit.reasonCredit.reason_credit_id);
        $('#reasonCredit').trigger('change');
        $('#btnModalItemCredit').text('<?= translate('udapte_item_credit_lang') ?>').attr('onclick', 'handleEditItemCredit()');
        $('#modalItem').modal({
            backdrop: false
        })
    }

    const handleEditItemCredit = () => {
        let indexBox = $('#indexBox').val();
        let indiceVarieties = $('#indiceVarieties').val();
        let qtyStems = $('#qtyStems').val().trim() !== '' ? parseFloat($('#qtyStems').val().trim()) : 0;
        let reasonCredit = $('select[id=reasonCredit] option').filter(':selected').attr('itemId');
        reasonCredit !== '0' ? reasonCredit = JSON.parse(decodeB64Uft8(reasonCredit)) : reasonCredit = '0';
        let itemSelected = invoiceSelected.boxs[indexBox].varieties[indiceVarieties];
        let totalStems = parseInt(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].stems) * parseInt(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].bunches);
        if (reasonCredit === '0') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione el motivo del crédito para continuar',
                padding: '2em',
            })
        } else if (qtyStems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Cantidad de tallos es un campo obligatorio',
                padding: '2em',
            })
        } else if (qtyStems > totalStems) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Cantidad de tallos es mayor que la registrada en el pedido',
                padding: '2em',
            })
        } else {
            let obj = {
                reasonCredit,
                qtyStems,
                itemSelected
            };
            invoiceSelected.boxs[indexBox].varieties[indiceVarieties].credit = obj;
            $('#editBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).show();
            $('#cancelBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).show();
            $('#btnAddCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).hide();
            handleUdapteItemArr(obj);
            $('#modalItem').modal('hide');
        }
    }

    const handleAddItemArr = (object) => {
        arrItemsCredit.push(object);
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

    const handleUdapteItemArr = (object) => {
        for (let i = 0; i < arrItemsCredit.length; i++) {
            if (arrItemsCredit[i].itemSelected.id === object.itemSelected.id) {
                arrItemsCredit[i] = object;
                break;
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

    const handleCancelDeleteItem = (indexBox, indiceVarieties) => {
        let object = invoiceSelected.boxs[indexBox].varieties[indiceVarieties];
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                delete(invoiceSelected.boxs[indexBox].varieties[indiceVarieties].credit);
                $('#editBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).hide();
                $('#cancelBtnCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).hide();
                $('#btnAddCredit' + invoiceSelected.boxs[indexBox].varieties[indiceVarieties].id).show();
                for (let i = 0; i < arrItemsCredit.length; i++) {
                    if (arrItemsCredit[i].itemSelected.id === object.id) {
                        arrItemsCredit.splice(i, 1);
                        break;
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

    const handleDetails = () => {
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

    let description = '';

    const handleDescription = () => {
        $('#textDescription').text(description);
        $('#modalDescription').modal({
            backdrop: false
        })
    }

    const handleSaveDescription = () => {
        description = $('#textDescription').text();
        $('#modalDescription').modal('hide');
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

    const handleImages = async () => {
        $('#modalImages').modal({
            backdrop: false
        })
    }
    window.addEventListener("fileUploadWithPreview:imagesAdded", function(e) {
        e.detail.cachedFileArray
        createImages(e.detail.cachedFileArray);
    });


    const createImages = async (arr) => {
        for (let i = 0; i < arr.length; i++) {
            let objectURL = URL.createObjectURL(arr[i]);
            let result = fetchAsBlob(objectURL)
                .then(convertBlobToBase64)
                .then(arrCallback);
        }
    }

    const fetchAsBlob = url => fetch(url)
        .then(response => response.blob());

    const convertBlobToBase64 = blob => new Promise((resolve, reject) => {
        const reader = new FileReader;
        reader.onerror = reject;
        reader.onload = () => {
            resolve(reader.result);
        };
        reader.readAsDataURL(blob);
    });

    const arrCallback = (img) => {
        arrImages.push({
            img
        })
    }
    let arrImages = [];

    const handleSubmitCreateCredit = async () => {

        let marking = $('select[id=markings] option').filter(':selected').val();
        marking !== '0' ? marking = JSON.parse(decodeB64Uft8(marking)) : marking = '0';
        let invoice = $('select[id=selectInvoice] option').filter(':selected').val();
        invoice !== '0' ? invoice = JSON.parse(decodeB64Uft8(invoice)) : invoice = '0';
        let farm = $('select[id=selectFarms] option').filter(':selected').val();
        farm !== '0' ? farm = JSON.parse(decodeB64Uft8(farm)) : farm = '0';
        if (marking == '0') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione la marcación para continuar',
                padding: '2em',
            })
        } else if (invoice == '0') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione la factura para continuar',
                padding: '2em',
            })
        } else if (farm == '0') {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Seleccione una finca para continuar',
                padding: '2em',
            })
        } else if (arrItemsCredit.length == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'No tiene items para crear el crédito',
                padding: '2em',
            })
        } else if (arrImages.length == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'info',
                title: 'Para continuar tiene que cargar las imagenes',
                padding: '2em',
            })
        } else {
            Swal.fire({
                title: 'Completando operación',
                html: '<h5 id="textCreateCredit">Creando crédito...</h5>',
                imageUrl: '<?= base_url("assets/img/cargando.gif") ?>',
                imageAlt: 'No realice acciones sobre la página',
                showConfirmButton: false,
                allowOutsideClick: false,
                footer: '<a href>No realice acciones sobre la página</a>',
            });
            arrItemsCredit.forEach(item => {
                delete(item.itemSelected.credit);
            });
            delete(marking._id);
            marking = JSON.stringify(marking);
            arrItemsCredit = JSON.stringify(arrItemsCredit);
            invoice = JSON.stringify(invoice);
            farm = JSON.stringify(farm);
            let data = {
                invoice,
                arrItemsCredit,
                marking,
                farm,
                description
            };

            setTimeout(async () => {
                let response = await createCredit(data);
                response = JSON.parse(response);
                if (response.status == 200) {
                    $('#textCreateCredit').text('Creando imagenes');
                    let chunkedArray = await chunkedFunctionArray(arrImages, 5);
                    for (let i = 0; i < chunkedArray.length; i++) {
                        let responseUpdate = await createImagen(response.data, JSON.stringify(chunkedArray[i]));
                    }
                    Swal.fire({
                        type: 'success',
                        title: 'Crédito creado correctamente',
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        window.location = '<?= site_url('credit/index') ?>';
                    }, 1000);
                } else {
                    Swal.close();
                    swal({
                        title: '¡Error!',
                        text: result.msj,
                        padding: '2em'
                    });
                }
            }, 1500)
        }
    }

    const createImagen = async (id, images) => {
        return $.ajax({
            type: 'POST',
            url: "<?= site_url('credit/add_images') ?>",
            data: {
                id,
                images
            },
            success: function(result) {
                result = JSON.parse(result);
            }
        })
    }

    const createCredit = async (data) => {
        return $.ajax({
            type: 'POST',
            url: "<?= site_url('credit/add') ?>",
            data: data,
            success: function(result) {
                result = JSON.parse(result);
            }
        })
    }

    const chunkedFunctionArray = async (files, number) => {
        let size = number;
        const chunked_arr = [];
        for (let i = 0; i < files.length; i++) {
            const last = chunked_arr[chunked_arr.length - 1];
            if (!last || last.length === size) {
                chunked_arr.push([files[i]]);
            } else {
                last.push(files[i]);
            }
        }
        return chunked_arr;
    }
</script>