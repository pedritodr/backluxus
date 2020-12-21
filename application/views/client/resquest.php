<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/dist/css/AdminLTE.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>admin_lte/plugins/daterangepicker/daterangepicker.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('realizar_pedido_lang'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('realizar_pedido_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">

                <div class="box box-default">
                    <div class="box-body">
                        <div class="mensaje">
                            <?= get_message_from_operation(); ?>
                        </div>


                        <div class="row">
                            <div class="col-lg-9 col-xs-12">
                                <div class="row">
                                    <div class="row">

                                        <div class="col-lg-offset-1 col-lg-3 col-xs-offset-1 col-xs-7">
                                            <form action="<?= site_url('client/pedido_index'); ?>" method="POST" class="form-vertical" role="form">

                                                <label>Buscar por <?= translate("categories_lang"); ?></label>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-addon"><i class="fa fa-thumb-tack"></i></span>
                                                    <select id="category" name="category" class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">
                                                        <option value="0">Seleccione una opción</option>

                                                        <?php
                                                        if (isset($all_product_category))
                                                            foreach ($all_product_category as $item) { ?>
                                                            <option value="<?= $item->product_category_id; ?>"><?= $item->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <button style="margin-top:22px" type="submit" class="btn btn-warning"><i class="fa fa-search"></i> <?= translate('buscar_lang'); ?></button>

                                        </div>
                                        </form>

                                        <div class="col-lg-3 col-xs-offset-1 col-xs-7">

                                            <label> <?= translate("clientes_lang"); ?></label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-addon"><i class="fa fa-users" aria-hidden="true"></i></span>
                                                <select id="clientes" name="clientes" class="form-control" data-placeholder="Seleccione una opción" style="width: 100%">
                                                    <option value="0">Seleccione una opción</option>

                                                    <?php
                                                    if (isset($all_clientes))
                                                        foreach ($all_clientes as $item) { ?>
                                                        <option value="<?= $item->cliente_id; ?>"><?= $item->cliente_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.shopping -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                                    <h1>Productos</h1>
                                    <div class="row">
                                        <?php foreach ($all_products as $item) { ?>
                                            <div class="col-xs-12 col-md-6 col-lg-4 item">
                                                <div class='img-container'>
                                                    <button id="<?= $item->product_id; ?>" onclick="add_to_modal('<?= $item->product_id; ?>','<?= $item->name; ?>','<?= $item->photo; ?>','<?= $item->stems_bunch; ?>')" class="btn btn-success btn-add-cart" data-toggle="modal" data-target="#cantModal"><span class=" glyphicon glyphicon-shopping-cart"></span> añadir</button>
                                                    <img src="<?= base_url($item->photo); ?>">
                                                </div>
                                                <h5><?= $item->name; ?></h5>
                                                <h6 style="display:none"><?= $item->descriptions; ?></h6>
                                                <h4 style="display:none"><?= $item->product_id; ?></h4>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div id='cart-container' data-spy="affix" data-offset-top="10">
                                        <h1><span class="glyphicon glyphicon-shopping-cart"></span> compras<span class="badge" id='cartItems'></span></h1>
                                        <div class="cart" id='cart'>
                                            Tan solo aquí, añade algo.
                                        </div>
                                        <div id='prices'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="cantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center" id="exampleModalLabel">Detalles</h3>


            </div>
            <div class="modal-body">

                <div id="todo" class="form-group">
                    <p style="display:none" id="product_id"></p>
                    <p style="display:none" id="variety_id"></p>

                    <img style="margin-left:60px; width: 150px;height: 160px" class="img img-rounded img-responsive" id="photo" src="" alt="">
                    <h4 class="text-center" id="name"></h4>
                    <h6 id="nunit" class="text-center" id="nunit"></h6>
                    <p class="text-center"> <strong>Stems bunch: </strong></p>
                    <p class="text-center" id="descriptions"></p>
                    <input name="variety_id" id="" class="btn btn-primary" type="hidden" value="">

                    <label id="titulo_variety" style="display:none;"><?= translate("measure_lang"); ?></label>
                    <div id="cuerpo_variety" style="display:none;" class="input-group">



                    </div>
                    <label>Bunches</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="bunchesModal" type="number" step="any" class="form-control input-sm" name="bunchesModal" min="1" pattern="^[1-9]+" placeholder="Bunches">
                    </div>


                    <label>Precio</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="precioModal" type="number" step="any" class="form-control input-sm" name="precioModal" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">
                    </div>

                    <label>Cantidad de cajas</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input id="cantidadModal" type="number" step="any" class="form-control input-sm" name="cantidadModal" min="1" pattern="^[1-9]+" placeholder="<?= translate('cant_lang'); ?>">
                    </div>


                    <label><?= translate("type_box_lang"); ?></label>
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                        <select id="tipo" name="tipo" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            <option value="0">Seleccione una opción</option>

                            <?php
                            if (isset($all_type_box))
                                foreach ($all_type_box as $item) { ?>
                                <option value="<?= $item->box_type_id; ?>"><?= $item->name; ?></option>
                            <?php } ?>
                        </select>

                    </div>






                    <label id="titulo_marcacion" style="display:none;"><?= translate("subport_lang"); ?></label>
                    <div id="cuerpo_marcacion" style="display:none;" class="input-group">

                    </div>

                    <label id="titulo" style="display:none;">Destino:</label>
                    <label id="destino">
                    </label><br>
                    <label id="titulo_carguera" style="display:none"><?= translate("load_lang"); ?></label>
                    <div class="input-group" id="cuerpo_carguera" style="display:none">
                        <span class="input-group-addon"><i class="fa fa-train"></i></span>
                        <select id="carguera" name="carguera" class="form-control input-sm" data-placeholder="Seleccione una opción" style="width: 100%">
                            <option value="0">Seleccione una opción</option>

                            <?php
                            if (isset($all_cargueras))
                                foreach ($all_cargueras as $item) { ?>
                                <option value="<?= $item->carguera_id; ?>"><?= $item->name; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <br>
                    <label id="dialing" style="display:none;"></label>
                    <label id="cliente" style="display:none;"></label>
                    <label>Total Steams:</label>
                    <label>
                        <h5 id="total_tallos"></h5>
                    </label><br>
                    <label>Total:</label>
                    <label>
                        <h5 id="total"></h5>
                    </label>$<br>

                </div>

            </div>
            <div class="modal-footer">
                <button id="add" type="button" class="btn btn-success btn-add"><span class=" glyphicon glyphicon-shopping-cart"></span> Añadir</button>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" id="modal_ancho" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Detalles de la orden</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-xs-12'> </div>
                </div>
                <div class='row'>
                    <div id='cartContentsModal' class="col-sm-12 col-md-10 col-md-offset-1 table-responsive">

                        <table id="tabla" class="table">
                            <thead>
                                <tr>
                                    <th style="width:auto;">Variedad</th>
                                    <th style="width:auto;">Unidad</th>
                                    <th style="width:150px;">Tipo de caja</th>
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
                        <h4 class="modal-title text-center">Detalles de la compra</h4>

                        <form id="formulario" enctype="multipart/form-data">


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label><?= translate("purchase_order_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </span>
                                                <input type="text" class="form-control input-sm" name="purchase" placeholder="<?= translate('purchase_order_lang'); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label><?= translate("date_purchase_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
                                                <input type="date" class="form-control input-sm" name="date_purchase" required placeholder="<?= translate('date_delivery_lang'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label><?= translate("date_vuelo_lang"); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                </span>
                                                <input type="date" class="form-control input-sm" name="date_reception" required placeholder="<?= translate('date_reception_lang'); ?>">
                                            </div>
                                        </div>

                                    </div>


                                </div>


                            </div>
                            <br>









                    </div>
                </div>
            </div>
            <div class="modal-footer centered">
                <button onclick="cerrar()" type="button" class="btn btn-default">Cerrar</button>
                <button type="submit" class="btn btn-primary" id='enviar_request'>Enviar</button>
            </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".mensaje").fadeOut(1500);
        }, 3000);
    });
    $(function() {
        //$("#example1").DataTable();
        $(".textarea").wysihtml5();
        $(".select2").select2();


    });
</script>

<!-- Select2 -->
<script src="<?= base_url(); ?>admin_lte/plugins/select2/select2.full.min.js"></script>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script>
    var total_bunches = 0;
    $("#cantidadModal").change(function() {

        var cant = $('input[name=cantidadModal]').val();
        var price = $('input[name=precioModal]').val();
        var total = (cant * price);

        $('#total').text(total);
    });
    $("#precioModal").change(function() {

        var cant = $('input[name=cantidadModal]').val();
        var price = $('input[name=precioModal]').val();
        var total = (cant * price);

        $('#total').text(total);
    });
    $("#bunchesModal").change(function() {

        var bunches = $('input[name=bunchesModal]').val();

        total_bunches = (bunches * steams_bunch);

        $('#total_tallos').text(total_bunches);
    });
    var steams_bunch = 0;
    var itemsInCart = 0;
    var subTotal = 0;
    const tax = 0; // 10%
    var totalPrice = 0;
    var arreglo = [];
    var products = [];
    var cart = [];
    var cadena = "";
    var cadena2 = "";
    var destination = [];
    var type_box = [];
    $("select[name=clientes]").change(function() {
        var all_products = <?= json_encode($all_products); ?>;
        if ($("select[name=clientes]").val() == 0) {
            $('#errorModal').modal('show');
            $('#mensaje_error').html("Seleccione una cliente para comenzar");
            $('#aceptar_error').on("click", function() {
                $('select[name=cliente]').focus();
                $('#errorModal').modal('hide');
            });
            for (var i = 0; i < all_products.length; i++) {
                $('#' + all_products[i].product_id).attr("disabled", true);

            }
        } else {

            for (var i = 0; i < all_products.length; i++) {
                $('#' + all_products[i].product_id).attr("disabled", false);

            }
        }


    });

    window.onload = function() {
        var all_products = <?= json_encode($all_products); ?>;
        for (var i = 0; i < all_products.length; i++) {
            $('#' + all_products[i].product_id).attr("disabled", true);

        }

        $('img').addClass('img-responsive');

        //  $('.img-container').append('<button id="" class="btn btn-success btn-add-cart"><span class="glyphicon glyphicon-shopping-cart"></span> añadir</button>');



        $('.btn-add').click((e) => {



            if ($("select[name=variety]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione una medida");
                $('#aceptar_error').on("click", function() {
                    $('select[name=variety]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($('input[name=bunchesModal]').val() == "") {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("El campo bunches no puede estar vacio");
                $('#aceptar_error').on("click", function() {
                    $('input[name=bunchesModal]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($('input[name=precioModal]').val() == "") {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("El campo precio no puede estar vacio");
                $('#aceptar_error').on("click", function() {
                    $('input[name=precioModal]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($('input[name=cantidadModal]').val() == "") {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("El campo cantidad no puede estar vacio");
                $('#aceptar_error').on("click", function() {
                    $('input[name=cantidadModal]').focus();
                    $('#errorModal').modal('hide');
                });

            } else if ($("select[name=tipo]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione un tipo de caja");
                $('#aceptar_error').on("click", function() {
                    $('select[name=tipo]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($("select[name=marcacion]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione una marcación");
                $('#aceptar_error').on("click", function() {
                    $('select[name=marcacion]').focus();
                    $('#errorModal').modal('hide');
                });
            } else if ($("select[name=carguera]").val() == 0) {
                $('#errorModal').modal('show');
                $('#mensaje_error').html("Seleccione una carguera");
                $('#aceptar_error').on("click", function() {
                    $('select[name=carguera]').focus();
                    $('#errorModal').modal('hide');
                });
            } else {

                //animation
                $(e.target).animateCss('pulse');
                // find out which item is clicked
                // if 'span' with cart symbol is clicked, then navigate one level up to the button
                let eventTarget;
                if ($(e.target).is('span')) eventTarget = $(e.target).parent();
                else eventTarget = $(e.target);
                let itemName = eventTarget.parent().parent().find('h4')[0].textContent;
                // let itemPrice = eventTarget.parent().parent().find('h5')[0].textContent;
                // let nunit = eventTarget.parent().parent().find('h6')[0].textContent;
                // let description = eventTarget.parent().parent().find('h1')[0].textContent;
                let photo = eventTarget.parent().parent().find('img').attr('src');
                let itemId = eventTarget.parent().parent().find('#product_id')[0].textContent;

                var cant = $('input[name=cantidadModal]').val();
                var price = $('input[name=precioModal]').val();
                var nunit = $('input[name=bunchesModal]').val();

                var dialing_id = $('select[name=marcacion]').val();
                var cliente_id = $('select[name=clientes]').val();

                var tipo_id = $('select[name=tipo]').val();
                var variety_id = $('input[name=variety_id]').val();

                var dialing_name = $('#marcacion option:selected').text();


                var tipo_name = $('#tipo option:selected').text();
                var measure = $('#variety option:selected').text();
                var variety_measure_id = $('#variety option:selected').val()
                var port_name = $('#port option:selected').text();
                //   add_to_modal(itemName, itemPrice, itemId);
                // $('#' + itemId).attr("disabled", true);

                //$('#' + itemId).text("Añadido");
                // $('input[name=cantidadModal]').val(1);
                var destino_name = $('#destino').text();
                var dialing = $('#dialing').text();
                var sub_total = $('#total').text();

                addToCart(itemName, itemId, variety_measure_id, measure, total_bunches, cant, price, photo, tipo_id, tipo_name, dialing_id, dialing_name, variety_id, sub_total, destino_name, dialing, nunit, cliente_id);

                $("#cantModal").modal('hide'); //ocultamos el modal
                $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
                $("#cantModal").find("select").val('').end();
                $("#cantModal").find("#titulo_destino").hide();
                $("#cantModal").find("#cuerpo_destino").hide();
                $("#cantModal").find("#titulo").hide();
                $("#cantModal").find("#port").hide();
                $("#cantModal").find("#sub").hide();
            }

        });

        /*  $('#add').click(() => {
              formSubmitted();
          });*/

    }

    function cancelar() {
        location.reload();
    }

    function add_to_modal(id, name, photo, bunch) {
        steams_bunch = bunch;
        $('#product_id').text("");
        $('#total').text("");

        $('#name').text("");
        $('#descriptions').text("");
        $('#cantidadModal').val("");
        $('#precioModal').val("");
        $('#bunchesModal').val("");

        $("select[name=tipo]").val(0);
        $('#titulo_marcacion').hide();
        $('#cuerpo_marcacion').hide();
        $('#titulo').hide();
        $('#destino').hide();

        $('#product_id').text(id);


        //  $('#price').text(price);
        $('#name').text(name);
        //  $('#total').text(price);
        $('#descriptions').text(bunch);
        //$('#nunit').text(nunit);
        //  $("#photo").attr('src', '<?= base_url() ?>' + photo);
        $('#titulo_variety').show();

        $('#cuerpo_variety').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('client/get_variety_by_product') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);

                var opcion = "Seleccione una opción";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-tags' aria-hidden='true'></i></i></span><select id='variety' name='variety' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";
                for (let i = 0; i < result.length; i++) {
                    cadena = cadena + "<option value='" + result[i].product_measure_id + "'>" + result[i].measure + "</option>";
                }
                cadena = cadena + "</select>"
                // console.log(cadena);
                //  $('subport').html(cadena);


                $('#cuerpo_variety').html(cadena);
                $('#name').text(result.name);

                $('input[name=variety_id]').val(id);

                $("#photo").attr('src', '<?= base_url() ?>' + photo);
            }
        });


    }
    $(".modal-body").bind("click", function() {
        $("select[name=marcacion]").select(0);
        $("select[name=variety]").select(0);


        $("select[name=marcacion]").change(function() {
            var id = $("select[name=marcacion]").val();

            $.ajax({
                type: 'POST',
                url: "<?= site_url('client/get_destination_by_id') ?>",
                data: {
                    id: id
                },
                success: function(result) {
                    result = JSON.parse(result);
                    $('#titulo').show();
                    $('#destino').show();
                    $('#dialing').html(result['dialing']);
                    $('#destino').html(result['name']);

                }
            });
        });



    });








    function addToCart(itemName, itemId, variety_measure_id, measure, total_bunches, cant, price, photo, tipo_id, tipo_name, dialing_id, dialing_name, variety_id, sub_total, destino_name, dialing, nunit, cliente_id) {

        let priceNumber = parseFloat(sub_total);
        var sub = sub_total;
        if (itemsInCart === 0) $('#cart').text(" ");
        let newDiv = $('<div class="cart-item"></div>');
        newDiv.text(cant + 'x' + price + '  ' + itemName + ' ' + measure + ' ' + '  subTotal  ' + sub_total + ' ');
        newDiv.append('<button class="btn btn-danger btn-xs" onclick="deleteItem(this)">X</button>');
        newDiv.append('<hr>');
        newDiv.attr('name', itemName);
        newDiv.attr('price', price);
        newDiv.attr('product_id', itemId);
        newDiv.attr('cant', cant);
        newDiv.attr('sub_total', priceNumber);
        newDiv.attr('photo', photo);
        newDiv.attr('tipo_id', tipo_id);
        newDiv.attr('tipo_name', tipo_name);
        newDiv.attr('dialing_id', dialing_id);
        newDiv.attr('dialing_name', dialing_name);
        newDiv.attr('total_bunches', total_bunches);
        newDiv.attr('variety_id', variety_id);
        newDiv.attr('destino', destino_name);
        newDiv.attr('dialing', dialing);
        newDiv.attr('qty_bunches', nunit);
        newDiv.attr('cliente_id', cliente_id);
        newDiv.attr('subtotal', sub);
        newDiv.attr('measure', measure);
        newDiv.attr('variety_measure_id', variety_measure_id);





        $('#cart').append(newDiv);
        newDiv.animateCss('bounceInRight');
        itemsInCart++;
        $('#cartItems').text(itemsInCart);
        subTotal += priceNumber;
        newDiv.attr('total', subTotal);



        updatePrice();
    }

    function deleteItem(e) {
        let price = $(e.parentElement).attr('price');
        let id = $(e.parentElement).attr('product_id');

        subTotal -= price;
        $(e.parentElement).animateCss('bounceOutRight');
        $(e.parentElement).remove();
        itemsInCart--;
        $('#cartItems').text(itemsInCart);
        updatePrice();
        cartLonelyText();

        //  $('#' + id).attr("disabled", false);

    }


    function cartLonelyText() {
        if (itemsInCart === 0)
            $('#cart').append('Tan solo aquí, añade algo.');
    }

    function updatePrice() {
        $('#prices').empty();
        if (itemsInCart === 0) return;
        let newDiv = $('<div></div>');
        newDiv.append('<strong>Total: $' + (subTotal).toFixed(2) + '</strong>');

        newDiv.append('<button class="btn btn-info btn-block" onclick="openModal()">Continue</button>');
        newDiv.append('<button class="btn btn-warning btn-block" onclick="cancelar()" >Cancelar</button>');

        $('#prices').append(newDiv);
        newDiv.animateCss('bounceInRight');
    }


    function cartToString() {
        arreglo.length = 0;

        let cartItems = document.querySelectorAll('.cart-item');
        for (let i = 0; i < cartItems.length; i++) {

            arreglo.push({
                "product_id": cartItems[i].getAttribute('product_id'),
                "variety_measure_id": cartItems[i].getAttribute('variety_measure_id'),
                "qty_bunches": cartItems[i].getAttribute('qty_bunches'),
                "measure": cartItems[i].getAttribute('measure'),
                "nombre": cartItems[i].getAttribute('name'),
                "destino": cartItems[i].getAttribute('destino'),
                "cantidad": cartItems[i].getAttribute('cant'),
                "precio": cartItems[i].getAttribute('price'),
                "foto": cartItems[i].getAttribute('photo'),
                "subtotal": cartItems[i].getAttribute('subtotal'),
                "tipo_id": cartItems[i].getAttribute('tipo_id'),
                "tipo_name": cartItems[i].getAttribute('tipo_name'),
                "dialing_id": cartItems[i].getAttribute('dialing_id'),
                "dialing_name": cartItems[i].getAttribute('dialing_name'),
                "dialing": cartItems[i].getAttribute('dialing'),
                "total": cartItems[i].getAttribute('total'),
                "total_bunches": cartItems[i].getAttribute('total_bunches'),
                "cliente_id": cartItems[i].getAttribute('cliente_id'),

            });

        }

        return arreglo;
    }

    function openModal() {
        var total = 0;
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        type_box = <?= json_encode($all_type_box); ?>;
        destination = <?= json_encode($all_destinations); ?>;
        products = cartToString();


        $('#cuerpo').html("<tr id='fila'><td><div class='media'><a class='thumbnail pull-left'><img class='media-object' src='' style='width: 72px; height: 72px;'></a><div class='media-body'><h4 class='media-heading'><a id='nombre'></a></h4><h5 class='media-heading' id='descripcion'></h5></div></div></td><td style='text-align: center'><strong id='unidad'></strong></td><td style='text-align: center'><strong id='tipo'></strong></td><td style='text-align: center'><strong id='destino'></strong></td><td><strong id='subport'></strong></td><td style='text-align: center'><strong id='cantidad'></strong></td><td class='text-center'><strong id='precio'></strong></td><td class='text-center'><strong id='sub'></strong></td></tr>");


        for (var i = 0; i < products.length; i++) {
            // console.log(result.productos.productos[i]);
            var new_per = $('#fila').clone();

            //$(new_per).attr('id', products[i].variety_id);
            $(new_per).find('#nombre').text(products[i].nombre + " " + products[i].measure);
            // $(new_per).find('#descripcion').html(products[i].descripcion);
            $(new_per).find('#cantidad').text(products[i].cantidad);
            $(new_per).find('#sub').text("$" + products[i].subtotal);
            $(new_per).find('#precio').text("$" + products[i].precio);
            $(new_per).find('#destino').text(products[i].destino);
            $(new_per).find('#subport').text(products[i].dialing);
            $(new_per).find('#tipo').text(products[i].tipo_name);
            $(new_per).find('#unidad').text("PACK " + products[i].total_bunches);



            $(new_per).find('img').attr('src', products[i].foto);

            total = total + (parseFloat(products[i].subtotal));
            $('#cuerpo').append(new_per);
            $('#fila_' + i).show();
        }
        $('#fila').hide();

        $('#myModal').modal('show');
        $('#totales').text("$" + total);

    }


    function cerrar() {
        $("#myModal").modal('hide'); //ocultamos el modal
        $("#fila").empty();
        $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal        //  .modal('remove')
        //    $('#fila').clone()

    }

    function obtener_datos() {

        cart = cartToString();
        tipo = $('#tipo').val();
        alert(tipo);
    }



    $("select[name=tipo]").change(function() {
        var id = $('#clientes').val();

        $('#titulo_marcacion').show();

        $('#cuerpo_marcacion').show();

        $('#titulo_carguera').show();

        $('#cuerpo_carguera').show();
        $.ajax({
            type: 'POST',
            url: "<?= site_url('client/get_marcacion') ?>",
            data: {
                id: id
            },
            success: function(result) {
                result = JSON.parse(result);
                var opcion = "Seleccione la marcación";
                var value = "0";
                cadena = "<span class='input-group-addon'><i class='fa fa-map-marker'></i></span><select id='marcacion' name='marcacion' class='form-control input-sm'  style='width: 100%'>";
                cadena = cadena + "<option value=" + value + ">" + opcion + "</option>";
                for (let i = 0; i < result.length; i++) {
                    cadena = cadena + "<option value='" + result[i].dialing_id + "'>" + result[i].name + " Destino:" + result[i].destination + "</option>";
                }
                cadena = cadena + "</select>"
                // console.log(cadena);
                //  $('subport').html(cadena);
                $('#cuerpo_marcacion').html(cadena);
            }
        });


    });


    $("#formulario").submit(function(e) {

        //esto evita que se haga la petición común, es decir evita que se refresque la pagina
        e.preventDefault();
        jObject = [];
        jObject = cartToString();


        //FormData es necesario para el envio de archivo,
        //y de la siguiente manera capturamos todos los elementos del formulario
        var purchase = $('input[name=purchase]').val();
        var date_reception = $('input[name=date_reception]').val();
        var date_purchase = $('input[name=date_purchase]').val();


        $.ajax({
            type: "POST",
            url: "<?= site_url('client/add_request') ?>",
            data: {
                'array': JSON.stringify(jObject),
                purchase: purchase,
                date_purchase: date_purchase,
                date_reception: date_reception,
            }, //capturo array
            success: function(data) {
                if (data != "") {

                    $('#myModal').modal('hide');

                    window.location.href = "<?= site_url('request/index') ?>";



                } else {
                    $('#errorModal').modal('show');
                    $('#mensaje_error').html("Los campos no pueden quedar vacios");
                    $('#aceptar_error').on("click", function() {

                        $('#errorModal').modal('hide');
                    });
                }
            }
        });
    })




    $.fn.extend({
        //		https://github.com/daneden/animate.css
        animateCss: function(animationName) {
            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            this.addClass('animated ' + animationName).one(animationEnd, function() {
                $(this).removeClass('animated ' + animationName);
            });
            return this;
        }
    });
    //# sourceURL=pen.js
</script>
<style class="cp-pen-styles">
    .btn-add-cart {
        position: absolute;
        left: 15px;
        top: 0px;
    }


    .price {
        position: absolute;
        left: 15px;
        bottom: 0px;
    }

    #modal_ancho {
        width: 80% !important;
    }
</style>