<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('manage_pedidos_lang'); ?>
            <small><?= translate('listar_pedidos_lang'); ?></small>
            | <a href="<?= site_url('request/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>

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
                                    <th>PO</th>
                                    <th>Finca</th>
                                    <th>Datos del pedido</th>
                                    <th><?= translate("actions_lang"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_request as $item) { ?>
                                    <tr>
                                        <td><?= $item->purchase_order; ?></td>
                                        <td><?= $item->name; ?></td>
                                        <td>
                                            <?php foreach ($item->provider as $provider) { ?>
                                                <p> <strong>Variedad</strong> <?= $provider->product; ?><br>
                                                    <strong>Medida/Peso</strong> <?= $provider->measure; ?><br>
                                                </p>
                                            <?php } ?>

                                        </td>



                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Acciones <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <!-- <li> <a onclick="openModal2('<?= $item->provider_id; ?>')" style="cursor:pointer;"><i class="fa fa-info"></i> Confirmar factura</a>
                                                                                                    </li>-->
                                                    <?php if ($item->invoice_provider == NULL) { ?>
                                                        <li><a href="<?= site_url('request/confirmar_factura/' . $item->request_id); ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Confirmar factura</a></li>
                                                    <?php } else { ?>
                                                        <li><a href="<?= site_url('request/exportar_factura_provider/' . $item->provider_id . '/' . $item->buy_id); ?>"><i class="fa fa-info" aria-hidden="true"></i> Exportar factura</a></li>

                                                    <?php } ?>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>PO</th>
                                    <th>Finca</th>
                                    <th>Datos del pedido</th>
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
                                    <th id="finca"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>



                                </tr>
                                <tr>
                                    <th>FECHA DE COMPRA</th>
                                    <th>VARIEDAD</th>
                                    <th>MEDIDA</th>
                                    <th>TALLOS</th>
                                    <th>NRO DE CAJAS</th>
                                    <th>PRECIO</th>
                                    <th>TOTAL</th>
                                    <th><?= translate("actions_lang"); ?></th>

                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla">
                                <tr id="fila_compra">
                                    <td id="fecha"></td>
                                    <td id="variedad"></td>
                                    <td id="medida"></td>
                                    <td id="tallos"></td>
                                    <td id="cajas"><input id="qty_box" type="number" step="any" class="form-control input-sm" style="width:120px;" name="qty_box" min="1" pattern="^[1-9]+" placeholder="Cantidad de cajas"></td>

                                    <td id="precio"><input id="precio" type="number" step="any" class="form-control input-sm" style="width:120px;" name="precio" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                                    </td>
                                    <td id="total"></td>
                                    <td id="botones"><a id="editar" href="" class="btn btn-info"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></a></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>


                                    <td></td>
                                    <td></td>
                                    <td id="total_precios">

                                    </td>


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

        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='fecha'></td> <td id='variedad'></td> <td id='medida'></td><td id='tallos'></td><td id='cajas'><input id='qty_box' type='number' step='any' class='form-control input-sm' style='width:120px;' name='qty_box' min='1' pattern='^[1-9]+' placeholder='Cantidad de cajas'></td><td id='precio'><input id='precio' type='number' step='any' class='form-control input-sm' style='width:120px;' name='precio' min='1' pattern='^[1-9]+' placeholder='<?= translate('precio_lang'); ?>'></td><td id='total'></td><td id='botones'><a id='editar' href='' class='btn btn-info'><i class='fa fa-edit'></i> <?= translate('edit_lang'); ?></a></td></tr>");
        $.ajax({
            type: 'POST',
            url: "<?= site_url('request/confirmar_factura') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                $('#titulo_po').html("<strong>" + result[0].purchase_order + "</strong>");
                $('#finca').html("<strong>Finca: </strong><p style='text-transform: uppercase;'>" + result[0].provider + "</p> ");

                for (var i = 0; i < result.length; i++) {


                    var new_per = $('#fila_compra').clone();


                    // $(new_per).find('#finca').text(result[i].name);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#fecha').text(result[i].date);
                    $(new_per).find('#variedad').text(result[i].variety);
                    $(new_per).find('#medida').text(result[i].measure);
                    $(new_per).find('#qty_box').val(result[i].qty);
                    $(new_per).find('#precio').val(result[i].price);
                    $(new_per).find('#tallos').text(result[i].total_steams);
                    $(new_per).find('#editar').attr("onclick", "update('" + result[i].qty + "')");
                    let result_price = result[i].price * result[i].qty;
                    $(new_per).find('#total').text(result_price);






                    total = total + parseInt(result_price);
                    $('#cuerpo_tabla').append(new_per);
                    $('#fila_compra_' + i).show();
                }
                $('#fila_compra').hide();
                $('#total_precios').html("<p>total:<strong>" + total + "</strong></p>");

            }
        });

    }

    function update(id) {
        $('#myModal2').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#cuerpo').remove();
        $('#cuerpo_tabla').html("<tr id='fila_compra'> <td id='fecha'></td> <td id='variedad'></td> <td id='medida'></td><td id='tallos'></td><td id='cajas'><input id='qty_box' type='number' step='any' class='form-control input-sm' style='width:120px;' name='qty_box' min='1' pattern='^[1-9]+' placeholder='Cantidad de cajas'></td><td id='precio'><input id='precio' type='number' step='any' class='form-control input-sm' style='width:120px;' name='precio' min='1' pattern='^[1-9]+' placeholder='<?= translate('precio_lang'); ?>'></td><td id='total'></td><td id='botones'><a id='editar' href='' class='btn btn-info'><i class='fa fa-edit'></i> <?= translate('edit_lang'); ?></a></td></tr>");

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
                console.log(result);

                $('#logo_cliente').attr('src', '<?= base_url() ?>' + result[0].logo);
                $('#fecha_recepcion').html(result[0].date_time_reception);
                $('#cliente_name').html(result[0].cliente_name);
                $('#nro_orden').html("<strong><?= translate('purchase_order_lang'); ?>:</strong>" + " " + result[0].purchase_order);
                $('#fecha_pedido').html("  <strong><?= translate('date_purchase_lang'); ?>:</strong>" + " " + result[0].date_purchase);
                $('#direccion').html(result[0].address);


                for (var i = 0; i < result.length; i++) {
                    // console.log(result.productos.productos[i]);
                    var new_per = $('#fila').clone();

                    //$(new_per).attr('id', products[i].variety_id);
                    $(new_per).find('#nombre').text(result[i].name + result[i].measure.measure);
                    // $(new_per).find('#descripcion').html(products[i].descripcion);
                    $(new_per).find('#cantidad').text(result[i].box.qty);
                    $(new_per).find('#sub').text("$" + result[i].total_price);
                    $(new_per).find('#precio').text("$" + result[i].unit_price);
                    $(new_per).find('#destino').text(result[i].destination);
                    $(new_per).find('#subport').text(result[i].dialing);
                    $(new_per).find('#tipo').text(result[i].box.name + " máximo de items " + result[i].box.max_number_of_item);
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