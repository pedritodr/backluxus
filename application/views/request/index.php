<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_pedidos_lang'); ?>
            <small><?= translate('listar_pedidos_lang'); ?></small>


        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('listar_pedidos_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('listar_pedidos_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= translate("date_purchase_lang"); ?></th>
                                    <th><?= translate("datos_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_requests as $item) { ?>
                                    <tr>
                                        <td><?= $item->purchase_order; ?></td>
                                        <td><?= $item->date_purchase; ?></td>
                                        <td>
                                            <p> <strong><?= $item->cliente_name; ?></strong>
                                            </p>
                                            <img style="width: 355px; height:100px;" class="img img-rounded img-responsive" src="<?= base_url($item->logo); ?>" />
                                        </td>
                                        <td><?= $item->state; ?></td>


                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li> <a onclick="openModal('<?= $item->request_id; ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> <?= translate("info_order_lang"); ?></a>
                                                    </li>
                                                    <?php if ($item->state == 0) { ?>
                                                        <li><a href="<?= site_url('request/add_buy_request_index/' . $item->request_id); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= translate("registrar_compra_lang"); ?></a></li>
                                                    <?php } ?>
                                                    <?php if ($item->state == 1) { ?>
                                                        <li> <a onclick="openModal2('<?= $item->request_id; ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> <?= translate("info_buy_lang"); ?></a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ($item->state == 1 || $item->state == 2) { ?>
                                                        <li><a href="<?= site_url('request/provider_index/' . $item->request_id); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Factura por fincas</a></li>
                                                    <?php } ?>
                                                    <?php if ($item->state == 2) { ?>
                                                        <li><a href="<?= site_url('request/exportar_factura/' . $item->request_id); ?>"><i class="fa fa-expand" aria-hidden="true"></i>Exportar factura</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("purchase_order_lang"); ?></th>
                                    <th><?= translate("date_purchase_lang"); ?></th>
                                    <th><?= translate("datos_lang"); ?></th>
                                    <th><?= translate("state_lang"); ?></th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel"><?= translate("purchase_lang"); ?></h4>
            </div>
            <div id="imp1" class="modal-body">
                <div class='row'>
                    <div class='col-lg-12'>
                        <div class="col-lg-offset-1 col-lg-3 col-lg-offset-1">
                            <img id="logo_cliente" style="width: 355px; height:100px;" class="img img-rounded img-responsive" src="" />
                            <p id="cliente_name"></p>

                            <h4 class="modal-title text-left" id="myModalLabel"><strong><?= translate("purchase_lang"); ?></strong></h4>
                            <div style=" background-color: #f4f4f4;">
                                <strong><?= translate("date_reception_lang"); ?>:</strong>
                                <p id="fecha_recepcion"></p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-lg-offset-4">
                            <div style=" background-color: #f4f4f4;" class="text-left">
                                <p id="nro_orden">
                                </p>

                                <p id="fecha_pedido"></p>
                            </div>
                            <br>
                            <div style=" background-color: #f4f4f4;" class="text-left">
                                <strong><?= translate("shipping_address_lang"); ?>:</strong>
                                <p id="direccion"></p>
                            </div>

                        </div>

                    </div>
                </div>
                <div class='row'>
                    <div id='cartContentsModal' class="col-sm-12 col-md-10 col-md-offset-1 table-responsive">

                        <table id="tabla" class="table">
                            <thead>
                                <tr>
                                    <th style="width:auto;">Variedad</th>
                                    <th style="width:auto;">Unidad</th>
                                    <th style="width:130px;" class="text-center">Tipo de caja</th>
                                    <th class="text-center">Destino</th>
                                    <th style="width:100px;">Marcación</th>
                                    <th>Cantidad</th>
                                    <th style="width:130px;">Precio por unidad</th>
                                    <th style="width:100px;">Total precio</th>

                                </tr>
                            </thead>
                            <tbody id="cuerpo">


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>


                                    <td>
                                        <strong>
                                            <h4>Total</h4>
                                        </strong>

                                        <h3 id="totales"></h3>
                                    </td>
                                    <td class="text-right">

                                    </td>
                                </tr>
                                <tr>


                                </tr>
                            </tfoot>
                        </table>















                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <form method="post" action="<?php echo base_url(); ?>request/export_pdf">
                    <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                    <input name="id2" id="id2" class="btn btn-primary" type="hidden" value="">
                    <input type="submit" name="export" class="btn btn-success" value="Export" />
                </form>
            </div>


        </div>
    </div>
</div>

<!--fin del modal detalles modal-->



<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title text-center" id="titulo_po"></h4>

            </div>
            <div id="imp2" class="modal-body">

                <div id="reporte" class='row'>


                    <div class="col-lg-12">
                        <table class="table " id="tblData">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>


                                </tr>
                                <tr>
                                    <th>FINCA</th>
                                    <th>VARIEDAD</th>
                                    <th>MEDIDA</th>
                                    <th>CAJAS</th>
                                    <th>TIPO DE CAJA</th>
                                    <th>TALLOS</th>
                                    <th>MARCACION</th>
                                    <th>DESTINO</th>


                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla">
                                <tr id="fila_compra">
                                    <td id="finca"></td>
                                    <td id="variedad"></td>
                                    <td id="medida"></td>
                                    <td id="cajas"></td>
                                    <td id="tipo"></td>
                                    <td id="tallos"></td>
                                    <td id="marcacion"></td>
                                    <td id="destino"></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td id="total">
                                        totales
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <form method="post" action="<?php echo base_url(); ?>request/export_excel">
                    <button onclick="cerrar2()" type="button" class="btn btn-default">Cerrar</button>
                    <input name="id" id="id" class="btn btn-primary" type="hidden" value="">
                    <input type="submit" name="export" class="btn btn-success" value="Export" />
                </form>
            </div>


        </div>
    </div>
</div>

<!--fin del modal detalles modal-->



<script>
    function imprim1(imp1) {
        var contenido = document.getElementById('imp1').innerHTML;
        var contenidoOriginal = document.body.innerHTML;

        document.body.innerHTML = contenido;

        window.print();
        window.focus();
        document.body.innerHTML = contenidoOriginal;
    }
    $(function() {
        $("#example1").DataTable();

    });

    function cerrar() {

        $("#myModal").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function cerrar2() {

        $("#myModal2").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function openModal2(id) {

        $('input[name=id]').val(id);
        var total = 0;
        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='finca'></td> <td id='variedad'></td> <td id='medida'></td><td id='cajas'></td><td id='tipo'></td><td id='tallos'></td> <td id='marcacion'></td><td id='destino'></td></tr>");
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_all_buy') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#titulo_po').html("<strong>" + result[0].purchase_order + "</strong>");

                for (var i = 0; i < result.length; i++) {

                    // console.log(result.productos.productos[i]);
                    var new_per = $('#fila_compra').clone();


                    $(new_per).find('#finca').text(result[i].name);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#variedad').text(result[i].product);
                    $(new_per).find('#medida').text(result[i].measure);
                    $(new_per).find('#cajas').text(result[i].qty_buy);
                    $(new_per).find('#tipo').text(result[i].box_type);
                    $(new_per).find('#tallos').text(result[i].total_steams);
                    $(new_per).find('#marcacion').text(result[i].dialing);
                    $(new_per).find('#destino').text(result[i].destination);





                    total = total + parseInt(result[i].qty_buy);
                    $('#cuerpo_tabla').append(new_per);
                    $('#fila_compra_' + i).show();
                }
                $('#fila_compra').hide();
                $('#total').text("TOTAl: " + total + " CAJAS");

            }
        });

    }

    function openModal(id) {

        $('input[name=id2]').val(id);

        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });



        $('#cuerpo').html("<tr id='fila' style='background-color: #f4f4f4;'><td><div class='media'><a class='thumbnail pull-left'><img class='media-object' src='' style='width: 72px; height: 72px;'></a><div class='media-body'><h4 class='media-heading'><a id='nombre'></a></h4><h5 class='media-heading' id='descripcion'></h5></div></div></td><td style='text-align: center'><strong id='unidad'></strong></td><td style='text-align: center'><strong id='tipo'></strong></td><td style='text-align: center'><strong id='destino'></strong></td><td><strong id='subport'></strong></td><td style='text-align: center'><strong id='cantidad'></strong></td><td class='text-center'><strong id='precio'></strong></td><td class='text-center'><strong id='sub'></strong></td></tr>");

        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/get_all') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);


                $('#logo_cliente').attr('src', "<?= base_url('assets/login.png'); ?>");
                $('#fecha_recepcion').html(result[0].date_time_reception);
                $('#cliente_name').html(result[0].cliente_name);
                $('#nro_orden').html("<strong><?= translate('purchase_order_lang'); ?>:</strong>" + " " + result[0].purchase_order);
                $('#fecha_pedido').html("  <strong><?= translate('date_purchase_lang'); ?>:</strong>" + " " + result[0].date_purchase);
                $('#direccion').html(result[0].address);


                for (var i = 0; i < result.length; i++) {

                    var new_per = $('#fila').clone();

                    //$(new_per).attr('id', products[i].variety_id);
                    $(new_per).find('#nombre').text(result[i].name + " " + result[i].measure);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#cantidad').text(result[i].box.qty);
                    $(new_per).find('#sub').text("$" + result[i].total_price);
                    $(new_per).find('#precio').text("$" + result[i].unit_price);
                    $(new_per).find('#destino').text(result[i].destination);
                    $(new_per).find('#subport').text(result[i].dialing);
                    $(new_per).find('#tipo').text(result[i].box.name);
                    $(new_per).find('#unidad').text("PACK " + result[i].total_steams);



                    $(new_per).find('img').attr('src', '<?= base_url() ?>' + result[i].photo);


                    total = total + (parseFloat(result[i].total_price));
                    $('#cuerpo').append(new_per);
                    $('#fila_' + i).show();
                }
                $('#fila').hide();
                $('#totales').text("$" + total);

            }
        });

    }
</script>

<style class="cp-pen-styles">
    #modal_ancho {
        width: 80% !important;
    }
</style>