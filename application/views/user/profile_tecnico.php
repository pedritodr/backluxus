<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Editar perfil | <?= $user_object->nombre ?>

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
                        <form enctype="multipart/form-data" method="post" action="<?= site_url('user/execute_edit_profile_tecnico'); ?>" method="post">
                            <div>
                                <?= get_message_from_operation(); ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">

                                    <div class="form-group">
                                        <label class="control-label">Nombres</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="name" value="<?= $user_object->nombre; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-3">

                                    <div class="form-group">
                                        <label class="control-label">Apellidos</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="apellido" value="<?= $datos_tecnico->apellido; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-3">

                                    <div class="form-group">
                                        <label class="control-label">Cédula</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="cedula" value="<?= $datos_tecnico->cedula; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-3">

                                    <div class="form-group">
                                        <label class="control-label">RUC</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="ruc" value="<?= $datos_tecnico->ruc; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label><?= translate("sexo_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                        <select class="form-control" name="sexo" id="sexo">
                                            <option <?php if ($datos_tecnico->sexo == 1) { ?> selected <?php } ?> value="1">Masculino</option>
                                            <option <?php if ($datos_tecnico->sexo == 0) { ?> selected <?php } ?> value="0">Femenino</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Celular</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                            <input type="text" name="celular" value="<?= $datos_tecnico->celular; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Telefono</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                            <input type="text" name="phone" value="<?= $datos_tecnico->telefono; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Carga Familiar</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                        <select class="form-control" name="carga" id="carga">
                                            <option <?php if ($datos_tecnico->carga_familiar == 1) { ?> selected <?php } ?> value="1">Si</option>
                                            <option <?php if ($datos_tecnico->carga_familiar == 0) { ?> selected <?php } ?> value="0">No</option>
                                        </select>

                                    </div>

                                </div>
                                <div class="col-xs-2">
                                    <label><?= translate("conadis_lang"); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                        <select class="form-control" name="conadis" id="conadis">
                                            <option <?php if ($datos_tecnico->conadis == 1) { ?> selected <?php } ?> value="1">Si</option>
                                            <option <?php if ($datos_tecnico->conadis == 0) { ?> selected <?php } ?> value="0">No</option>
                                        </select>

                                    </div>

                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">Foto</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
                                            <input type="file" name="archivo" class="form-control">
                                        </div>

                                    </div>
                                </div>




                            </div>
                            <div class="row">
                                <div class="box-header">
                                    <h3 class="box-title">Referencia Bancaria</h3>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label"><?= translate("institucion_lang"); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="institucion" value="<?= $referencia_bancaria->institucion_financiera; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Nombre a Depositar</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="nombre_b" value="<?= $referencia_bancaria->nombre_depositar; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label">Número de Cuenta</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="cuenta" value="<?= $referencia_bancaria->numero_cuenta; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <label>Tipo de Cuenta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option <?php if ($referencia_bancaria->tipo_cuenta == 1) { ?> selected <?php } ?> value="1">Ahorro</option>
                                            <option <?php if ($referencia_bancaria->tipo_cuenta == 2) { ?> selected <?php } ?> value="2">Corriente</option>
                                        </select>

                                    </div>

                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Cédula/RUC</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="ced_ruc" value="<?= $referencia_bancaria->cedula_ruc; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Telefono/Celular</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" name="telf_cel" value="<?= $referencia_bancaria->telefono; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="text" name="email_b" value="<?= $referencia_bancaria->email; ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-header">
                                    <h3 class="box-title">Categoria de Servicio</h3>
                                </div>

                                <?php foreach ($categories as $category) { ?>

                                    <div class="col-xs-12">
                                        <div class="box-header">
                                            <h4 style="color:#f8b604;" class="text-center"><?= $category->nombre; ?></h4>
                                        </div>
                                        <?php foreach ($category->subcategories as $subcategory) { ?>
                                            <div class="col-lg-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input id="subcategorias" name="subcategorias[]" type="checkbox" <?php if (isset($tecnico_categorias)) {
                                                                                                                                if (in_array($subcategory->subcategoria_id, $tecnico_categorias)) { ?> checked <?php }
                                                                                                                                                                                                                    } ?> value="<?= $subcategory->subcategoria_id; ?>">
                                                        <strong><?= $subcategory->nom_sub; ?></strong>
                                                        <br>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                <?php } ?>

                            </div>

                            <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />

                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Aceptar
                                    </button>
                                    <a class="btn btn-default" href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->
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