<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= "Gestionar colegio"; ?>
            <small><?= "Sobre nosotros"; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i
                        class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= "Sobre nosotros"; ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= "Sobre nosotros"; ?></h3>
                    </div>
                    <div class="box-body">

                        <?= get_message_from_operation();?>
                        <?= form_open_multipart("empresa/update_presentacion"); ?>
                        <input type="hidden" name="empresa_id" value="<?= $empresa_object->empresa_id;?>" />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12" style="text-align:center;">
                                        <h3>Presentación del colegio</h3>
                                            <hr />
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-6" >
                                        <label><?= "Título de sección";?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control" name="titulo" required
                                                   value="<?= $empresa_object->titulo_seccion_about;?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6" >
                                        <label><?= "Firmante";?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="text" class="form-control" name="firmante" value="<?= $empresa_object->firmante;?>"
                                                   value="<?= $empresa_object->firmante;?>">
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="col-lg-6" style="margin-top:15px;">
                                       
                                        <div class="form-group">                                           
                                        <label><?= "Presentación";?></label>
                                        <textarea style="height:150px;" class="form-control" name="presentacion"><?= $empresa_object->descripcion;?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6" style="margin-top:15px;">
                                        <label><?= "Foto";?></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                            <input type="file" class="form-control" name="archivo" />
                                        </div>
                                    </div>

                                    
                                    
                                    
                                    
                                </div>
                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Completar presentación</button>
                              
                               

                            </div>
                        <?= form_close(); ?>


                        <?= form_open_multipart('empresa/update_mision');?>
                        <div class="row">
                            <div class="col-lg-12" style="text-align:center;">
                                <h3>Misión del colegio</h3>
                                <hr />
                            </div>
                        </div>

                        
                        <div class="col-lg-6">
                        <div class="form-group">                                           
                            <label><?= "Misión";?></label>
                            <textarea style="height:150px;" class="form-control" name="mision"><?= $empresa_object->mision;?></textarea>
                        </div>
                        </div>

                        <div class="col-lg-6">
                        <label><?= "Foto";?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="file" class="form-control" name="archivo" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button style="margin-left:15px;" class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Completar Misión</button>
                        <?= form_close();?>

                        <?= form_open_multipart('empresa/update_vision');?>
                        <div class="row">
                            <div class="col-lg-12" style="text-align:center;">
                                <h3>Visión del colegio</h3>
                                <hr />
                            </div>
                        </div>

                        
                        <div class="col-lg-6">
                        <div class="form-group">                                           
                            <label><?= "Visión";?></label>
                            <textarea style="height:150px;" class="form-control" name="vision"><?= $empresa_object->vision;?></textarea>
                        </div>
                        </div>

                        <div class="col-lg-6">
                        <label><?= "Foto";?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="file" class="form-control" name="archivo" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button style="margin-left:15px;" class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Completar Visión</button>
                        <?= form_close();?>

                        <?= form_open_multipart('empresa/update_historia');?>
                        <div class="row">
                            <div class="col-lg-12" style="text-align:center;">
                                <h3>Historia del colegio</h3>
                                <hr />
                            </div>
                        </div>

                        
                        <div class="col-lg-6">
                        <div class="form-group">                                           
                            <label><?= "Historia del colegio";?></label>
                            <textarea style="height:150px;" class="form-control" name="historia"><?= $empresa_object->historia;?></textarea>
                        </div>
                        </div>

                        <div class="col-lg-6">
                        <label><?= "Foto";?></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                <input type="file" class="form-control" name="archivo" />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button style="margin-left:15px;" class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Completar Historia</button>
                        <?= form_close();?>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function () {
        $("#example1").DataTable();
        $(".textarea").wysihtml5();
    });
</script>