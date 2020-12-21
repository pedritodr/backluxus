<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= translate('mis_pedidos_lang'); ?>
            <small><?= translate('mis_pedidos_lang'); ?></small>
            | <a href="<?= site_url('dashboard/index'); ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?= translate('back_lang'); ?>
            </a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/index'); ?>"><i class="fa fa-dashboard"></i> <?= translate('pizarra_resumen_lang'); ?></a></li>
            <li class="active"><?= translate('mis_pedidos_lang'); ?></li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= translate('mis_pedidos_lang'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?= get_message_from_operation(); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("cantidad_lang"); ?></th>
                                    <th><?= translate("total_lang"); ?></th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($pedido_object) { ?>

                                    <?php foreach ($pedido_object as $pedido) { ?>
                                        <?php foreach ($pedido->lista_pedidos as $item) { ?>

                                            <tr>
                                                <td>


                                                    <?= $item->name ?>

                                                </td>
                                                <td style="width:15%"><img style="width:100%;" class="img img-rounded img-responsive" src="<?= base_url($item->main_photo); ?>" /></td>

                                                <td> <b>Cantidad : <?= $item->cantidad ?></b>

                                                    <br>
                                                    <br>
                                                    <b>Precio : $ <?= number_format($item->price, 2)  ?></b>

                                                </td>
                                                <td>
                                                    <?= number_format($item->cantidad * $item->price, 2) ?>
                                                </td>



                                            </tr>


                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?= translate("nombre_lang"); ?></th>
                                    <th><?= translate("image_lang"); ?></th>
                                    <th><?= translate("cantidad_lang"); ?></th>
                                    <th><?= translate("total_lang"); ?></th>

                                </tr>

                            </tfoot>

                        </table>

                        <?php if ($pedido_object) { ?>
                            <?php foreach ($pedido_object as $pedido) { ?>
                                <div class="cart-collaterals">
                                    <div class="cart_totals ">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <p>
                                                            <td><strong class="amount">$ <b><?= $pedido->subtotal ?></b> </strong></td>
                                                        </p>

                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>IVA</th>
                                                        <td><strong><span class="amount">$ <b><?= $pedido->iva ?></b></span></strong> </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td><strong><span class="amount">$ <b><?= number_format($pedido->total, 2)  ?></b></span></strong> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            <?php  } ?>
                        <?php  } ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function() {
        $("#example1").DataTable();

    });
</script>