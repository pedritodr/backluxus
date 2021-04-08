<div id="content">
    <div class="content-page woocommerce">
        <div class="container">
            <div class="content-about cart-content-page">
                <h2 class="title30 text-uppercase font-bold dark">Carrito de compras</h2>
                <form method="post">
                    <div class="table-responsive">
                        <table class="shop_table cart table">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">Imagen</th>
                                    <th class="product-name">Producto</th>
                                    <th class="product-price">Precio</th>
                                    <th class="product-quantity">Cantidad</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody id="body_cart_table">

                            </tbody>

                        </table>
                    </div>
                </form>
                <div class="cart-collaterals">
                    <div class="cart_totals ">
                        <h2>Total Carrito</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <p>
                                            <td><strong class="amount">$ <b id="subtotal_carrito"></b> </strong></td>
                                        </p>

                                    </tr>
                                    <tr class="shipping">
                                        <th>IVA</th>
                                        <td><strong><span class="amount">$ <b id="iva"></b></span></strong> </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="amount">$ <b id="total"></b></span></strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <?php if ($this->session->userdata('_id')) { ?>

                            <div class="wc-proceed-to-checkout">
                                <a onclick="generarPedido()" class="checkout-button button alt wc-forward bg-color" style="cursor:pointer">Generar pedido</a>
                            </div>

                        <?php  } else { ?>
                            <div class="wc-proceed-to-checkout">
                                <a class="checkout-button button alt wc-forward bg-color" href="<?= site_url('login-register') ?>">Generar pedido</a>
                            </div>
                        <?php   } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Pages -->
</div>
<script>
    function generarPedido() {
        let pedido = carritoCompras.getCarritoLs();
        swal.fire({
            title: 'Completando operación',
            text: 'Creando el pedido ...',
            imageUrl: '<?= base_url("assets/cargando.gif") ?>',
            imageWidth: 128,
            imageHeight: 128,
            imageAlt: 'No realice acciones sobre la página',
            showConfirmButton: false
        });
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: "<?= site_url('front/create_pedido') ?>",
                data: {
                    pedido: JSON.stringify(pedido),
                    subtotal: $('#subtotal_carrito').text(),
                    iva: $('#iva').text(),
                    total: $('#total').text(),
                },
                success: function(result) {
                    result = JSON.parse(result);
                    if (result.status == 200) {
                        swal.close()
                        Swal.fire({
                            icon: 'success',
                            title: 'Pedido creado exitosamente en breve minutos un asistente de ventas se pondra en contacto para concretar el pedido.',
                            showConfirmButton: true,
                        });
                        setTimeout(function() {
                            localStorage.clear();
                            localStorage.setItem('ordenes', true);
                            window.location = '<?= site_url('perfil') ?>';
                        }, 3000);
                    } else {
                        swal.close()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error en la transacción',
                            showConfirmButton: true,
                        });
                    }

                }
            });
        }, 1500)
    }
</script>