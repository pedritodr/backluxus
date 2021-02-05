<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_clients_lang') ?> | <a href="<?= site_url('user/index_client'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"><?= translate('editar_client_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">

                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("user/update_client"); ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <label><?= translate("name_company_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="name_company" required placeholder="<?= translate('name_company_lang'); ?>" value="<?= $user_object->name_company ?>">
                                <input type="hidden" name="user_id" value="<?= $user_object->user_id ?>">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label><?= translate('name_commercial_lang') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="name_commercial" required placeholder="<?= translate('name_commercial_lang') ?>" value="<?= $user_object->name_commercial ?>">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label><?= translate('phone_lang') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="phone" required placeholder="<?= translate('phone_lang') ?>" value="<?= $user_object->phone ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label"><?= translate('observations_lang') ?></label>
                                <div id="editor-container1" class="form-control"><?= $user_object->observations ?></div>
                                <textarea style="display:none" name="desc" id="desc" cols="30" rows="10"></textarea>
                                <br>
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
        $(() => {
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
        })
        let form = document.querySelector('form');
        form.onsubmit = function() {
            let contenido = $('#editor-container1').text();
            $('#desc').html(contenido);
        }
    </script>