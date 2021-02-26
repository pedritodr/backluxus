<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_farms_lang') ?> | <a href="<?= site_url('farm/index_provider'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('add_farm_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/add_provider"); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <label><?= translate("name_commercial_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="name_commercial" name="name_commercial" required placeholder="<?= translate('name_commercial_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("name_legal_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="name_legal" name="name_legal" placeholder="<?= translate('name_legal_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_farm_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="address_farm" name="address_farm" placeholder="<?= translate('address_farm_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_oficce_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="address_office" name="address_office" placeholder="<?= translate('address_oficce_lang'); ?>">
                            </div>
                        </div>
                        <!--       <div class="col-lg-3">
                            <label><?= translate("owner_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="owner" name="owner" required placeholder="<?= translate('owner_lang'); ?>">
                            </div>
                        </div> -->
                        <div class="col-lg-3">
                            <label><?= translate("citys_lang"); ?></label>
                            <div class="input-group">
                                <select id="citys" name="citys" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('select_opction_lang') ?></option>
                                    <?php if (isset($citys)) { ?>
                                        <?php if ($citys) { ?>
                                            <?php foreach ($citys as $item) { ?>
                                                <option value="<?= $item->city_id ?>"><?= $item->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("days_credit_lang"); ?></label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control input-sm" id="days" name="days" placeholder="<?= translate('days_credit_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("hectare_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="hectare" name="hectare" placeholder="<?= translate('hectare_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("farms_lang"); ?></label>
                            <div class="input-group">
                                <select id="farmsId" name="farms" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('not_group_lang') ?></option>
                                    <?php if (isset($farms)) { ?>
                                        <?php if ($farms) { ?>
                                            <?php foreach ($farms as $item) { ?>
                                                <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->farm_id ?>"><?= $item->name_legal . ' - ' . $item->name_commercial ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label"><?= translate('observations_lang') ?></label>
                                <div id="editor-container1" class="form-control"></div>
                                <textarea style="display:none" name="desc" id="desc" cols="30" rows="10"></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-12" style="text-align: right;">
                            <br>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                        </div>

                    </div>
                    <?= form_close(); ?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->
<script>
    const encodeB64Utf8 = (str) => {
        return btoa(unescape(encodeURIComponent(str)));
    }

    const decodeB64Utf8 = (str) => {
        return decodeURIComponent(escape(atob(str)));
    }

    let quill;

    $(() => {

        $("#citys").select2({
            tags: true,
            placeholder: '<?= translate('select_opction_lang') ?>',
        });

        $("#farmsId").select2({
            tags: true,
            placeholder: '<?= translate('not_group_lang') ?>',
        });

        quill = new Quill('#editor-container1', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                ]
            },
            placeholder: 'Escribe aqui la sobre nosotros...',
            theme: 'snow' // or 'bubble'
        });
    })

    let form = document.querySelector('form');

    form.onsubmit = function() {
        let contenido = $('#editor-container1').text();
        $('#desc').html(contenido);
    }

    /*     $('[name=farms]').change(() => {
            let farms = $('select[name=farms] option').filter(':selected').attr('itemId');
            if (farms != 0) {
                farms = JSON.parse(decodeB64Utf8(farms));
                $('#owner').val(farms.owner);
                $('#days').val(farms.days_credit);
                $('#hectare').val(farms.hectare);
                $('#name_legal').val();
                $('#name_commercial').val();
                $('#address_farm').val(farms.address_farm);
                $('#address_office').val(farms.address_office);
            } else {
                $('#owner').val("");
                $('#days').val("");
                $('#hectare').val("");
                $('#name_legal').val();
                $('#name_commercial').val();
                $('#address_farm').val("");
                $('#address_office').val("");
            }
        }) */
</script>