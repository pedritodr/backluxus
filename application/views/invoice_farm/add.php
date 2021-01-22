<link rel="stylesheet" type="text/css" href="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.css">
<link href="<?= base_url() ?>admin_template/assets/css/elements/search.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>admin_template/assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
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
                                    <li class="active" id="farm"><strong><?= translate('farms_lang') ?></strong></li>
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
                                                    <select id="farms" name="farms" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
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
                                    </div>

                                    <input type="button" name="next" class="next action-button btn btn-info" value="<?= translate('next_lang') ?>" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label><?= translate("date2_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm" id="date" name="date" placeholder="<?= translate('date2_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("to_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="to" name="to" placeholder="<?= translate('to_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label><?= translate("country_lang"); ?></label>
                                                <div class="input-group">
                                                    <select id="country" name="country" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                                        <option value="0"><?= translate('select_opction_lang') ?></option>
                                                        <?php if ($countrys) { ?>
                                                            <?php foreach ($countrys as $item) { ?>
                                                                <option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                                            <?php   } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("address2_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="address" name="address" placeholder="<?= translate('address2_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("customer_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="customer" name="customer" placeholder="<?= translate('customer_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("airline_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="airline" name="airline" placeholder="<?= translate('airline_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label><?= translate("shippement_date_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm" id="shippementDate" name="shippement_date" placeholder="<?= translate('shippement_date_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label><?= translate("due_date_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm" id="dueDate" name="due_date" placeholder="<?= translate('due_date_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("awb_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="awb" name="awb" placeholder="<?= translate('awb_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><?= translate("hawb_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="hawb" name="hawb" placeholder="<?= translate('hawb_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label><?= translate("freigh_forward_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="freighForward" name="freigh_forward" placeholder="<?= translate('freigh_forward_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <label><?= translate("packing_list_lang"); ?></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="packingList" name="packing_list" placeholder="<?= translate('packing_list_lang'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
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
                                        <h2 class="text-center"> <input onclick="addVarieties()" type="button" class="btn btn-success" value="<?= translate('add_producto_lang') ?>" /> </h2>
                                        <br>
                                        <div class="table-responsive" id="tableVarieties">
                                            <div class="alert alert-info">Se encuentra vacio</div>
                                        </div>

                                    </div> <input type="button" name="previous" class="previous action-button-previous btn btn-warning" value="<?= translate('previous_lang') ?>" />
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
<div class="modal fade" id="modalAddVarieties" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= translate('add_producto_lang') ?></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label><?= translate("productos_lang"); ?></label>
                        <div class="input-group">
                            <select id="products" name="products" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($products) { ?>
                                    <?php foreach ($products as $item) { ?>
                                        <option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("measure_lang"); ?></label>
                        <div class="input-group">
                            <select id="measures" name="measures" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($measures) { ?>
                                    <?php foreach ($measures as $item) { ?>
                                        <option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("type_box_lang"); ?></label>
                        <div class="input-group">
                            <select id="typeBox" name="typeBox" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                <option value="0"><?= translate('select_opction_lang') ?></option>
                                <?php if ($boxs_type) { ?>
                                    <?php foreach ($boxs_type as $item) { ?>
                                        <option value="<?= base64_encode(json_encode($item)) ?>"><?= $item->name ?></option>
                                    <?php   } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("stems_bunch_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="0" id="stems" pattern="^[1-9]+" class="form-control input-sm" placeholder="<?= translate('stems_bunch_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("bnc_box_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="0" id="bncBox" pattern="^[1-9]+" class="form-control input-sm" placeholder="<?= translate('bnc_box_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("price2_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" step="any" id="price" class="form-control input-sm" placeholder="<?= translate('price2_lang'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label><?= translate("bx_lang"); ?></label>
                        <div class="input-group">
                            <input type="number" min="0" pattern="^[1-9]+" id="bx" class="form-control input-sm" placeholder="<?= translate('bx_lang'); ?>" value="1">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <br>
                        <label><?= translate("total_stm_lang"); ?>: <span id="totalStm">0</span></label>
                        <br>
                        <label><?= translate("total_lang"); ?>: <span id="total">0</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> <?= translate('cerrar_lang') ?></button>
                <button onclick="addVarietiesInvoice()" class="btn btn-success"><?= translate('add_producto_lang') ?></button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>admin_template/plugins/jquery-step/jquery.steps.min.js"></script>

<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {
            let validNext = false;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            if ($("fieldset").index(current_fs) == 0) {
                validNext = false;
                let farms = $('select[name=farms] option').filter(':selected').val();
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
                        title: 'Seleccione una finca',
                        padding: '3em',
                    })
                } else {
                    validNext = true;
                }
            } else if ($("fieldset").index(current_fs) == 1) {
                validNext = true;
                let date = $('#date').val().trim();
                let country = $('select[name=country] option').filter(':selected').val();
                let to = $('#to').val().trim();
                let address = $('#address').val().trim();
                let customer = $('#customer').val().trim();
                let airline = $('#airline').val().trim();
                let shippementDate = $('#shippementDate').val().trim();
                let dueDate = $('#dueDate').val().trim();
                let awb = $('#awb').val().trim();
                let hawb = $('#hawb').val().trim();
                let freighForward = $('#freighForward').val().trim();
                let packingList = $('#packingList').val().trim();
                let dae = $('#dae').val().trim();


            } else if ($("fieldset").index(current_fs) == 2) {
                validNext = false;
                if (arrayRequest.varieties.length > 0) {
                    $('#spinnerFinalize').show();
                    $('#spanFinalize').text('Creando invoice...');
                   // validNext = true;
                    //crear invoice
                    let farms = $('select[name=farms] option').filter(':selected').val();
                    farms = JSON.parse(decodeB64Utf8(farms));
                    let date = $('#date').val().trim();
                    let country = $('select[name=country] option').filter(':selected').val();
                    country = JSON.parse(decodeB64Utf8(country));
                    let to = $('#to').val().trim();
                    let address = $('#address').val().trim();
                    let customer = $('#customer').val().trim();
                    let airline = $('#airline').val().trim();
                    let shippementDate = $('#shippementDate').val().trim();
                    let dueDate = $('#dueDate').val().trim();
                    let awb = $('#awb').val().trim();
                    let hawb = $('#hawb').val().trim();
                    let freighForward = $('#freighForward').val().trim();
                    let packingList = $('#packingList').val().trim();
                    let dae = $('#dae').val().trim();
                    arrayRequest = JSON.stringify(arrayRequest.varieties);
                    let data = {
                        farms,
                        date,
                        country,
                        to,
                        address,
                        customer,
                        airline,
                        shippementDate,
                        dueDate,
                        awb,
                        hawb,
                        freighForward,
                        packingList,
                        dae,
                        arrayRequest
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

    const addVarieties = () => {
        // $('select[name=products] option').filter(':selected').val("0");
        $('[name=products]').val('0');
        $('[name=measures]').val('0');
        $('[name=typeBox]').val('0');
        $('#bncBox').empty();
        $('#price').empty();
        $('#bx').empty();
        //  $('#modalAddVarieties').modal('show');
        $('#modalAddVarieties').modal({
            backdrop: false
        })
    }
    $('[name=products]').change(() => {
        let products = $('select[name=products] option').filter(':selected').val();
        if (products != 0) {
            products = JSON.parse(decodeB64Utf8(products));
            let bncBox = $('#bncBox').val();
            let price = $('#price').val();
            $('#stems').val(products.stems_bunch);
            let stems = $('#stems').val();
            if (bncBox > 0 && price > 0) {
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice);
            } else if (bncBox > 0) {
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                $('#totalStm').text(totalTSM);
            } else {
                $('#totalStm').text('0');
                $('#total').text('0');
            }
        } else {
            $('#totalStm').text('0');
            $('#total').text('0');
        }
    })
    $('#stems').change(() => {
        let stems = $('#stems').val().trim();
        if (stems > 0) {
            let bncBox = $('#bncBox').val().trim();
            let products = $('select[name=products] option').filter(':selected').val();
            if (bncBox > 0 && products != 0) {
                products = JSON.parse(decodeB64Utf8(products));
                let stems = $('#stems').val().trim();;
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice);
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
            let bncBox = $('#bncBox').val().trim();;
            let products = $('select[name=products] option').filter(':selected').val();
            if (bncBox > 0 && products != 0) {
                products = JSON.parse(decodeB64Utf8(products));
                let stems = $('#stems').val().trim();
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice);
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
    $('#bncBox').change(() => {
        let bncBox = $('#bncBox').val().trim();
        if (bncBox > 0) {
            let price = $('#price').val().trim();
            let products = $('select[name=products] option').filter(':selected').val();
            if (price > 0 && products != 0) {
                products = JSON.parse(decodeB64Utf8(products));
                let stems = $('#stems').val().trim();
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                let totalPrice = totalTSM * parseFloat(price);
                $('#totalStm').text(totalTSM);
                $('#total').text(totalPrice);
            } else if (products != 0) {
                products = JSON.parse(decodeB64Utf8(products));
                let stems = $('#stems').val().trim();
                let totalTSM = parseInt(bncBox) * parseInt(stems);
                $('#totalStm').text(totalTSM);
                $('#total').text('0');
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
    const addVarietiesInvoice = () => {
        let products = $('select[name=products] option').filter(':selected').val();
        let typeBoxs = $('select[name=typeBox] option').filter(':selected').val();
        let measures = $('select[name=measures] option').filter(':selected').val();
        let bncBox = $('#bncBox').val().trim();
        let price = $('#price').val().trim();
        let bx = $('#bx').val().trim();
        let stems = $('#stems').val().trim();
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
        } else if (bncBox <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo BNC|BOX no puede ser 0',
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
        } else if (bx <= 0) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });
            toast({
                type: 'error',
                title: 'El campo bx no puede estar vacio',
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
                bx,
                bncBox,
                stems
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
            console.log(arrayRequest)
        }
    }
    const cargarDetails = () => {
        $('#tableVarieties').empty();
        if (arrayRequest.varieties.length > 0) {
            let texto_tabla = '';
            texto_tabla += '<table id="datatablesVarieties" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">';
            texto_tabla += '<thead>';
            texto_tabla += '<tr>';
            texto_tabla += '<th>ORDER</th>';
            texto_tabla += '<th>BX</th>';
            texto_tabla += '<th>BOX TYPE</th>';
            texto_tabla += '<th>VARIETIES</th>';
            texto_tabla += '<th>BNC|BOX</th>';
            texto_tabla += '<th>CM</th>';
            texto_tabla += '<th>STEMS</th>';
            texto_tabla += '<th>TOTAL STM</th>';
            texto_tabla += '<th>PRICE</th>';
            texto_tabla += '<th>TOTAL</th>';
            texto_tabla += '<th>Acciones</th>';
            texto_tabla += '</tr>';
            texto_tabla += '</thead>';

            texto_tabla += '<tbody>';
            let count = 1;
            arrayRequest.varieties.forEach(item => {
                texto_tabla += '<tr>';
                texto_tabla += '<td>';
                texto_tabla += count;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.bx;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.products.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.typeBoxs.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.bncBox;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.measures.name;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.products.stems_bunch;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += parseInt(item.products.stems_bunch) * parseInt(item.bncBox);
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += item.price;
                texto_tabla += '</td>';

                texto_tabla += '<td>';
                texto_tabla += parseFloat(item.price) * (parseInt(item.products.stems_bunch) * parseInt(item.bncBox));
                texto_tabla += '</td>';

                texto_tabla += '<td>';

                texto_tabla += '<div class="btn-group mb-4 mr-2" role="group">';
                texto_tabla += '<button id="btnOutline" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciónes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">';
                texto_tabla += '<polyline points="6 9 12 15 18 9"></polyline>';
                texto_tabla += '</svg>';
                texto_tabla += '</button>';
                texto_tabla += '<div class="dropdown-menu" aria-labelledby="btnOutline" style="will-change: transform;">';
                //    texto_tabla += '<a class="dropdown-item" href="javascript:void(0);"  onclick=generarNotaCredito("' + item.pedido_mall_id + '");> Generar Nota de crédito</a>';
                texto_tabla += '</div>';
                texto_tabla += '</div>';
                texto_tabla += '</td>';
                texto_tabla += '</tr>';
                count++;
            });
            texto_tabla += '</tbody>';
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
</script>