<div class="product-box1">
    <div class="intro-box1 text-center">
        <br>
        <br>
        <h2 class="title30 font-bold title-underline"><span>Mi Perfil</span></h2>
        <?= get_message_from_operation(); ?>
        <!-- <p class="desc">Etiam sodales ante id nunc. Proin ornare dignissim lacus. Nunc porttitor nunc a sem</p> -->
    </div>
    <div class="title-tab1">
        <ul class="list-inline-block text-center">
            <li id="datos" class="active"><a href="#tab1" class="title14 black link-btn" data-toggle="tab">Mis Datos </a></li>
            <li id="ordenes"><a href="#tab2" class="title14 black link-btn" data-toggle="tab">Mis Ordenes</a></li>

        </ul>
    </div>
    <div class="tab-content">
        <div id="tab1" class="tab-pane active">
            <div id="content">
                <div class="content-page woocommerce">
                    <div class="container content-about ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="register-content-box">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-ms-12">
                                            <div class="check-billing">
                                                <div class="form-my-account">
                                                    <form class="block-login" action="<?= site_url('front/update_perfil'); ?>" method="post">
                                                        <!-- <h2 class="title24 title-form-account">Iniciar sesión</h2> -->
                                                        <p>
                                                            <label>Nombre<span></span></label>
                                                            <input type="text" name="name" value="<?= $user_object->name ?>" />
                                                        </p>
                                                        <p>
                                                            <label>Apellido<span></span></label>
                                                            <input type="text" name="surname" value="<?= $user_object->surname ?>" />
                                                        </p>
                                                        <p>
                                                            <?php if (isset($user_object->address)) { ?>

                                                                <label>Dirección<span></span></label>
                                                                <input type="text" name="address" value="<?= $user_object->address ?>" />
                                                            <?php } else { ?>
                                                                <label>Dirección<span></span></label>
                                                                <input type="text" name="address" />

                                                            <?php   } ?>

                                                        </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-ms-12">
                                            <div class="check-billing">
                                                <div class="form-my-account">
                                                    <p>
                                                        <label>E-mail<span class="required"></span></label>
                                                        <input type="text" name="email" value="<?= $user_object->email ?>" />
                                                    </p>
                                                    <p>
                                                        <?php if (isset($user_object->phone)) { ?>
                                                            <label>Telefono <span class="required"></span></label>
                                                            <input type="text" name="phone" value="<?= $user_object->phone ?>" />

                                                        <?php  } else { ?>
                                                            <label>Telefono <span class="required"></span></label>
                                                            <input type="text" name="phone" />

                                                        <?php  } ?>

                                                    </p>
                                                    <p>
                                                        <label>Contraseña <span class="required"></span></label>
                                                        <input type="password" name="password" value="<?= $user_object->password ?>" />
                                                    </p>
                                                    <p>
                                                        <input type="submit" class="register-button" name="login" value="Editar">
                                                    </p>

                                                    <input type="hidden" name="user_id" value="<?= $user_object->_id ?>">

                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content Page -->
            </div>
        </div>
        <div id="tab2" class="tab-pane">
            <div class="product-slider">

                <div class="content-page woocommerce">
                    <div class="container">
                        <h2>Lista de pedidos</h2>
                        <?php if ($pedidos) { ?>
                            <?php foreach ($pedidos as $nro_pedido) { ?>
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><?= $nro_pedido->pedido_id ?></button>
                            <?php  } ?>

                        <?php   } ?>


                        <div id="demo" class="collapse">
                            <div class="content-about cart-content-page">
                                <!-- <h2 class="title30 text-uppercase font-bold dark">Mis Ordenes</h2> -->
                                <form method="post">
                                    <div class="table-responsive">
                                        <table class="shop_table cart table">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="product-remove">&nbsp;</th> -->
                                                    <th class="product-thumbnail">Imagen</th>
                                                    <th class="product-name">Producto</th>
                                                    <th class="product-price">Precio</th>
                                                    <th class="product-quantity">Cantidad</th>
                                                    <th class="product-subtotal">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $acum = 0 ?>
                                                <?php if ($pedidos) { ?>

                                                    <?php foreach ($pedidos as $pedido_cliente) { ?>

                                                        <?php foreach ($pedido_cliente->lista_pedidos as $listado) { ?>
                                                            <?php $total = number_format($listado->price * $listado->cantidad);

                                                            $acum += $total;

                                                            ?>

                                                            <tr class="cart_item">

                                                                <td class="product-thumbnail">

                                                                    <img src="<?= base_url($listado->main_photo) ?>" alt="">

                                                                </td>
                                                                <td class="product-name" data-title="Product">
                                                                    <a href="product-detail.html"><?= $listado->name ?></a>
                                                                </td>
                                                                <td class="product-price" data-title="Price">
                                                                    <span class="amount"><?= $listado->price ?></span>
                                                                </td>
                                                                <td class="product-quantity" data-title="Quantity">
                                                                    <div class="detail-qty">
                                                                        <span class="qty-val"><?= $listado->cantidad ?></span>
                                                                    </div>


                                                                </td>

                                                                <td class="product-subtotal" data-title="Total">
                                                                    <span class="amount"><?= number_format($listado->price * $listado->cantidad, 2) ?></span>
                                                                </td>
                                                            </tr>


                                                        <?php  } ?>

                                                    <?php   } ?>


                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <div class="cart-collaterals">
                                    <div class="cart_totals ">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <p>
                                                            <td><strong class="amount">$ <b><?= number_format($acum / 1.12, 2) ?></b> </strong></td>
                                                        </p>

                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>IVA</th>
                                                        <td><strong><span class="amount">$ <b><?= number_format($acum - ($acum / 1.12), 2) ?></b></span></strong> </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td><strong><span class="amount">$ <b><?= number_format($acum, 2)  ?></b></span></strong> </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        if (localStorage.getItem('ordenes')) {
            $('#datos').removeClass('active');
            $('#ordenes').addClass('active');
            $('#tab1').removeClass('active');
            $('#tab2').addClass('active');
            localStorage.clear();
        }
    })
</script>