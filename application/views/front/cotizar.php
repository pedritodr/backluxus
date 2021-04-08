<!--Breadcrumb-->
<section id="breadcrumb" class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 breadcrumb-block">
                <h2>Cotizar</h2>
            </div>
            <div class="col-sm-6 breadcrumb-block text-right">
                <ol class="breadcrumb">
                    <li><span>Usted está en: </span><a href="<?= base_url();?>">Inicio</a></li>
                    <li class="active">Cotizador</li>
                </ol>
            </div>
        </div>
    </div>
</section>
</section>
<!-- Contact us-->
<section id="contact" class="space">
    <div class="container">
        <div class="row">
            <h1 style="text-align: center">Ingrese los servicios que necesite y le contactamos:</h1>
            <?= get_message_from_operation();?>
            <div class="col-sm-12 no-padding contact-base">

                <div class="col-sm-4 contact-block">
                    <div class="contact-item">
                        <img class="img img-responsive" src="<?= base_url('uploads/q.jpg')?>"/>
                    </div>
                    <div class="contact-item">
                        <div class="icon pull-left center">
                            <i class="fa fa-map-o"></i>
                        </div>
                        <div class="contact-text">
                            <h5>Visítenos:</h5>
                            <p><?= $empresa->direccion?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon pull-left center">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="contact-text">
                            <h5>Escríbanos:</h5>
                            <a href="mailto:<?= $empresa->email?>"><?= $empresa->email?></a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon pull-left center">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h5>Llámenos:</h5>
                            <a href="tel:<?= $empresa->telef?>"><?= $empresa->telef?></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 contact-block">
                    <form id="contact-form" method="post">
                        <h4>Sus datos:</h4>
                        <div class="form-group col-sm-12">
                            <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Su Nombre">
                        </div>
                        <div class="form-group col-sm-6">
                            <input required type="email" class="form-control" name="email" id="email" placeholder="Su Correo">
                        </div>
                        <div class="form-group col-sm-6">
                            <input required type="text" class="form-control" name="phone" id="phone" placeholder="Su teléfono">
                        </div>
                        <!-- iCheck -->
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <?php if(isset($all_categories)){
                                    $count = 1;?>
                                    <h4>Está interesado en:</h4>
                                    <?php foreach ($all_categories as $cat)
                                    {?>

                                            <label style="margin-right: 10px;font-weight: initial;">
                                                <input id="c_<?= $count?>" onclick="chequear_cat(<?= $count?>)" type="checkbox" name="cat[]"  value="<?= $cat->nombre?>" style="display: block;float: left;position: relative;margin-right: 10px;vertical-align: middle;padding: 0;width: 20px;height: 20px;border: none;cursor: pointer;" /> <?= $cat->nombre?>
                                            </label>

                                    <?php
                                    $count ++;
                                    } }?>
                            </div>

                            <div class="form-group">
                                <?php if(isset($all_services)){
                                    $count2 = 1;?>
                                    <h5>Incluyendo:</h5>
                                    <?php foreach ($all_services as $serv)
                                    {?>
                                        <label style="margin-right: 10px;font-weight: initial;">
                                            <input id="s_<?= $count2?>" onclick="chequear_serv(<?= $count2?>)" type="checkbox" name="serv[]"  value="<?= $serv->nombre?>" style="display: block;float: left;position: relative;margin-right: 10px;vertical-align: middle;padding: 0;width: 20px;height: 20px;border: none;cursor: pointer;" /> <?= $serv->nombre?>
                                        </label><br>
                                    <?php
                                    $count2++;
                                    } }?>
                            </div>

                            </div>
                        </div>

                            <!-- /.box-body -->

                        <!-- /.box -->
                        <h4>Quisiera agendar una reunión:</h4>
                        <div class="form-group col-sm-12">
                                <select type="text" class="form-control" name="agendar" id="agendar">
                                    <option>Me gustaría</option>
                                    <option>No gracias</option>
                                </select>
                        </div>
                        <div class="form-group col-sm-12 ">
                            <textarea class="form-control" name="comment" id="comment" placeholder="Comentarios Adicionales..."></textarea>
                        </div>
                        <div class="form-group col-sm-12 ">
                            <?php echo $captcha?>
                        </div>
                        <div class="col-sm-12 form-group button no-padding">
                            <button type="submit" class="btn">Cotizar</button>
                            <div id="msg" class="message"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function chequear_cat(e) {
        if($('#c_'+e).attr('checked'))
            $('#c_'+e).removeAttr('checked');
        else
            $('#c_'+e).attr('checked','checked');
    }
    function chequear_serv(e) {
        if($('#s_'+e).attr('checked'))
            $('#s_'+e).removeAttr('checked');
        else
            $('#s_'+e).attr('checked','checked');
    }

</script>