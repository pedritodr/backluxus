<div class="main-container" id="container">

    <div class="layout-px-spacing" style="width:100%">
        <h3>
            <?= translate('manage_clients_lang') ?> | <a href="<?= site_url('user/index_client'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h3>

        <div class="col-xs-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h6 class="text-simple"><?= translate('add_client_lang') ?></h6>
                </div>
                <div class="widget-content widget-content-area">

                    <?= get_message_from_operation(); ?>
                    <?= form_open_multipart("user/add_client"); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <label><?= translate("name_company_lang"); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="name_company" required placeholder="<?= translate('name_company_lang'); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate('name_commercial_lang') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="name_commercial" required placeholder="<?= translate('name_commercial_lang') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate('email_lang') ?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="text" class="form-control input-sm" name="email" required placeholder="<?= translate('email_lang') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label><?= translate("password_lang"); ?></label>
                            <div class="input-group">
                                <input type="password" class="form-control input-sm" id="password" name="password" required placeholder="<?= translate('password_lang'); ?>">
                                <div class="input-group-append">
                                    <button id="btnVerPassword" onclick="actionPassword()" class="btn btn-info" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label"><?=translate('observations_lang') ?></label>
                                <div id="editor-container1" class="form-control"></div>
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
        const svgEye = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>';
        const svgEyeOff = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884l-12-12 .708-.708 12 12-.708.708z"/></svg>';

        const actionPassword = () => {
            var x = document.getElementById("password");
            if (x.type === "password") {
                $('#btnVerPassword').html(svgEyeOff);
                x.type = "text";
            } else {
                $('#btnVerPassword').html(svgEye);
                x.type = "password";
            }
        }
        let quill;
        $(()=>{
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