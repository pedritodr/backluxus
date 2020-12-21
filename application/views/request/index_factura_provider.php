<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $all_buy_element[0]->purchase_order; ?>



        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= $all_buy_element[0]->purchase_order; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form id="factura" method="post" action="<?php echo base_url(); ?>request/confirmar_invoice">

                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="box-title">Finca: <p style="text-transform: uppercase;"><?= $all_buy_element[0]->provider ?></p>
                                    </h3>
                                </div>
                                <div class="col-lg-offset-3 col-lg-1">
                                    <label for="invoice">Invoice Nro</label>

                                    <input id="invoice" name="nro_invoice" type="text" class="form-control input-sm text-center" style="width:180px;" name="qty_box" placeholder="Invoice nro:" required>
                                    <input name="provider_id" id="" type="hidden" value="<?= $all_buy_element[0]->provider_id ?>">
                                    <input name="buy_id" id="" type="hidden" value="<?= $all_buy_element[0]->buy_id ?>">

                                </div>

                                <div class="col-lg-2">
                                    <input type="submit" style="margin-top:24px; margin-left:54px;" name="confirmar" class="btn btn-success" value="Confirmar" />

                                </div>
                            </div>



                        </div><!-- /.box-header -->
                </form>
                <div class="box-body">
                    <?= get_message_from_operation(); ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= translate("variety_lang"); ?></th>
                                <th><?= translate("measures_lang"); ?></th>
                                <th>Tallos</th>
                                <th>Nro de cajas</th>
                                <th><?= translate("precio_lang"); ?></th>
                                <th>Total</th>
                                <th><?= translate("actions_lang"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $acumular_total = 0;
                            $total = 0; ?>
                            <?php foreach ($all_buy_element as $item) { ?>
                                <tr>
                                    <td>
                                        <?= $item->product; ?>
                                    </td>
                                    <td>
                                        <?= $item->measure; ?>
                                    </td>
                                    <td>
                                        <?= $item->total_steams; ?>
                                    </td>
                                    <td>
                                        <?= $item->qty; ?>
                                    </td>
                                    <td>
                                        <?= $item->price; ?>

                                    </td>

                                    <td>
                                        <?php $total = $item->qty * $item->price; ?>
                                        <?= $total ?>

                                    </td>
                                    <td>
                                        <button onclick="update('<?= $item->provider_id; ?>','<?= $item->buy_element_id; ?>','<?= $item->price; ?>','<?= $item->qty; ?>')" data-toggle="modal" data-target="#updateModal" type="button" id="editar" class="btn btn-info"><i class="fa fa-edit"></i> <?= translate("edit_lang"); ?></button>
                                    </td>
                                </tr>
                                <?php $acumular_total = $acumular_total + $total ?>
                            <?php } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total: <?= $acumular_total ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title text-center" id="exampleModalLabel">Actualizar</h5>

            </div>
            <form method="post" action="<?php echo base_url(); ?>request/update_buy_element">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <label>Cantidad</label>
                            <div class="input-group">
                                <input id="qty_box" type="number" value="" step="any" class="form-control input-sm" style="width:120px;" name="qty" min="0" pattern="^[0-9]+" placeholder="Cantidad de cajas">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Precio</label>
                            <div class="input-group">
                                <input id="precio" type="number" value="" step="any" class="form-control input-sm" style="width:120px;" name="precio" min="1" pattern="^[1-9]+" placeholder="<?= translate('precio_lang'); ?>">

                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="comment">Motivo:</label>
                                <textarea class="form-control" rows="5" id="comment" name="reason"></textarea>
                            </div>
                        </div>
                    </div>

                    <input name="buy_element_id" id="" class="btn btn-primary" type="hidden" value="">
                    <input name="provider_id" id="" class="btn btn-primary" type="hidden" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#example1').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "searching": false,
            "bAutoWidth": false
        });



    });

    function update(provider_id, buy_element_id, price, qty) {
        $('input[name=provider_id]').val(provider_id);
        $('input[name=buy_element_id]').val(buy_element_id);
        $('input[name=precio]').val(price);
        $('input[name=qty]').val(qty);

    }
</script>