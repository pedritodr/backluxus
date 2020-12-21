 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2><?= translate("intercambiar_info_lang"); ?></h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / <?= translate("chat_lang"); ?></a> / <?= $this->session->userdata('nombre') ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->
 <div class="section-title text-center">
     <br>

     <h2><?= translate("intercambiar_info_lang"); ?></h2>

 </div>

 <!-- Start Team Details Area -->

 <div class="container">
     <div class="project-details-content">
         <div class="row ">

             <div class="col-lg-12">

                 <div class="row">
                     <div class="col-lg-12 mensaje text-center">
                         <?= get_message_from_operation(); ?>

                     </div>
                 </div>
                 <div class="box">

                     <div class="box-body">
                         <!-- Chat box -->
                         <div class="box box-success">
                             <div class="box-header">

                                 <span>
                                     <h3 class="box-title"> <i style="color:#f8b604" class="fa fa-comment"></i> <?= translate('chat_lang'); ?></h3>
                                 </span>
                             </div>
                             <br>

                         </div> <!-- /.box (chat box) -->

                         <div class="box-body chat" id="chat-box">
                             <?php foreach ($infos as $info) { ?>
                                 <!-- chat item -->
                                 <div id="item" class="item">
                                     <?php
                                        $url = base_url('assets/juice.png');
                                        if (file_exists($info->foto))
                                            $url = base_url($info->foto)
                                            ?>

                                     <?php
                                        $imagen = "";
                                        if (file_exists($info->imagen))
                                            $imagen = base_url($info->imagen)
                                            ?>
                                     <div class="row">

                                         <div class="col-lg-1">
                                             <img style="width: 50px; height: 50px;" class="img-circle img-responsive" src="<?= $url; ?>" alt="user image" class="online">

                                         </div>
                                         <div class="col-lg-11">
                                             <p class="message">
                                                 <a id="nombre" href="#" class="name">
                                                     <small id="fecha" class="text-muted pull-right"><i class="fa fa-calendar"></i> <?= $info->fecha; ?></small><br>
                                                     <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?= $info->hora; ?></small>

                                                     <?= $info->nombre; ?>
                                                 </a>
                                                 <?= $info->contenido; ?>

                                             </p>
                                         </div>
                                     </div>




                                     <!-- /.box-body -->

                                     <?php if ($info->imagen) { ?>
                                         <div id="box-footer" class="box-footer">
                                             <ul class="mailbox-attachments clearfix">
                                                 <li>
                                                     <span class="mailbox-attachment-icon has-img"><img style="width: 100px; height: 100px;" class="img-rounded img-responsive" src="<?= $imagen; ?>" alt="Attachment"> <a id="descargar" class="btn btn-default btn-xs pull-left" href="<?= site_url('front/descargar_imagen/' . $info->info_id); ?>"><i class="fa fa-cloud-download"></i></a>
                                                     </span>


                                                 </li>
                                             </ul>
                                         </div>
                                     <?php } ?>

                                 </div> <!-- /.item -->
                             <?php } ?>
                         </div> <!-- /.chat -->
                         <div class="box-footer">

                             <?= form_open_multipart("front/enviar_mensaje"); ?>

                             <div class="col-lg-9">
                                 <label><?= translate("message_lang"); ?></label>
                                 <div class="input-group">
                                     <span class="input-group-addon" style="border:1px solid #f8b604;"><i class="fa fa-comment"></i></span> <input style="border:1px solid #f8b604; height:3.5rem;" type="text" class="form-control" name="contenido" required placeholder="<?= translate('message_lang'); ?>">
                                 </div>
                             </div>
                             <div class="col-lg-3">
                                 <label><?= translate("foto_lang"); ?> (1920X766)</label>
                                 <div class="input-group">
                                     <span class="input-group-addon" style="border:1px solid #f8b604;"><i class="fa fa-image"></i></span>
                                     <input style="border:1px solid #f8b604; height:3.5rem;" type="file" class="form-control" name="archivo" placeholder="<?= translate('foto_lang'); ?>">

                                 </div>
                             </div>

                             <div class="col-lg-12" style="text-align: right;">
                                 <input name="solicitud_id" id="solicitud_id" type="hidden" value="<?= $solicitud_id; ?>">
                                 <button type="submit" class="btn btn-success"><i class="fa fa-check-square"></i> <?= translate('enviar_lang'); ?></button>

                             </div>
                             <?= form_close(); ?>

                         </div>
                     </div><!-- /.box-body -->
                 </div><!-- /.box -->
             </div><!-- /.col -->








         </div>
     </div>
 </div>
 <div class="section-title text-center">


     <h2></h2>

 </div>

 <br> <br>
 <!-- End Team Details Area -->






 <!-- Start scroll to top feature -->

 <script>
     $(document).ready(function() {
         setTimeout(function() {
             $(".mensaje").fadeOut(1500);
         }, 3000);
         /*  setTimeout(function() {
               $("#chat-box").empty();
               $("#chat-box").html("<div id='item' class='item'><div class='row'><div class='col-lg-1'><img id='foto' style='width: 50px; height: 50px;' class='img-circle img-responsive' src='' alt='user image' class='online'></div><div class='col-lg-11'><p class='message'><a href='#' class='name'><small class='text-muted pull-right'><i class='fa fa-calendar'></i></small><br><small class='text-muted pull-right'><i class='fa fa-clock-o'></i></small></a></p></div></div><div id='box-footer' class='box-footer'><ul class='mailbox-attachments clearfix'><li id='detalle'><span class='mailbox-attachment-icon has-img'><img id='imagen' style='width: 100px; height: 100px;' class='img-rounded img-responsive' src=''  alt='Attachment'> <a id='descargar' class='btn btn-default btn-xs pull-left' href=''><i class='fa fa-cloud-download'></i></a></span></li></ul></div><br></div>");

               var id = $('input[name=solicitud_id]').val();

               $.ajax({
                   type: 'POST',
                   url: "<?= site_url('front/chat_ajax') ?>",
                   data: {
                       id: id
                   },
                   success: function(result) {
                       result = JSON.parse(result);
                       console.log(result);
                       $('#chat-box').find('div.Clone').remove();

                       for (var i = 0; i < result.length; i++) {

                           var new_per = $('#item').clone();
                           $(new_per).attr('id', 'item_' + i);
                           $(new_per).addClass('Clone');

                           $(new_per).find('p').html(result[i].contenido);
                           $(new_per).find('a').attr('href', '<?= base_url('front/descargar_imagen/') ?>/' + result[i].solicitud_id);


                           if (result[i].imagen) {

                               $(new_per).find('#imagen').attr('src', '<?= base_url() ?>' + result[i].imagen);

                           } else {

                               $(new_per).find('#box-footer').hide();
                           }


                           if (result[i].foto) {

                               $(new_per).find('#foto').attr('src', '<?= base_url() ?>' + result[i].foto);

                           } else {

                               $(new_per).find('#foto').attr('src', '<?= base_url('assets/juice.png') ?>');

                           }

                           $('#chat-box').append(new_per);
                           $('#item_' + i).show();

                       }
                   }
               });
           }, 30000);*/
     });
 </script>