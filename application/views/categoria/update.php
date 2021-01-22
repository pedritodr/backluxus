<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manaage_category_lang') ?> | <a href="<?= site_url('categoria/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"><?= translate('update_category_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">
                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("categoria/update"); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label><?= translate("nombre_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                        <input type="hidden" name="categoria_id" value="<?= $categoria_object->category_id; ?>" />
                                        <input type="text" class="form-control input-sm" name="name" required placeholder="<?= translate('nombre_lang'); ?>" value="<?= $categoria_object->name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("type_box_lang").' ('.translate("default_lang").')' ?> </label>
                                    <div class="input-group">
                                        <select id="typeBox" name="typeBox" class="form-control select2 input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                                            <option value="0"><?= translate('select_opction_lang') ?></option>
                                            <?php if ($boxs_type) { ?>
                                                <?php foreach ($boxs_type as $item) { ?>
                                                    <?php if(isset($categoria_object->type_box)){?>
                                                    <option value="<?= $item->box_id ?>" <?php if($categoria_object->type_box->box_id == $item->box_id){?> selected <?php } ?> ><?= $item->name ?></option>
                                                <?php }else { ?>
                                                    <option value="<?= $item->box_id ?>" ><?= $item->name ?></option>
                                                    <?php   } ?>
                                                <?php   } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label><?= translate("image_lang"); ?> (390X510)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-image"></i></span>
                                        <input id="add_image_1" type="file" class="form-control input-sm" name="archivo" placeholder="<?= translate('image_lang'); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <?php if (file_exists($categoria_object->photo)) { ?>
                                        <img id="imgPrevia" src="<?= base_url($categoria_object->photo) ?>" style="width:50%" class="img-fluid" alt="">
                                    <?php } else { ?>
                                        <img id="imgPrevia" src="<?= base_url('assets/img/imagen-no-found.png') ?>" style="width:100%" class="img-fluid" alt="">
                                    <?php } ?>
                                </div>
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
    $(() => {
        const pesoMaximo = 4 * 1048576;
        var input_imagen_1 = document.getElementById('add_image_1');
        input_imagen_1.addEventListener('change', function(e) {
            var files = e.target.files;
            var sizeByte = this.files[0].size;
            var sizekiloBytes = parseInt(sizeByte / 1024);
            if (this.files[0].type == "image/jpeg" || this.files[0].type == "image/png" || this.files[0].type == "image/jpg") {

                if (this.files[0].size < pesoMaximo) {
                    // Creamos el objeto de la clase FileReader
                    let reader = new FileReader();
                    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                    reader.readAsDataURL(e.target.files[0]);

                    // Le decimos que cuando este listo ejecute el código interno
                    reader.onload = function() {
                        var image = reader.result;
                        $('#imgPrevia').attr('src', image);
                    };

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'La imagen supera el peso máximo de 4MB',
                        showConfirmButton: true,
                    });
                }
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Solo están permitidas las imagenes en formato jpg,jpeg,png',
                    showConfirmButton: true
                });
            }
        });
    })
</script>