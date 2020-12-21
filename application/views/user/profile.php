<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Editar perfil | <?= $user_object->name ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> Pizarra resumen</a></li>

            <li class="active">Editar perfil</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Formulario para editar perfil de usuario</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?= get_message_from_operation(); ?>

                        <?= form_open_multipart("user/update"); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <label><?= translate("fullname_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                    <input type="text" class="form-control input-sm" name="fullname" required value="<?= $user_object->name; ?>" placeholder="<?= translate('fullname_lang'); ?>">
                                </div>


                            </div>

                            <div class="col-lg-6">
                                <label><?= translate("email_lang"); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control input-sm" required name="email" value="<?= $user_object->email; ?>" readonly placeholder="<?= translate('email_lang') ?>">
                                </div>

                                <div style="display:none;">
                                    <label><?= translate("role_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <select class="form-control" name="role" id="role">
                                            <option selected value="1"><?= translate("administrador_lang"); ?></option>
                                            <option value="3"><?= translate("editor_lang"); ?></option>

                                        </select>
                                    </div>
                                    <br>
                                </div>




                                <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />

                            </div>

                           
                        </div>

                        <div class="row" style="margin-top:15px;">
                            <div class="col-xs-12" style="text-align: left;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square"></i> <?= translate('guardar_info_lang'); ?></button>
                            </div>
                        </div>
                        <?= form_close(); ?>


                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</div>

<script type="text/javascript">
    $(function() {
        $(".textarea").wysihtml5();
    });
</script>