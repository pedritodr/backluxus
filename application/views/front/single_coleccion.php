<!--PAGE CONTENT START-->
<div class="page-content">

    <!--PAGE HEADER START-->
    <header class="page-header">
        <div class="inner-wrapper" style="background-image: url('<?= base_url($all_menus[1]->photo_main); ?>')">
            <!--<div class="breadcrumbs-wrapper">
                <h1 class="page-title">Shop</h1>
                <ul class="breadcrumbs-list">
                    <li>
                        <a href="<?= site_url('front/index'); ?>">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('front/colecciones'); ?>">
                            Colecciones
                        </a>
                    </li>
                    <li>
                        <?= $coleccion_object->name; ?>
                    </li>
                </ul>
            </div>-->
        </div>
    </header>
    <!--PAGE HEADER END-->

    <!--SINGLE PRODUCT START-->
    <section class="single-product-section ">
        <div class="default-container shop-inner-wrapper">
            <div class="product-information">
                <div class="product-media">
                    <img src="<?= base_url($coleccion_object->main_photo); ?>" alt='product-overview' class="img-fluid">
                    <!--   <div class="product-label">
                        <span class="new-product">
                            new
                        </span>
                    </div>-->
                </div>
                <div class="product-description">
                    <h3 class="title"><?= $coleccion_object->name; ?></h3>
                    <p class="product-content"><?= $coleccion_object->description; ?></p>
                    <div class="button-panel">
                        <div class="quantity">
                            <input type="number" min="1" max="9" step="1" value="1">
                        </div>
                        <a href="#" class="button button-type-3">
                            add to cart
                        </a>
                    </div>
                    <?php if ($all_favoritos) { ?>
                    <?php if (!in_array($coleccion_object->coleccion_id, $all_favoritos)) { ?>
                    <a href="<?= site_url('front/add_favorito/' . $coleccion_object->coleccion_id . '/0'); ?>" class="button wishlist-button"><i class="fa fa-heart"></i> Agreagar a favoritos</a>
                    <?php } ?>
                    <?php } else if ($this->session->userdata('role_id') == 3) { ?>
                    <a href="<?= site_url('front/add_favorito/' . $coleccion_object->coleccion_id . '/0'); ?>" class="button wishlist-button"><i class="fa fa-heart"></i> Agreagar a favoritos</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-section boxed-layout">
        <div class="shop-inner-wrapper">
            <?php if ($all_productos) { ?>
            <h4 style="margin-left:15%">Productos</h4>
            <div class="shop-grid">

                <?php foreach ($all_productos as $item) { ?>
                <div id="product" class="product-item">
                    <div class="img-wrapper tilt-wrapper" data-tilt-value="40" data-tilt-speed="2500" data-tilt-scale="1" data-tilt-perspective="2000">
                        <a href="<?= site_url('front/single_producto/' . $item->producto_id); ?>">
                            <div class="image" style="background-image: url(<?= base_url($item->main_photo); ?>)">
                            </div>
                            <?php if ($item->stock > 0) { ?>
                            <?php if ($item->descuento > 0) { ?>
                            <div class="product-label">
                                <span class="sale-label">
                                    Descuento <span><?= $item->descuento ?>%</span>
                                </span>
                            </div>
                            <?php } ?>


                            <div class="button-permalink-wrapper">
                                <a href="#" class="button button-product">
                                    Add to cart
                                </a>
                            </div>
                            <?php } else { ?>
                            <div class="product-label">
                                <span class="sale-label">
                                    Agotado
                                </span>
                            </div>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="product-info">
                        <!-- <h6 class="title"><a href="shop-single-product.html"><?= $item->name; ?></a></h6>-->
                        <span class="price">
                            <?php if ($item->descuento > 0) { ?>
                            <?php $descuento = $item->descuento / 100;
                                        $precio_descuento = $item->price - ($item->price * $descuento); ?>
                            <h5>$ <?= number_format($precio_descuento, 2); ?> &nbsp</h5>
                            <h5 class="tachar">$ <?= number_format($item->price, 2); ?></h5>
                            <?php } else { ?>
                            <h5>$ <?= number_format($item->price, 2); ?></h5>
                            <?php } ?>
                        </span>
                        <br>
                        <?php if ($all_favoritos) { ?>
                        <?php if (!in_array($item->producto_id, $all_favoritos)) { ?>
                        <a href="<?= site_url('front/add_favorito/0/' . $item->producto_id); ?>" class="button wishlist-button">
                            <h6><i class="fa fa-heart"></i> AGREGAR A FAVORITOS</h6>
                        </a>
                        <?php  } ?>
                        <?php } else if ($this->session->userdata('role_id') == 3) { ?>

                        <a href="<?= site_url('front/add_favorito/0/' . $item->producto_id); ?>" class="button wishlist-button">
                            <h6><i class="fa fa-heart"></i> AGREGAR A FAVORITOS</h6>
                        </a>
                        <?php  } ?>

                    </div>
                </div>


                <?php } ?>

            </div>
            <div class="footer-wrapper">

                <div class="meta-side">

                    <div class="like-wrapper">
                        <button style="margin-left:20%" class="like-button">
                            <span class="like-count"><?= $all_likes->count; ?></span>&nbsp
                            <i style="color:#ea0b0b;" class="fa fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

</div>
</section>

<section class="shop-section ">
    <div class="shop-inner-wrapper">
        <div class="shop-info-wrapper">
            <div class="info-row">
                <div class="info-block">
                    <i style="color:#b1acac;" class="fa fa-shopping-basket"></i>
                    <h6>ENTREGA GRATIS</h6>
                    <h5>Si tu compra es mayor a
                        $25, el envío corre por
                        nuestra cuenta!</h5>
                </div>

                <div class="info-block">
                    <i style="color:#b1acac;" class="fa fa-lock"></i>
                    <h6>PAGO SEGURO</h6>
                    <h5>Nuestra plataforma
                        garantiza transaciones
                        seguras y tu info
                        encapsulada.</h5>
                </div>
                <div class="info-block">
                    <i style="color:#b1acac;" class="far fa-clock"></i>
                    <h6>24 HORAS CIUDADES
                        PRINCIPALES</h6>
                    <h5>Tu objeto con alma te llegará
                        en un máximo de 24 horas.
                        Martes y Jueves cidades
                        satelites. Nuestra cadena aliada
                        UPS . LAAR se contactará
                        contigo para coordinar la
                        entrega. </h5>
                </div>
                <div class="info-block">
                    <i style="color:#b1acac;" class="fas fa-tag"></i>
                    <h6>DESCUENTOS Y
                        PROMOSIONES</h6>
                    <h5>Registrate y recibe
                        promociones flash
                        y descuentos de
                        temporada.</h5>
                </div>
            </div>
        </div>
    </div>

</section>
<!--SINGLE PRODUCT END-->

</div>
<!--PAGE CONTENT END-->