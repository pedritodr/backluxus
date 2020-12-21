 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2>Solicitudes</h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / <a href="<?= site_url('solicitudes'); ?>"> Solicitudes enviadas</a> / <?= $this->session->userdata('nombre') ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->
 <div class="section-title text-center">
     <br>

     <h2><?= translate("solicitudes_lang"); ?></h2>

 </div>

 <!-- Start Team Details Area -->

 <div class="container">
     <div class="project-details-content">
         <div class="row">

             <div class="col-lg-12">

                 <div class="row">
                     <div class="col-lg-12 mensaje text-center">
                         <?= get_message_from_operation(); ?>

                     </div>
                 </div>

                 <table id="example1" class="table table-bordered table-striped">
                     <thead>
                         <tr>
                             <th><?= translate("numero_lang"); ?></th>
                             <th><?= translate("datasolicitud_lang"); ?></th>
                             <th><?= translate("tecnicos_lang"); ?></th>

                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($solicitudes_enviadas as $item) {

                                ?>
                             <tr>
                                 <td><?= $item->solicitud_id; ?></td>
                                 <td>
                                     <p><strong><?= translate("subcategoria_lang"); ?>: </strong> <?= $item->nombre; ?></p>
                                     <p><strong><?= translate("add_descripcion_lang"); ?>: </strong> <?= $item->descripcion_servicio; ?></p>
                                     <p><strong><?= translate("date_lang"); ?>: </strong> <?= $item->fecha; ?> <strong><?= translate("hora_lang"); ?>: </strong> <?= $item->hora; ?> h.</p>
                                     <p><strong><?= translate("direccion_lang"); ?>: </strong> <?= $item->direccion; ?></p>
                                     <p><strong><?= translate("persona_refe_lang"); ?>: </strong> <?= $item->persona_referencia; ?> <strong><?= translate("phone_cel_lang"); ?>: </strong> <?= $item->contacto_celular; ?></p>
                                     <p><strong><?= translate("referencia_lang"); ?>: </strong> <?= $item->referencia; ?></p>
                                     <?php
                                        if ($item->monto_final > 0) { ?>
                                         <p><strong>Cotizada en: </strong><strong style="color: #f8b604;">$<?= $item->monto_final; ?></strong></p>
                                     <?php } ?>

                                     <?php
                                        if ($item->estado_solicitud == 0) { ?>
                                         <span style="font-size: 10px" class="label label-warning">En revisión</span>
                                     <?php
                                    } else if ($item->estado_solicitud == 1) { ?>
                                         <span style="font-size: 10px" class="label label-danger">En espera</span></span>
                                     <?php } else if ($item->estado_solicitud == 2) { ?>
                                         <span style="font-size: 10px" class="label label-success">Culminada</span></span>
                                     <?php } else if ($item->estado_solicitud == 3) { ?>
                                         <span style="font-size: 10px" class="label label-danger">Cancelada</span></span>
                                     <?php } ?> </p>
                                     </strong>

                                     <br>
                                     <?php if ($item->estado_solicitud != 3 and $item->estado_solicitud != 2) { ?>
                                         <button onclick="cargar_motivo('<?= $item->solicitud_id; ?>')" data-toggle="modal" data-target="#myModal4" class="btn btn-danger"><i class="fa fa-ban"></i> <?= translate('cancelar_solicitud_lang'); ?></button>
                                     <?php } ?>
                                     <?php if ($item->estado_solicitud == 2 and $item->calificacion == 0) { ?>
                                         <button onclick="cargar_calificacion('<?= $item->solicitud_id; ?>','<?= $item->cliente_id; ?>')" data-toggle="modal" data-target="#myModal3" class="btn btn-warning"><i class="fa fa-star"></i> <?= translate('calificar_lang'); ?></button>
                                     <?php } ?>
                                     <?php if ($item->estado_solicitud == 3) { ?>
                                         <p><strong>Motivo de cancelación: </strong> <?= $item->motivo; ?></p> <?php } ?>
                                 </td>

                                 <td>
                                     <?php foreach ($item->tecnicos as $tecnico) {

                                            ?>
                                         <div class="product-box-area text-center">

                                             <strong>
                                                 <p><?= $tecnico->nombre; ?> <?= $tecnico->apellido; ?> <?php
                                                                                                        if ($tecnico->estado_tecnico == 0) { ?>
                                                         <span style="font-size: 10px" class="label label-warning">En revisión</span>
                                                     <?php
                                                    } else if ($tecnico->estado_tecnico == 1) { ?>
                                                         <span style="font-size: 10px" class="label label-danger">Cotizada</span>
                                                     <?php } else if ($tecnico->estado_tecnico == 2) { ?>
                                                         <span style="font-size: 10px" class="label label-primary">Visita</span>

                                                     <?php } else if ($tecnico->estado_tecnico == 6) { ?>
                                                         <span style="font-size: 10px" class="label label-success">Culminada</span>

                                                     <?php } else if ($item->estado_solicitud == 3) { ?>
                                                         <span style="font-size: 10px" class="label label-danger">Cancelada</span>

                                                     <?php } ?></p>
                                             </strong>



                                             <div class="col-md-12 col-xs-12">
                                                 <div class="col-md-1"></div>
                                                 <?php if ($item->monto_final > 0) { ?>
                                                     <div class="col-md-3"></div>
                                                 <?php } ?>
                                                 <?php if ($item->monto_final <= 0) { ?>

                                                     <div class="col-md-6 col-xs-6" style="padding:0px 0px;">
                                                         <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;">Cotización: <strong><span style="color: #f8b604;">$<?= $tecnico->precio; ?></span> </strong></h5>
                                                         <?php if ($tecnico->precio_cliente > 0) { ?>
                                                             <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;">Propuesto: <strong><span style="color: #f8b604;">$<?= $tecnico->precio_cliente; ?></span> </strong></h5>

                                                         <?php } ?>
                                                         <?php if ($tecnico->visita) { ?>

                                                             <?php if ($tecnico->visita->fecha_visita != "0000-00-00") { ?>
                                                                 <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;"><strong><span style="color: #f8b604;">Visita</span> </strong></h5>
                                                                 <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;">Fecha: <strong><span style="color: #f8b604;"><?= $tecnico->visita->fecha_visita; ?></span> </strong></h5>
                                                                 <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;">Hora: <strong><span style="color: #f8b604;"><?= $tecnico->visita->hora_visita; ?></span> </strong></h5>

                                                             <?php } else { ?>
                                                                 <h5 style="margin-left:15px; margin-right:0px; padding:0px 0px;"><strong><span style="color: #f8b604;">Solicito visita</span> </strong></h5>

                                                             <?php } ?>
                                                         <?php } ?>
                                                     </div>
                                                 <?php } ?>
                                                 <?php if ($tecnico->estado_tecnico != 6) { ?>
                                                     <?php if ($item->estado_solicitud != 3) { ?>

                                                         <div class="col-md-4 col-xs-12" style="margin-left:0px; margin-right:0px; padding:0px 0px;">
                                                             <div class="btn-group">
                                                                 <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                     Acciones <span class="caret"></span>
                                                                 </button>
                                                                 <ul class="dropdown-menu dropdown-menu-right">
                                                                     <?php if ($item->monto_final <= 0) { ?>
                                                                         <li> <a id="aceptar" class="shop-btn" href="<?= site_url('front/aceptar_solicitud/' . $item->solicitud_id . "/" . $tecnico->tecnico_id . "/" . $tecnico->precio); ?>"><i class="fa fa-check"></i> Aceptar</a>
                                                                         </li>
                                                                     <?php } ?>
                                                                     <?php if ($item->monto_final <= 0) { ?>
                                                                         <li> <a id="rechazar" class="shop-btn" href="<?= site_url('front/rechazar_tecnico/' . $item->solicitud_id . "/" . $tecnico->tecnico_id); ?>"><i class="fa fa-close"></i> Rechazar</a>
                                                                         </li>
                                                                     <?php } ?>

                                                                     <?php if ($item->monto_final <= 0) { ?>
                                                                         <?php if ($tecnico->precio > 0) { ?>
                                                                             <li id=proponer> <a onclick="cargar_modal('<?= $tecnico->solicitud_id; ?>','<?= $tecnico->tecnico_id; ?>')" id="proponer" class="shop-btn" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-dollar"></i> Proponer precio</a>
                                                                             </li>
                                                                         <?php } ?>
                                                                     <?php } ?>



                                                                     <?php if ($tecnico->visita != NULL) { ?>

                                                                         <?php if ($tecnico->visita->fecha_visita == "0000-00-00") { ?>
                                                                             <li id="aceptar_visita2"> <a onclick="cargar_visita('<?= $tecnico->solicitud_id; ?>','<?= $tecnico->tecnico_id; ?>')" id="aceptar_visita" class="shop-btn" data-toggle="modal" data-target="#myModal2" href="#"><i class="fa fa-car"></i> Aceptar visita</a>
                                                                             </li>

                                                                         <?php } ?>
                                                                     <?php } ?>

                                                                     <?php if ($item->estado_solicitud != 2) { ?>
                                                                         <li>
                                                                             <a id="intercambiar" class="shop-btn" href="<?= site_url('intercambiar-informacion/' . $item->solicitud_id); ?>"><i class="fa fa-inbox"></i> <?= translate('intercambiar_info_lang'); ?></a>
                                                                         </li>


                                                                     <?php } ?>


                                                                 </ul>


                                                             </div>
                                                         </div>
                                                     <?php } ?>
                                                 <?php } ?>
                                             </div>
                                             <br><br><br>




                                         </div>



                                     <?php } ?>
                                 </td>



                             </tr>

                         <?php } ?>

                     </tbody>
                     <tfoot>
                         <tr>
                             <th><?= translate("numero_lang"); ?></th>
                             <th><?= translate("datasolicitud_lang"); ?></th>
                             <th><?= translate("tecnicos_lang"); ?></th>

                         </tr>
                     </tfoot>
                 </table>







             </div>
         </div>
     </div>

 </div>
 <br> <br>
 <!-- End Team Details Area -->

 <!-- Modal -->
 <div id="myModal" class="modal fade" role="dialog">
     <div class="modal-dialog modal-sm">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Proponer precio</h4>
             </div>
             <div class="modal-body">
                 <form class="form-inline" enctype="multipart/form-data" method="post" action="<?= site_url('front/proponer_precio'); ?>" method="post">
                     <div class="form-group">

                         <label><?= translate("precio_lang"); ?></label>
                         <div class="input-group input-sm">
                             <span style="border:1px solid #f8b604;" class="input-group-addon"><i class="fa fa-dollar"></i></span>
                             <input style="padding: 18px 10px; line-height: 20px;" type="number" step="any" class="form-control" name="precio" min="1" pattern="^[0-9]+" required placeholder="<?= translate('precio_lang'); ?>">
                             <input type="hidden" name="solicitud_id" value="0" />
                             <input type="hidden" name="tecnico_id" value="0" />


                         </div>




                     </div>

             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Enviar</button>

                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>


             </div>
             </form>
         </div>

     </div>
 </div>
 <!-- Modal -->
 <div id="myModal4" class="modal fade" role="dialog">
     <div class="modal-dialog modal-xs">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Cancelación</h4>
             </div>
             <div class="modal-body">
                 <form class="form-vertical" enctype="multipart/form-data" method="post" action="<?= site_url('front/cancelar_solicitud'); ?>" method="post">


                     <div class="form-group">
                         <label for="motivo"><?= translate('motivo_lang'); ?>:</label>
                         <textarea class="form-control" rows="5" id="motivo" name="motivo" required placeholder="<?= translate('motivo_lang'); ?>"></textarea>
                     </div>

                     <input type="hidden" name="solicitud_id" value="0" />
                     <input type="hidden" name="tecnico_id" value="0" />
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Enviar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

             </div>
             </form>
         </div>

     </div>
 </div>

 <!-- Modal -->
 <div id="myModal2" class="modal fade" role="dialog">
     <div class="modal-dialog modal-sm">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Aceptar visita</h4>
             </div>
             <div class="modal-body">
                 <form class="form-vertical" enctype="multipart/form-data" method="post" action="<?= site_url('front/aceptar_visita'); ?>" method="post">



                     <div class="bootstrap-timepicker">
                         <div class="form-group">
                             <label style="margin-left: 20px;" class="label-group">Fecha:</label>

                             <div style="margin-top: 10px;" class="input-group date" id="datepicker">
                                 <div style="border:1px solid #f8b604;" class="input-group-addon">
                                     <i class="fa fa-calendar" style="color:#f8b604;"></i>
                                 </div>
                                 <input name="fecha" style="border:1px solid #f8b604;" type="text" class="form-control" id="datepicker2">
                             </div>
                             <!-- /.input group -->
                         </div>
                     </div>
                     <br>
                     <div class="bootstrap-timepicker">
                         <div class="form-group">
                             <label style="margin-left: 20px;" class="label-group">Hora:</label>

                             <div style="margin-top: 10px;" class="input-group date" id="datepicker">
                                 <div style="border:1px solid #f8b604;" class="input-group-addon">
                                     <i class="fa fa-clock-o" style="color:#f8b604;"></i>
                                 </div>
                                 <input data-format="hh:mm:ss" name="hora" id="hora" type="text" class="form-control">
                             </div>
                             <!-- /.input group -->
                         </div>
                     </div>
                     <input type="hidden" name="solicitud_id" value="0" />
                     <input type="hidden" name="tecnico_id" value="0" />

             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-success">Enviar</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

             </div>
             </form>
         </div>

     </div>
 </div>
 <!-- Modal -->
 <div id="myModal3" class="modal fade" role="dialog">
     <div class="modal-dialog modal-sm">

         <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title text-center">Calificar servicio</h4>
             </div>
             <div class="modal-body">
                 <form class="form-inline" enctype="multipart/form-data" method="post" action="<?= site_url('front/calificacion'); ?>" method="post">
                     <div class="form-group">

                         <div class="col-lg-12 text-center">

                             <p class="clasificacion">
                                 <font size="10">
                                     <input id="radio1" type="radio" name="estrellas" value="5">
                                     <label for="radio1">★</label>
                                     <input id="radio2" type="radio" name="estrellas" value="4">
                                     <label for="radio2">★</label>
                                     <input id="radio3" type="radio" name="estrellas" value="3">
                                     <label for="radio3">★</label>
                                     <input id="radio4" type="radio" name="estrellas" value="2">
                                     <label for="radio4">★</label>
                                     <input id="radio5" type="radio" name="estrellas" value="1">
                                     <label for="radio5">★</label>
                                     </front>
                             </p>



                             <input type="hidden" name="solicitud_id" value="0" />
                             <input type="hidden" name="tecnico_id" value="0" />

                         </div>



                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-success">Enviar</button>

                         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>


                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>



 <script>
     $(document).ready(function() {
         setTimeout(function() {
             $(".mensaje").fadeOut(1500);
         }, 3000);

     });
 </script>
 <!-- End scroll to top feature -->
 <script type="text/javascript">
     $(function() {

         //$('#aceptar_visita2').hide();

         // $(".textarea").wysihtml5();
         $("#example1").DataTable({
             "language": {
                 "emptyTable": "No hay Solicitudes disponibles.",
                 "info": "Del _START_ al _END_ de _TOTAL_ ",
                 "infoEmpty": "Mostrando 0 registros de un total de 0.",
                 "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                 "infoPostFix": "(actualizados)",
                 "lengthMenu": "Mostrar _MENU_ registros",
                 "loadingRecords": "Cargando...",
                 "processing": "Procesando...",
                 "search": "Buscar:",
                 "searchPlaceholder": "Dato para buscar",
                 "zeroRecords": "No se han encontrado coincidencias.",
                 "paginate": {
                     "first": "Primera",
                     "last": "Última",
                     "next": "Siguiente",
                     "previous": "Anterior"
                 },
                 "aria": {
                     "sortAscending": "Ordenación ascendente",
                     "sortDescending": "Ordenación descendente"
                 }
             }
         });
         $('label').addClass('form-inline');
         $('select, input[type="search"]').addClass('form-control input-sm');
     });

     function cargar_modal(param, param2) {
         $('input[name=solicitud_id]').val(param);
         $('input[name=tecnico_id]').val(param2);
     }

     function cargar_calificacion(param, param2) {
         $('input[name=solicitud_id]').val(param);
         $('input[name=tecnico_id]').val(param2);
     }

     function cargar_motivo(param, param2) {
         $('input[name=solicitud_id]').val(param);
         $('input[name=tecnico_id]').val(param2);
     }

     function cargar_visita(param, param2) {
         $('#hora').attr('type', 'time');
         var f = new Date();
         cad = f.getHours() + ":" + f.getMinutes();
         $('#hora').val(cad);
         $('input[name=solicitud_id]').val(param);
         $('input[name=tecnico_id]').val(param2);
     }
 </script>
 <script>
     $(function() {
         //Date picker
         $('#datepicker2').datepicker({
             autoclose: true,
         });
     });
 </script>




 <style type="text/css">
     p.clasificacion {

         position: relative;
         overflow: hidden;
         display: inline-block;
     }

     p.clasificacion input {
         position: absolute;
         top: -100px;
     }

     p.clasificacion label {
         float: right;
         color: #333;
     }

     p.clasificacion label:hover,
     p.clasificacion label:hover~label,
     p.clasificacion input:checked~label {
         color: #dd4;
     }


     .date {
         background: none;
     }

     .modal {
         text-align: center;
         padding: 0 !important;
         z-index: 20;
     }

     .modal:before {
         content: '';
         display: inline-block;
         height: 100%;
         vertical-align: middle;
         margin-right: -4px;
     }

     .modal-dialog {
         display: inline-block;
         text-align: left;
         vertical-align: middle;
     }

     .pac-container {
         background-color: #FFF;
         z-index: 20;
         position: fixed;
         display: inline-block;
         float: left;
     }

     .modal-backdrop {
         z-index: 10;
     }
 </style>