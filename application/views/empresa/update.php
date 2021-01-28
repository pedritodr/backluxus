<div class="main-container" id="container">

    <div class="layout-px-spacing">
        <h3>
            Gestionar empresa
            <!--  <small class="titulo-2"><?= translate('add_tienda_lang'); ?></small> | <a href="<?= site_url('tienda/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a> -->
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple">Editar empresa</h6>
                </div>
                <div class="widget-content widget-content-area">

                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("empresa/update"); ?>
                    <input type="hidden" name="empresa_id" value="<?= $empresa_object->company_id; ?>" />
                    <div class="row">
                        <div class="col-lg-6">
                            <label><?= translate("nombre_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input type="text" class="form-control input-sm" name="nombre" required value="<?= $empresa_object->name; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("phone_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-sm" name="telef" value="<?= $empresa_object->phone; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("email_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                <input type="email" class="form-control input-sm" name="email" value="<?= $empresa_object->email; ?>">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <label><?= translate("direccion_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-sm" name="direccion" value="<?= $empresa_object->address; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label><?= "URL video"; ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-play"></i></span>
                                <input type="text" class="form-control input-sm" name="url_video" value="<?= $empresa_object->video_url; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label><?= "Whatsapp"; ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-whatsapp" aria-hidden="true"></i></i></span>
                                <?php if (isset($empresa_object->whatsapp)) { ?>
                                    <input type="text" class="form-control input-sm" name="whatsapp" value="<?= $empresa_object->whatsapp; ?>">
                                <?php } else { ?>
                                    <input type="text" class="form-control input-sm" name="whatsapp" value="">
                                <?php   } ?>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Sobre nosotros</label>
                                <div id="editor-container1" class="form-control"><?= $empresa_object->about ?></div>
                                <textarea style="display:none" name="desc" id="desc" cols="30" rows="10"></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label"><?= translate('vision_lang'); ?></label>
                                <div id="editor-container2" class="form-control"><?= $empresa_object->vision ?></div>
                                <textarea style="display:none" name="vision" id="vision" cols="30" rows="10"></textarea>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label"><?= translate('mision_lang'); ?></label>
                                <div id="editor-container3" class="form-control"><?= $empresa_object->mision ?></div>
                                <textarea style="display:none" name="mision" id="mision" cols="30" rows="10"></textarea>
                                <br>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label><?= translate("facebook_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-facebook-f"></i></span>
                                <input type="url" class="form-control input-sm" name="face" value="<?= $empresa_object->facebook; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= "Instagram"; ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                <input type="url" class="form-control input-sm" name="instagram" value="<?= $empresa_object->instagram; ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate("youtube_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
                                <input type="url" class="form-control input-sm" name="you" value="<?= $empresa_object->youtube; ?>">
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12" style="text-align: right;margin-top:4%">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                    </div>

                    <?= form_close(); ?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.content-wrapper -->
<script>
    let quill;
    let quill2;
    let quill3;
    $(()=> {
        quill = new Quill('#editor-container1', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Escribe aqui la sobre nosotros...',
            theme: 'snow' // or 'bubble'
        });
        quill2 = new Quill('#editor-container2', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Escribe aqui la visión...',
            theme: 'snow' // or 'bubble'
        });
        quill3 = new Quill('#editor-container3', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Escribe aqui la misión...',
            theme: 'snow' // or 'bubble'
        });
    });
    var form = document.querySelector('form');
    form.onsubmit = function() {
        var contenido = $('#editor-container1').text();
        var contenido2 = $('#editor-container2').text();
        var contenido3 = $('#editor-container3').text();
        $('#desc').html(contenido);
        $('#mision').html(contenido3);
        $('#vision').html(contenido2);
    }
</script>