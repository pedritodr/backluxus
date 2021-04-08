 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2>Datos de Perfil</h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / <a href="<?= site_url('perfil'); ?>"> Datos de perfil</a> / <?= $this->session->userdata('nombre') ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->
 <div class="section-title text-center">


     <h2><?= translate("profile_lang"); ?></h2>

 </div>

 <!-- Start Team Details Area -->
 <!-- <section class="cleaning-content-block">
     <div class="container">
         <div class="expert-team">
             <div class="row">
                 <div class="col-md-4 col-lg-3">
                     <div class="profile-box contact-form-area">
                         <?php
                            $url = base_url('assets/juice.png');
                            if (file_exists($this->session->userdata('foto')))
                                $url = base_url($this->session->userdata('foto'))
                            ?>
                         <img src="<?= $url; ?>" class="user-image" alt="User Image">

                         <div style="margin-top:30px" class="text-center">
                             <div id="contact_send_status"></div>
                             <input type="submit" onclick="cargar_credenciales();" class="sbmt-btn" value="Credenciales">


                         </div>

                     </div>
                 </div>

                 <div class="col-md-8 col-lg-9">
                     <div class="contact-form-area">
                         <form id="form1" enctype="multipart/form-data" method="post" action="<?= site_url('front/execute_edit_profile_cliente'); ?>" method="post">
                             <div>
                                 <?= get_message_from_operation(); ?>
                             </div>
                             <h4 class="text-center">Datos Básicos</h4>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <input type="text" name="name" value="<?= $user_object->nombre; ?>" class="form-control">
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <input type="text" name="apellido" value="<?= $cliente_object->apellido; ?>" class="form-control">
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <div class="form-group">
                                     <input type="text" name="cedula" value="<?= $cliente_object->cedula; ?>" class="form-control">
                                 </div>
                             </div>

                             <div class="col-md-3">
                                 <div class="form-group">

                                     <select id="sexo" name="sexo" style="height: 4.5rem;" class="form-control">

                                         <option <?php if ($cliente_object->sexo == 1) { ?> selected <?php } ?> value="1">Masculino</option>
                                         <option <?php if ($cliente_object->sexo == 0) { ?> selected <?php } ?> value="0">Femenino</option>

                                     </select>
                                 </div>
                             </div>


                             <div class="col-md-3">
                                 <div class="form-group">
                                     <input type="text" name="celular" value="<?= $cliente_object->celular; ?>" class="form-control">
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <div class="form-group">
                                     <input type="text" name="phone" value="<?= $cliente_object->telefono; ?>" class="form-control" placeholder="Teléfono">
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="form-group">
                                     <div class="input-group">
                                         <span class="input-group-addon"><i class="fa fa-file-image-o"></i>Foto</span>
                                         <input type="file" name="archivo" class="form-control">
                                     </div>

                                 </div>
                             </div>
                             <div class="text-center">
                                 <div id="contact_send_status"></div>
                                 <input type="submit" class="sbmt-btn" value="Actualizar">
                                 <input type="submit" onclick="location.href='<?= site_url(); ?>';" class="sbmt-btn" value="Cancelar">

                             </div>
                             <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />
                         </form>
                         <form id="form2" style="display: none" enctype="multipart/form-data" method="post" action="<?= site_url('front/execute_edit_credencial'); ?>" method="post">
                             <div>
                                 <?= get_message_from_operation(); ?>
                             </div>
                             <div class="row">
                                 <div class="col-xs-6">

                                     <div class="form-group">
                                         <label class="control-label">Email</label>

                                         <div class="input-group">
                                             <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                             <input type="text" name="email" value="<?= $user_object->email; ?>" class="form-control">
                                         </div>

                                     </div>
                                 </div>
                                 <div class="col-xs-6">
                                     <div class="form-group">
                                         <label class="control-label"><?= translate("password_lang"); ?></label>

                                         <div class="input-group">
                                             <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                             <input type="password" id="password" name="password" value="<?= $user_object->password; ?>" class="form-control">
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <input type="hidden" name="user_id" value="<?= $user_object->user_id; ?>" />
                             <input type="hidden" name="validacion" value=0 />

                             <div class="text-center">
                                 <div id="contact_send_status"></div>
                                 <input type="submit" class="sbmt-btn" value="Actualizar">
                                 <input type="submit" onclick="location.href='<?= site_url(); ?>';" class="sbmt-btn" value="Cancelar">

                             </div>
                         </form>


                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section> -->
 <!-- End Team Details Area -->







 <!-- Start scroll to top feature -->
 <a href="#" id="back-to-top" title="Back to Top">
     <i class="fa fa-long-arrow-up"></i>
 </a>
 <!-- End scroll to top feature -->
 <script>
     function cargar_credenciales() {
         $("#form1").hide();
         $("#form2").show();

     }
     $("#password").focus(function() {
         $(this).css("background-color", "#FFFFCC");
         $(this).prop('type', 'text');
         $("#password").val("");
         $('input[name=validacion]').val(1);
     });
 </script>