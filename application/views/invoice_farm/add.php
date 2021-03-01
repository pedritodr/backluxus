<link rel="stylesheet" type="text/css" href="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.css">
<link href="<?= base_url() ?>admin_template/assets/css/elements/search.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>admin_template/assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<link rel="stylesheet preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
<style>
    #grad1 {
        background-color: : #9C27B0;
        background-image: linear-gradient(120deg, #FF4081, #81D4FA)
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;
        position: relative
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E
    }

    #msform .action-button {
        cursor: pointer;
    }

    #msform .action-button-previous {
        cursor: pointer;
    }

    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 33%;
        float: left;
        position: relative
    }

    #progressbar #farm:before {
        font-family: FontAwesome;
        content: "\f0c9"
    }

    #progressbar #data:before {
        font-family: FontAwesome;
        content: "\f129"
    }

    #progressbar #products:before {
        font-family: FontAwesome;
        content: "\f0ae"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: skyblue
    }

    #modalAddVarieties {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    #modalItems {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }
</style>
<div class="main-container" id="container">
    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_invoice_farms_lang') ?> | <a href="<?= site_url('invoice_farm/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>
        <div class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4><?= translate('add_invoice_farm_lang') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="farm"><strong><?= translate('client_farm_lang') ?></strong></li>
                                    <li id="data"><strong><?= translate('data_lang') ?></strong></li>
                                    <li id="products"><strong><?= translate('details_lang') ?></strong></li>
                                </ul> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8">
                                                <label><?= translate("farms_lang"); ?></label>
                                                <div class="input-group">
                                                    <select id="selectFarms" name="farms" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                                        <option value="0"><?= translate('select_opction_lang') ?></option>
                                                        <?php if ($farms) { ?>
                                                            <?php foreach ($farms as $item) { ?>
                                                                <option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name_legal . ' | ' . $item->name_commercial ?></option>
                                                            <?php   } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8">
                                                <label><?= translate("markings_lang"); ?></label>
                                                <div class="input-group">
                                                    <select id="markings" name="markings" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                                        <option value="0"><?= translate('select_opction_lang') ?></option>
                                                        <?php if ($clients) { ?>
                                                            <?php foreach ($clients as $item) { ?>
                                                                <?php if (isset($item->markings)) { ?>
                                                                    <?php if (count($item->markings) > 0) { ?>
                                                                        <?php foreach ($item->markings as $marking) { ?>
                                                                            <option value="<?= base64_encode(json_encode($marking)) ?>"><?= $marking->name_marking . ' | ' . $item->name_commercial ?></option>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            <?php   } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div>

                                    <input type="button" name="next" class="next action-button btn btn-info" value="<?= translate('next_lang') ?>" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label><?= translate("invoice_number_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" name="invoceNumber" id="invoceNumber" placeholder="<?= translate('invoice_number_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label><?= translate("dispatch_day_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" name="dispatchDay" id="dispatchDay" placeholder="<?= translate('dispatch_day_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label><?= translate("awb_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="awb" name="awb" placeholder="<?= translate('awb_lang'); ?>">
                                                </div>
                                            </div>

                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("date2_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm" id="date" name="date" placeholder="<?= translate('date2_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("to_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="to" name="to" placeholder="<?= translate('to_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("country_lang"); ?></label>
                                                <div class="input-group">
                                                    <select id="country" name="country" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                                        <option value="0"><?= translate('select_opction_lang') ?></option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("address2_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="address" name="address" placeholder="<?= translate('address2_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("customer_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="customer" name="customer" placeholder="<?= translate('customer_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("airline_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="airline" name="airline" placeholder="<?= translate('airline_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("shippement_date_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm" id="shippementDate" name="shippement_date" placeholder="<?= translate('shippement_date_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("due_date_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="dueDate" name="due_date" placeholder="<?= translate('due_date_lang'); ?>">
                                                </div>
                                            </div>

                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("hawb_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="hawb" name="hawb" placeholder="<?= translate('hawb_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("freigh_forward_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="freighForward" name="freigh_forward" placeholder="<?= translate('freigh_forward_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-3">
                                                <label><?= translate("packing_list_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="packingList" name="packing_list" placeholder="<?= translate('packing_list_lang'); ?>">
                                                </div>
                                            </div>
                                            <div style="display:none" class="col-lg-6">
                                                <label><?= translate("dae_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" name="dae" id="dae" placeholder="<?= translate('dae_lang'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div><input type="button" name="previous" class="previous action-button-previous btn btn-warning" value="<?= translate('previous_lang') ?>" /> <input type="button" name="next" class="next action-button btn btn-info" value="<?= translate('next_lang') ?>" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="text-center"> <input onclick="addVarieties(false)" type="button" class="btn btn-success" value="<?= translate('add_producto_lang') ?>" /> </h2>
                                        <br>
                                        <div class="table-responsive" id="tableVarieties">
                                            <div class="alert alert-info">Se encuentra vacio</div>
                                        </div>

                                    </div> <input id="btnPrevius" type="button" name="previous" class="previous action-button-previous btn btn-warning" value="<?= translate('previous_lang') ?>" />
                                    <button type="button" name="make_payment" class="next action-button btn btn-info">
                                        <div style="display:none;    width: 17px;height: 17px;" id="spinnerFinalize" class="spinner-border text-white mr-2 align-self-center loader-sm "></div>
                                        <span id="spanFinalize"><?= translate('finalize_lang') ?></span>
                                    </button>
                                    <!--                                     <input type="button" name="make_payment" class="next action-button btn btn-info" value="<?= translate('finalize_lang') ?>" /> -->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
</div><!-- /.content-wrapper -->
<div class="modal fadeInDown" id="modalAddVarieties" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_producto_lang') ?> <span>
                        <button onclick="loadItems()" type="button" class="btn btn-outline-dark mb-2 position-relative mt-3 mb-3 ml-2">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg> Items</span>
                            <span class="badge badge-danger counter">0</span>
                        </button>
                    </span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label><?= translate("type_box_lang"); ?></label>
                        <div class="input-group">
                            <select id="typeBox" name="typeBox" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($boxs_type) { ?>
                                    <?php foreach ($boxs_type as $item) { ?>
                                        <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->box_id ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("box_number_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="1" id="boxNumber" pattern="^[1-9]+" class="form-control input-sm" placeholder="<?= translate('box_number_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("categorias_lang"); ?></label>
                        <div class="input-group">
                            <select id="categories" name="categories" class="form-control input-sm" onchange="selectedCategories()" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($categories) { ?>
                                    <?php foreach ($categories as $item) { ?>
                                        <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->category_id ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("productos_lang"); ?></label>
                        <div class="input-group">
                            <select id="product" disabled name="product" class="form-control input-sm" onchange="selectedProduct()" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("measure_lang"); ?></label>
                        <div class="input-group">
                            <select id="measures" name="measures" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($measures) { ?>
                                    <?php foreach ($measures as $item) { ?>
                                        <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->measure_id ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("stems_bunch_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="0" id="stems" pattern="^[1-9]+" class="form-control input-sm" placeholder="<?= translate('stems_bunch_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("bunches_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="1" id="bunches" pattern="^[1-9]+" class="form-control input-sm" placeholder="<?= translate('bunches_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label><?= translate("price2_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" step="any" id="price" class="form-control input-sm" placeholder="<?= translate('price2_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <br>
                                <label><?= translate("total_stm_lang"); ?>: <span id="totalStm">0</span></label>
                                <br>
                                <label><?= translate("total_lang"); ?>: <span id="total">0</span></label>
                            </div>
                            <div class="col-lg-6 text-right">
                                <br>
                                <input id="indiceTempObj" style="display:none">
                                <button id="btnAddVarietyBox" onclick="addVarietyBox()" class="btn btn-primary"><?= translate('add_producto_lang') ?></button>
                                <button id="btnCancelEdit" style="display:none" onclick="cancelUpdateItem()" class="btn btn-default"><?= translate('cancel_lang') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button id="btnModalVarieties" onclick="addVarietiesInvoice()" class="btn btn-success"><?= translate('end_boxlang') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fadeInDown" id="modalItems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Items</h5>
            </div>
            <div class="modal-body" id="bodyModalItems">

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.min.js"></script>

<script>
    let textEditItem = '<?= translate('update_item_lang') ?>';
    let textAddItem = '<?= translate('add_producto_lang') ?>';

    const calcularDate = () => {
        let dateToday = new Date();
        dateToday.setDate(dateToday.getDate() - 1);
        return dateToday.getFullYear() + '-' + (dateToday.getMonth() + 1) + '-' + dateToday.getDate();
    }

    $(document).ready(function() {

        $("#selectFarms").select2({
            tags: true,
            /*   dropdownParent: $("#modalAddManagers"), */
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });

        $("#markings").select2({
            tags: true,
            /*   dropdownParent: $("#modalAddManagers"), */
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });

        $("#categories").select2({
            tags: true,
            dropdownParent: $("#modalAddVarieties"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });

        $("#measures").select2({
            tags: true,
            dropdownParent: $("#modalAddVarieties"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });

        $("#typeBox").select2({
            tags: true,
            dropdownParent: $("#modalAddVarieties"),
            placeholder: '<?= translate('select_opction_lang') ?>',
            allowClear: false,
        });

        let ipServer = '<?= $request_server ?>';
        let dateRu = 'today';
        if (ipServer == 'RU') {
            dateRu = calcularDate();
        }
        let dateDispatch = flatpickr(document.getElementById('dispatchDay'), {
            defaultDate: dateRu
        });

        let current_fs, next_fs, previous_fs; //fieldsets
        let opacity;

        $(".next").click(function() {
            let validNext = false;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            if ($("fieldset").index(current_fs) == 0) {
                validNext = false;
                let farms = $('select[name=farms] option').filter(':selected').val();
                let markings = $('select[name=markings] option').filter(':selected').val();
                if (farms == 0) {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'error',
                        title: `Seleccione la finca`,
                        padding: '3em',
                    })
                } else if (markings == 0) {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'error',
                        title: `Seleccione la marcación`,
                        padding: '3em',
                    })
                } else {
                    validNext = true;
                }
            } else if ($("fieldset").index(current_fs) == 1) {
                validNext = false;
                // let date = $('#date').val().trim();
                //  let country = $('select[name=country] option').filter(':selected').val();
                //   let to = $('#to').val().trim();
                //  let address = $('#address').val().trim();
                //  let customer = $('#customer').val().trim();
                //  let airline = $('#airline').val().trim();
                // let shippementDate = $('#shippementDate').val().trim();
                // let dueDate = $('#dueDate').val().trim();
                let awb = $('#awb').val().trim();
                // let hawb = $('#hawb').val().trim();
                //  let freighForward = $('#freighForward').val().trim();
                // let packingList = $('#packingList').val().trim();
                // let dae = $('#dae').val().trim();
                let invoceNumber = $('#invoceNumber').val().trim();
                let dispatchDay = $('#dispatchDay').val().trim();
                if (invoceNumber == "") {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'error',
                        title: `El campo <?= translate('invoice_number_lang'); ?> es requerido`,
                        padding: '3em',
                    })
                } else if (dispatchDay == "") {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        padding: '2em'
                    });
                    toast({
                        type: 'error',
                        title: `El campo <?= translate('dispatch_day_lang'); ?> es requerido`,
                        padding: '3em',
                    })
                }
                /*  else if (awb == "") {
                                    const toast = swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        padding: '2em'
                                    });
                                    toast({
                                        type: 'error',
                                        title: `El campo <?= translate('awb_lang'); ?> es requerido`,
                                        padding: '3em',
                                    })
                                } */
                else {
                    validNext = true;
                }

            } else if ($("fieldset").index(current_fs) == 2) {
                validNext = false;
                if (arrayRequest.varieties.length > 0) {
                    $('#spinnerFinalize').show();
                    $('#spanFinalize').text('Creando invoice...');
                    $('#btnPrevius').prop('disabled', true);
                    //crear invoice
                    let farms = $('select[name=farms] option').filter(':selected').val();
                    let markings = $('select[name=markings] option').filter(':selected').attr('itemId');
                    //let client = $('select[name=clients] option').filter(':selected').val();
                    //client = JSON.parse(decodeB64Utf8(client));
                    markings = JSON.parse(decodeB64Utf8(markings));
                    farms = JSON.parse(decodeB64Utf8(farms));
                    delete farms.personal;
                    let awb = $('#awb').val().trim();
                    let invoceNumber = $('#invoceNumber').val().trim();
                    let dispatchDay = $('#dispatchDay').val().trim();
                    arrayRequest = JSON.stringify(arrayRequest.varieties);
                    let data = {
                        farms,
                        dispatchDay,
                        invoceNumber,
                        awb,
                        arrayRequest,
                        markings
                    }
                    setTimeout(function() {
                        $.ajax({
                            type: 'POST',
                            url: "<?= site_url('invoice_farm/add') ?>",
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
                                        $('#btnPrevius').prop('disabled', false);
                                        $('#spinnerFinalize').hide();
                                        $('#spanFinalize').text('<?= translate('finalize_lang') ?>');
                                        window.location = '<?= site_url('invoice_farm/index') ?>';
                                    }, 1000);
                                } else {
                                    swal({
                                        title: '¡Error!',
                                        text: result.msj,
                                        padding: '2em'
                                    });
                                    $('#btnPrevius').prop('disabled', false);
                                    $('#spinnerFinalize').hide();
                                    $('#spanFinalize').text('<?= translate('finalize_lang') ?>');
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
                        type: 'error',
                        title: 'No tiene variedades agregadas',
                        padding: '3em',
                    })
                }
            }
            if (validNext) {
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            }

        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });
    });

    let arrayRequest = [];
    arrayRequest.varieties = []

    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    const addVarieties = (object) => {

        if (!object) {
            $('#btnModalVarieties').attr('onclick', 'addVarietiesInvoice()');
            $('#btnModalVarieties').text('<?= translate('end_boxlang') ?>');
            $('#product').prop('disabled', true);
            $('#product').empty();
            $('[name=categories]').val('0');
            $('[name=measures]').val('0');
            $('[name=typeBox]').val('0');
            $('#bouquets').val('1');
            $('#price').val('');
            $('#boxNumber').val('1');
            $('#stems').val('1');
        } else {
            object = JSON.parse(decodeB64Utf8(object));
            $('#btnModalVarieties').attr('onclick', 'updateVarietiesInvoice("' + object.indice + '")');
            $('#btnModalVarieties').text('<?= translate('edit_producto_lang') ?>');
            $('#product').prop('disabled', true);
            $('#product').empty();
            $('select[name=categories]').val(object.categorie);
            $.ajax({
                type: 'POST',
                url: "<?= site_url('invoice_farm/search_products') ?>",
                data: {
                    categorie: object.categorie
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        if (result.products.length > 0) {
                            let cadenaProducts = ' <option value="0"><?= translate('select_opction_lang') ?></option>';
                            result.products.forEach(item => {
                                if (object.products.product_id == item.product_id) {
                                    cadenaProducts += '<option selected itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>'
                                } else {
                                    cadenaProducts += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>'
                                }

                            });
                            $('#product').append(cadenaProducts);
                            $('#product').prop('disabled', false);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: 'La categoria se encuentra sin productos',
                                padding: '2em'
                            });
                        }
                    } else {
                        swal({
                            title: '¡Error!',
                            text: result.msj,
                            padding: '2em'
                        });
                        $('#spinnerFinalize').hide();
                        $('#spanFinalize').text('<?= translate('finalize_lang') ?>');
                    }

                }
            });
            $('[name=measures]').val(object.measures.measure_id);
            $('[name=typeBox]').val(object.typeBoxs.box_id);
            $('#bouquets').val(object.bouquets);
            $('#price').val(object.price);
            $('#boxNumber').val(object.boxNumber);
            $('#stems').val(object.stems);
        }
        $('#modalAddVarieties').modal({
            backdrop: false
        })
    }

    const selectedCategories = () => {
        $('#product').prop('disabled', true);
        $('#product').empty();
        let categorie = $('select[name=categories] option').filter(':selected').val();
        if (categorie != 0) {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('invoice_farm/search_products') ?>",
                data: {
                    categorie
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        if (result.products.length > 0) {
                            let cadenaProducts = ' <option itemId="0" value="0"><?= translate('select_opction_lang') ?></option>';
                            result.products.forEach(item => {
                                cadenaProducts += '<option itemId="' + encodeB64Utf8(JSON.stringify(item)) + '" value="' + item.product_id + '">' + item.name + '</option>'
                            });
                            $('#product').append(cadenaProducts);
                            $('#product').prop('disabled', false);
                        } else {
                            swal({
                                title: '¡Error!',
                                text: 'La categoria se encuentra sin productos',
                                padding: '2em'
                            });
                        }
                        $("#product").select2({
                            tags: true,
                            dropdownParent: $("#modalAddVarieties"),
                            placeholder: '<?= translate('select_opction_lang') ?>',
                            allowClear: false,
                        });
                    } else {
                        swal({
                            title: '¡Error!',
                            text: result.msj,
                            padding: '2em'
                        });
                        $('#spinnerFinalize').hide();
                        $('#spanFinalize').text('<?= translate('finalize_lang') ?>');
                    }

                }
            });
        }

    }

    const selectedProduct = () => {
        let products = $('select[name=product] option').filter(':selected').attr('itemId');
        if (products != 0) {
            products = JSON.parse(decodeB64Utf8(products));
            if (typeof products.categoria.type_box !== 'undefined') {
                $('#typeBox').val(products.categoria.type_box.box_id);
            }
            let bouquets = $('#bouquets').val();
            let price = $('#price').val();
            $('#stems').val(products.stems_bunch);
            let stems = $('#stems').val();
            if (bouquets > 0 && price > 0 && stems > 0) {
                let totalTSM = parseInt(bouquets) * parseInt(stems);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice.toFixed(2));
            } else if (bouquets > 0 && stems > 0) {
                let totalTSM = parseInt(bouquets) * parseInt(stems);
                $('#totalStm').text(totalTSM);
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
        }
    }

    $('#stems').change(() => {
        let stems = $('#stems').val().trim();
        if (stems > 0) {
            let bunches = $('#bunches').val().trim();
            let price = $('#price').val().trim();
            let boxNumber = $('#boxNumber').val().trim();
            if (bunches > 0 && price > 0 && boxNumber > 0) {
                let totalTSM = parseInt(bunches) * parseInt(stems) * parseInt(boxNumber);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice.toFixed(2));
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo stems no puede ser 0',
                padding: '2em',
            })
        }
    })

    $('#price').change(() => {
        let price = $('#price').val().trim();
        if (price > 0) {
            let bunches = $('#bunches').val().trim();
            let stems = $('#stems').val().trim();
            let boxNumber = $('#boxNumber').val().trim();
            if (bunches > 0 && stems > 0 && boxNumber > 0) {
                let totalTSM = parseInt(bunches) * parseInt(stems) * parseInt(boxNumber);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice.toFixed(2));
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El precio no puede ser 0',
                padding: '2em',
            })
        }
    })

    $('#bunches').change(() => {
        let bunches = $('#bunches').val().trim();
        if (bunches > 0) {
            let price = $('#price').val().trim();
            let stems = $('#stems').val().trim();
            let boxNumber = $('#boxNumber').val().trim();
            if (price > 0 && stems > 0 && boxNumber > 0) {
                let totalTSM = parseInt(bunches) * parseInt(stems) * parseInt(boxNumber);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice.toFixed(2));
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'La cantidad de cajas no puede ser 0',
                padding: '3em',
            })
        }
    })

    $('#boxNumber').change(() => {
        let boxNumber = $('#boxNumber').val().trim();
        if (boxNumber > 0) {
            let price = $('#price').val().trim();
            let stems = $('#stems').val().trim();
            let bunches = $('#bunches').val().trim();
            if (price > 0 && stems > 0 && boxNumber > 0) {
                let totalTSM = parseInt(bouquets) * parseInt(stems) * parseInt(boxNumber);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice.toFixed(2));
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'La cantidad de cajas no puede ser 0',
                padding: '3em',
            })
        }
    })

    let tempObject = null;

    const addVarietyBox = () => {
        let products = $('select[name=product] option').filter(':selected').attr('itemId');
        let typeBoxs = $('select[name=typeBox] option').filter(':selected').attr('itemId');
        let measures = $('select[name=measures] option').filter(':selected').attr('itemId');
        let categorie = $('select[name=categories] option').filter(':selected').val();
        let bunches = $('#bunches').val().trim();
        let price = $('#price').val().trim();
        let stems = $('#stems').val().trim();
        let boxNumber = $('#boxNumber').val().trim();
        if (products == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una variedad',
                padding: '3em',
            })
        } else if (measures == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una medida',
                padding: '3em',
            })
        } else if (typeBoxs == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un Type box',
                padding: '3em',
            })
        } else if (stems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo stems no puede ser 0',
                padding: '3em',
            })
        } else if (boxNumber <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo Nro de cajas no puede ser 0',
                padding: '3em',
            })
        } else if (bunches <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo bunches no puede ser 0',
                padding: '3em',
            })
        } else if (price <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo precio no puede ser 0',
                padding: '3em',
            })
        } else {
            products = JSON.parse(decodeB64Utf8(products));
            typeBoxs = JSON.parse(decodeB64Utf8(typeBoxs));
            measures = JSON.parse(decodeB64Utf8(measures));
            let objTemp = {
                products,
                measures,
                price,
                bunches,
                stems,
                categorie
            };
            addTempObject(typeBoxs, boxNumber, objTemp)
        }
    }

    const addTempObject = (typeBoxs, boxNumber, object) => {
        if (!tempObject) {
            tempObject = {
                typeBoxs,
                boxNumber
            };
            tempObject.varieties = []
            tempObject.varieties.push(object);
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'success',
                title: 'Variedad agregada correctamente',
                padding: '3em',
            })

            $('.counter').text(tempObject.varieties.length);
        } else {
            tempObject.typeBoxs = typeBoxs;
            tempObject.boxNumber = boxNumber;
            let result = tempObject.varieties.filter(item => {
                return item.products.product_id === object.products.product_id && item.measures.measure_id === object.measures.measure_id
            });
            if (result.length == 0) {
                tempObject.varieties.push(object);
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '3em'
                });
                toast({
                    type: 'success',
                    title: 'Variedad agregada correctamente',
                    padding: '3em',
                })
            } else {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '3em'
                });
                toast({
                    type: 'error',
                    title: 'Ya se encuentra una variedad agregada con esas especificaciones',
                    padding: '3em',
                })
            }
            $('.counter').text(tempObject.varieties.length);
        }
        cancelAddItem();
    }

    const addVarietiesInvoice = () => {
        let products = $('select[name=product] option').filter(':selected').attr('itemId');
        let typeBoxs = $('select[name=typeBox] option').filter(':selected').attr('itemId');
        let measures = $('select[name=measures] option').filter(':selected').attr('itemId');
        let categorie = $('select[name=categories] option').filter(':selected').val();
        let bunches = $('#bunches').val().trim();
        let price = $('#price').val().trim();
        let stems = $('#stems').val().trim();
        let boxNumber = $('#boxNumber').val().trim();
        if (products == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una variedad',
                padding: '3em',
            })
        } else if (measures == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una medida',
                padding: '3em',
            })
        } else if (typeBoxs == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un Type box',
                padding: '3em',
            })
        } else if (stems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo stems no puede ser 0',
                padding: '3em',
            })
        } else if (boxNumber <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo Nro de cajas no puede ser 0',
                padding: '3em',
            })
        } else if (bunches <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo bunches no puede ser 0',
                padding: '3em',
            })
        } else if (price <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo precio no puede ser 0',
                padding: '3em',
            })
        } else {
            products = JSON.parse(decodeB64Utf8(products));
            typeBoxs = JSON.parse(decodeB64Utf8(typeBoxs));
            measures = JSON.parse(decodeB64Utf8(measures));
            let object = {
                products,
                typeBoxs,
                measures,
                price,
                boxNumber,
                bouquets,
                stems,
                categorie
            };
            addArrayRequest(object);
            $('#modalAddVarieties').modal('hide');
            setTimeout(() => {
                cargarDetails();
            }, 2000);
            swal({
                title: '¡Perfecto!',
                text: "Variedad agregada correctamente",
                type: 'success',
                timer: 2000,
                showConfirmButton: false,
                padding: '2em'
            })
        }
    }

    const cargarDetails = () => {
        $('#tableVarieties').empty();
        let qtyBox = 0;
        let qtyStems = 0;
        let qtyBouquets = 0;
        let acumTotalStm = 0;
        let acumPrice = 0;
        let acumTotal = 0;
        if (arrayRequest.varieties.length > 0) {
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
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';
            texto_tabla += '<tbody>';
            arrayRequest.varieties.forEach((item, indice, array) => {
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

                texto_tabla += '<td>';

                texto_tabla += '<div class="btn-group mb-4 mr-2" role="group">';
                texto_tabla += '<button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">';
                texto_tabla += '<polyline points="6 9 12 15 18 9"></polyline>';
                texto_tabla += '</svg>';
                texto_tabla += '</button>';
                texto_tabla += '<div class="dropdown-menu" aria-labelledby="btnOutline" style="will-change: transform;">';
                texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=addVarieties("' + encodeB64Utf8(JSON.stringify(item)) + '");> Editar</a>';
                texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=deleteVarieties("' + indice + '");> Eliminar</a>';
                texto_tabla += '</div>';
                texto_tabla += '</div>';
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

            texto_tabla += '<td>';
            texto_tabla += '</td>';

            texto_tabla += '</tr>';
            texto_tabla += '</tfoot>'
            texto_tabla += '</table>'
            $("#tableVarieties").html(texto_tabla);
            $("#datatablesVarieties").DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        } else {
            $('#tableVarieties').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }

    }

    const addArrayRequest = (object) => {
        let encontrado = false;
        if (arrayRequest.varieties.length > 0) {
            arrayRequest.varieties.forEach((item, indice, array) => {
                if (item.products.product_id == object.products.product_id && item.typeBoxs.box_id == object.typeBoxs.box_id && item.measures.measure_id == object.measures.measure_id && item.precio == object.precio && item.bx == object.bx && item.stems == object.stems) {
                    item.bncBox = parseInt(item.bncBox) + parseInt(object.bncBox);
                    encontrado = true;
                }
            });
            if (!encontrado) {
                arrayRequest.varieties.push(object);
            }
        } else {
            arrayRequest.varieties.push(object);
        }
    }

    const updateVarietiesInvoice = (indice) => {
        let products = $('select[name=product] option').filter(':selected').attr('itemId');
        let typeBoxs = $('select[name=typeBox] option').filter(':selected').attr('itemId');
        let measures = $('select[name=measures] option').filter(':selected').attr('itemId');
        let categorie = $('select[name=categories] option').filter(':selected').val();
        let bouquets = $('#bouquets').val().trim();
        let price = $('#price').val().trim();
        let stems = $('#stems').val().trim();
        let boxNumber = $('#boxNumber').val().trim();
        if (products == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una variedad',
                padding: '3em',
            })
        } else if (measures == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una medida',
                padding: '3em',
            })
        } else if (typeBoxs == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un Type box',
                padding: '3em',
            })
        } else if (stems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo stems no puede ser 0',
                padding: '3em',
            })
        } else if (boxNumber <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo Nro de cajas no puede ser 0',
                padding: '3em',
            })
        } else if (bouquets <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo bouquets no puede ser 0',
                padding: '3em',
            })
        } else if (price <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo precio no puede ser 0',
                padding: '3em',
            })
        } else {
            products = JSON.parse(decodeB64Utf8(products));
            typeBoxs = JSON.parse(decodeB64Utf8(typeBoxs));
            measures = JSON.parse(decodeB64Utf8(measures));
            let object = {
                products,
                typeBoxs,
                measures,
                price,
                boxNumber,
                bouquets,
                stems,
                categorie
            };
            updateArrayRequest(object, indice);
            $('#modalAddVarieties').modal('hide');
            setTimeout(() => {
                cargarDetails();
            }, 2000);
            swal({
                title: '¡Perfecto!',
                text: "Variedad agregada correctamente",
                type: 'success',
                timer: 2000,
                showConfirmButton: false,
                padding: '2em'
            })
        }
    }

    const updateArrayRequest = (object, indice) => {
        arrayRequest.varieties[indice] = object;

    }

    const deleteVarieties = (indice) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                arrayRequest.varieties.splice(indice, 1);
                cargarDetails();
            }
        })
    }

    const loadItems = () => {
        $('#bodyModalItems').empty();
        let acumTotal = 0;
        if (tempObject) {
            let textTypoBox = '<?= translate("type_box_lang") ?> :';
            let textNumberBox = '<?= translate("box_number_lang") ?> :';
            let texto_tabla = '<p>' + textTypoBox + tempObject.typeBoxs.name + '</p>';
            texto_tabla += '<p>' + textNumberBox + tempObject.boxNumber + '</p>';
            if (tempObject.varieties.length > 0) {
                texto_tabla += '<table id="datatablesItems" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
                texto_tabla += '<thead>';
                texto_tabla += '<tr>';
                texto_tabla += '<th>VARIETIES</th>';
                texto_tabla += '<th>CM</th>';
                texto_tabla += '<th>STEMS</th>';
                texto_tabla += '<th>BUNCHES</th>';
                texto_tabla += '<th>TOTAL STM</th>';
                texto_tabla += '<th>PRICE</th>';
                texto_tabla += '<th>TOTAL</th>';
                texto_tabla += '<th>Acciones</th>';
                texto_tabla += '</tr>';
                texto_tabla += '</thead>';
                texto_tabla += '<tbody>';
                tempObject.varieties.forEach((item, indice, array) => {
                    item.indice = indice;
                    texto_tabla += '<tr>';

                    texto_tabla += '<td>';
                    texto_tabla += item.products.name;
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    texto_tabla += item.measures.name;
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    texto_tabla += item.stems;
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    texto_tabla += item.bunches;
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    texto_tabla += parseInt(item.stems) * parseInt(item.bunches);
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    texto_tabla += parseFloat(item.price).toFixed(2);
                    texto_tabla += '</td>';

                    texto_tabla += '<td>';
                    let totalTable = parseFloat(item.price) * (parseInt(item.stems) * parseInt(item.bunches));
                    acumTotal += totalTable;
                    texto_tabla += totalTable.toFixed(2);
                    texto_tabla += '</td>';
                    texto_tabla += '<td>';
                    texto_tabla += '<button class="btn btn-info mb-2 mr-2 rounded-circle" onclick=editItemBox("' + encodeB64Utf8(JSON.stringify(item)) + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>';
                    texto_tabla += '<button class="btn btn-danger mb-2 mr-2 rounded-circle" onclick=deleteItemBox("' + indice + '")><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
                    texto_tabla += '</td>';
                    texto_tabla += '</tr>';
                });
                texto_tabla += '</tbody>';
                texto_tabla += '</table>'
                $("#bodyModalItems").html(texto_tabla);
                $("#datatablesItems").DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    }
                });
            } else {
                $('#bodyModalItems').append('<div class="alert alert-info">Se encuentra vacio</div>');
            }
        } else {
            $('#bodyModalItems').append('<div class="alert alert-info">Se encuentra vacio</div>');
        }
        $('#modalItems').modal('show');
    }

    const editItemBox = (obj) => {
        obj = decodeB64Utf8(obj);
        obj = JSON.parse(obj);
        console.log(obj);
        /*       $('#categories').val(obj.categorie);
              $('#categories').trigger('change');
              $('#product').val(obj.products.product_id);
              $('#product').trigger('change');
              $('#product').prop('disabled', false);
              $('#measures').val(obj.measures.measure_id);
              $('#measures').trigger('change');
              $('#bunches').val(obj.bunches);
              $('#price').val(obj.price);
              $('#stems').val(obj.stems);
              $('#boxNumber').val(tempObject.boxNumber);
              $('#typeBox').val(tempObject.typeBoxs.box_id);
              $('#btnAddVarietyBox').attr('onclick', 'updateItemBox()')
              $('#btnAddVarietyBox').text(textEditItem);
              $('#indiceTempObj').val(obj.indice);
              let totalTSM = parseInt(obj.bunches) * parseInt(obj.stems) * parseInt(obj.boxNumber);
              let totalPrice = totalTSM * parseFloat(obj.price);
              $('#totalStm').text(totalTSM);
              $('#total').text(totalPrice.toFixed(2));
              $('#modalItems').modal('hide');
              $('#modalAddVarieties').modal('show');
              $('#btnCancelEdit').show(); */
    }

    const deleteItemBox = (indice) => {
        swal({
            title: '¿ Estás seguro de realizar esta operación ?',
            text: "Usted no podrá revertir este cambio !!!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                tempObject.varieties.splice(indice, 1);
                loadItems();
                $('.counter').text(tempObject.varieties.length);
                if (tempObject.varieties.length == 0) {
                    tempObject = null;
                }
            }
        })
    }

    const updateItemBox = () => {
        let products = $('select[name=product] option').filter(':selected').attr('itemId');
        let typeBoxs = $('select[name=typeBox] option').filter(':selected').attr('itemId');
        let measures = $('select[name=measures] option').filter(':selected').attr('itemId');
        let categorie = $('select[name=categories] option').filter(':selected').val();
        let bunches = $('#bunches').val().trim();
        let price = $('#price').val().trim();
        let stems = $('#stems').val().trim();
        let boxNumber = $('#boxNumber').val().trim();
        let indice = $('#indiceTempObj').val();
        if (products == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una variedad',
                padding: '3em',
            })
        } else if (measures == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'Seleccione una medida',
                padding: '3em',
            })
        } else if (typeBoxs == 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '3em'
            });
            toast({
                type: 'error',
                title: 'Seleccione un Type box',
                padding: '3em',
            })
        } else if (stems <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo stems no puede ser 0',
                padding: '3em',
            })
        } else if (boxNumber <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo Nro de cajas no puede ser 0',
                padding: '3em',
            })
        } else if (bunches <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo bunches no puede ser 0',
                padding: '3em',
            })
        } else if (price <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo precio no puede ser 0',
                padding: '3em',
            })
        } else {
            products = JSON.parse(decodeB64Utf8(products));
            typeBoxs = JSON.parse(decodeB64Utf8(typeBoxs));
            measures = JSON.parse(decodeB64Utf8(measures));
            let objTemp = {
                products,
                measures,
                price,
                bunches,
                stems,
                categorie
            };
            updateTempObject(typeBoxs, boxNumber, objTemp, indice)
        }

    }

    const updateTempObject = (typeBoxs, boxNumber, objTemp, indice) => {
        tempObject.varieties[indice].products = objTemp.products;
        tempObject.varieties[indice].measures = objTemp.measures;
        tempObject.varieties[indice].categorie = objTemp.categorie;
        tempObject.varieties[indice].price = objTemp.price;
        tempObject.varieties[indice].bunches = objTemp.bunches;
        tempObject.varieties[indice].stems = objTemp.stems;
        tempObject.typeBoxs = typeBoxs;
        tempObject.boxNumber = boxNumber;
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            padding: '3em'
        });
        toast({
            type: 'success',
            title: 'Variedad actualizada correctamente',
            padding: '3em',
        })
        loadItems();
        cancelUpdateItem();
    }

    const cancelUpdateItem = () => {
        $('#categories').val(0);
        $('#categories').trigger('change');
        $('#product').val(0);
        $('#product').trigger('change');
        $('#product').prop('disabled', true);
        $('#measures').val(0);
        $('#measures').trigger('change');
        $('#bunches').val('');
        $('#price').val('');
        $('#stems').val('');
        $('#btnAddVarietyBox').attr('onclick', 'addVarietyBox()')
        $('#btnAddVarietyBox').text(textAddItem);
        $('#indiceTempObj').val('');
        $('#totalStm').text(0);
        $('#total').text(0);
        $('#btnCancelEdit').hide();
    }

    const cancelAddItem = () => {
        $('#bunches').val('');
        $('#price').val('');
        $('#stems').val('');
        $('#measures').val(0);
        $('#measures').trigger('change');
        $('#btnAddVarietyBox').attr('onclick', 'addVarietyBox()')
        $('#btnAddVarietyBox').text(textAddItem);
        $('#indiceTempObj').val('');
        $('#totalStm').text(0);
        $('#total').text(0);
        $('#btnCancelEdit').hide();
    }
</script>