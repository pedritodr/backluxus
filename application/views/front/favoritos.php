 <!--PAGE CONTENT START-->
 <div class="page-content">

     <!--PAGE HEADER START-->
     <header class="page-header">
         <div class="inner-wrapper" style="background-image: url('<?= base_url(); ?>assets_front/assets/img/page-header/shop.jpg')">
             <!-- <div class="breadcrumbs-wrapper">
                 <h1 class="page-title">Tus favoritos</h1>
                 <ul class="breadcrumbs-list">
                     <li>
                         <a href="<?= site_url('front/index'); ?>">
                             Home
                         </a>
                     </li>
                     <li>
                         Favoritos
                     </li>
                 </ul>
             </div>-->
         </div>
     </header>
     <!--PAGE HEADER END-->

     <!--SHOP SECTION START-->
     <section class="shop-section boxed-layout">
         <div class="shop-inner-wrapper">

             <div class="shop-grid">
                 <?php if ($all_colecciones) { ?>
                 <h4 class="page-title">Tus colecciones favoritas</h4>
                 <div class="contact-form-wrapper default-container" id="respuesta">
                     <div id="form-messages">
                         <?= get_message_from_operation(); ?>
                     </div>
                 </div>
                 <?php foreach ($all_colecciones as $item) { ?>
                 <div id="product" class="product-item">
                     <div class="img-wrapper">
                         <a id="single_coleccion" href="<?= site_url('front/single_coleccion/' . $item->coleccion_id); ?>">
                             <div class="image" style="background-image: url(<?= base_url($item->main_photo); ?>)">

                             </div>

                         </a>
                     </div>
                     <div class="product-info">

                         <a href="<?= site_url('front/quitar_favorito/' . $item->coleccion_id . '/0'); ?>" class="button wishlist-button">
                             <h6><i class="fa fa-heart"></i> QUITAR DE FAVORITOS</h6>
                         </a>

                     </div>
                 </div>


                 <?php } ?>
                 <?php } else { ?>
                 <h4 class="page-title">No tienes colecciones favoritas</h4>

                 <?php } ?>
             </div>
             <br>
             <div class="shop-grid">
                 <?php if ($all_productos) { ?>

                 <h4 class="page-title">Tus productos favoritos</h4>

                 <div class="contact-form-wrapper default-container" id="respuesta">
                     <div id="form-messages">
                         <?= get_message_from_operation(); ?>
                     </div>
                 </div>
                 <?php foreach ($all_productos as $producto) { ?>
                 <div id="product" class="product-item">
                     <div class="img-wrapper tilt-wrapper" data-tilt-value="40" data-tilt-speed="2500" data-tilt-scale="1" data-tilt-perspective="2000">
                         <a href="<?= site_url('front/single_producto/' . $producto->producto_id); ?>">
                             <div class="image" style="background-image: url(<?= base_url($producto->main_photo); ?>)"></div>
                             <?php if ($producto->stock > 0) { ?>
                             <?php if ($producto->descuento > 0) { ?>
                             <div class="product-label">
                                 <span class="sale-label">
                                     Descuento <span><?= $producto->descuento ?>%</span>
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
                             <?php if ($producto->descuento > 0) { ?>
                             <?php $descuento = $producto->descuento / 100;
                                            $precio_descuento = $producto->price - ($producto->price * $descuento); ?>
                             <h5>$ <?= number_format($precio_descuento, 2); ?> &nbsp</h5>
                             <h5 class="tachar">$ <?= number_format($producto->price, 2); ?></h5>
                             <?php } else { ?>
                             <h5>$ <?= number_format($producto->price, 2); ?></h5>
                             <?php } ?>
                         </span>
                         <br>
                         <a href="<?= site_url('front/quitar_favorito/0/' . $producto->producto_id); ?>" class="button wishlist-button">
                             <h6><i class="fa fa-heart"></i> QUITAR DE FAVORITOS</h6>
                         </a>

                     </div>
                 </div>


                 <?php } ?>
                 <?php } else { ?>
                 <br>
                 <h4 class="page-title">No tienes productos favoritos</h4>
                 <?php } ?>
             </div>

         </div>
     </section>
     <!--SHOP SECTION END-->

 </div>
 <!--PAGE CONTENT END-->