<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_farms_lang') ?> | <a href="<?= site_url('farm/index_provider'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"> <?= translate('update_provider_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("farm/update_provider"); ?>
                    <div class="row">
                        <input type="hidden" name="farm_id" value="<?= $provider_obj->farm_id ?>">
                        <div class="col-lg-3">
                            <label><?= translate("owner_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="owner" name="owner" value="<?= $provider_obj->owner ?>" required placeholder="<?= translate('owner_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("days_credit_lang"); ?></label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control input-sm" id="days" name="days" value="<?= $provider_obj->days_credit ?>" required placeholder="<?= translate('days_credit_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("hectare_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="hectare" name="hectare" value="<?= $provider_obj->hectare ?>"  required placeholder="<?= translate('hectare_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("farms_lang"); ?></label>
                            <div class="input-group">
                                <select id="farms" name="farms" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                    <option value="0"><?= translate('not_group_lang') ?></option>
                                    <?php if (isset($farms)) { ?>
                                        <?php if ($farms) { ?>
                                        <?php if($provider_obj->farm_father){?>
                                            <?php foreach ($farms as $item) { ?>
                                                <option itemId="<?= base64_encode(json_encode($item)) ?>" <?php if($provider_obj->farm_father->farm_id==$item->farm_id){?> selected <?php }?> value="<?= $item->farm_id ?>"><?= $item->name_legal . ' - ' . $item->name_commercial ?></option>
                                            <?php } ?>
                                        <?php }else {?>
                                            <?php foreach ($farms as $item) { ?>
                                                <option itemId="<?= base64_encode(json_encode($item)) ?>" value="<?= $item->farm_id ?>"><?= $item->name_legal . ' - ' . $item->name_commercial ?></option>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("name_legal_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="name_legal" name="name_legal" value="<?= $provider_obj->name_legal ?>" required placeholder="<?= translate('name_legal_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("name_commercial_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="name_commercial" name="name_commercial" value="<?= $provider_obj->name_commercial ?>" required placeholder="<?= translate('name_commercial_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_farm_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="address_farm" name="address_farm" value="<?= $provider_obj->address_farm ?>" required placeholder="<?= translate('address_farm_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("address_oficce_lang"); ?></label>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" id="address_office" name="address_office" value="<?= $provider_obj->address_office ?>" required placeholder="<?= translate('address_oficce_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label"><?= translate('observations_lang') ?></label>
                                <div id="editor-container1" class="form-control"><?= $provider_obj->observations ?></div>
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
    $('[name=farms]').change(() => {
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
            $('#editor-container1').text(farms.observations);
        }else{
            $('#owner').val("");
            $('#days').val("");
            $('#hectare').val("");
            $('#name_legal').val();
            $('#name_commercial').val();
            $('#address_farm').val("");
            $('#address_office').val("");
            $('#editor-container1').text("");

        }
    })
</script>