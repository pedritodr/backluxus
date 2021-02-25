<section id="content">
    <div class="container">
        <div class="bread-crumb">
            <a href="#" class="silver"><?= $category->name ?> </a><span class="color"><?= $producto_object->name ?></span>
        </div>
        <div class="content-detail">
            <div class="product-detail">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="detail-gallery">
                            <div class="mid item-product">
                                <!--    <span class="product-label sale-label">50% off</span> -->
                                <img src="<?= base_url($producto_object->main_photo) ?>" alt="" />
                            </div>
                            <?php if ($all_fotos) { ?>
                                <div class="gallery-control">
                                    <div class="carousel">
                                        <ul class="list-none">
                                            <li><a href="#" class="active"><img src="<?= base_url($producto_object->main_photo) ?>" alt="" /></a></li>
                                            <?php foreach ($all_fotos as $item) { ?>
                                                <li><a href="#"><img src="<?= base_url($item->photo) ?>" alt="" /></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <a href="#" class="prev"></a>
                                    <a href="#" class="next"></a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="detail-info">
                            <h2 class="title-detail title30"><?= $producto_object->name ?></h2>
                            <ul class="list-inline-block sku-stock">
                                <li>
                                    <div class="product-rate">
                                        <div class="product-rating" style="width:100%"></div>
                                    </div>
                                </li>
                                <li><span class="inout-stock in-stock"><i class="fa fa-check-square" aria-hidden="true"></i>En stock</span></li>
                            </ul>
                            <div class="product-price">
                                <del><span class="title14 silver">$<?= number_format($producto_object->price_old, 2) ?></span></del>
                                <ins><span class="title14 color">$<?= number_format($producto_object->price, 2) ?></span></ins>
                            </div>
                            <p class="desc"><?= $producto_object->corta ?> </p>

                            <ul class="list-inline-block qty-cart">
                                <li>
                                    <h3 class="title14">Cantidad</h3>
                                </li>
                                <li>
                                    <div class="detail-qty">
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        <a href="#" class="qty-down"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                    </div>
                                </li>
                                <?php $detalle = true; ?>
                                <li><a onclick="addCarrito('<?= base64_encode(json_encode($producto_object)) ?>','<?= $detalle ?>')" href="#" class="title14 shop-button">Agregar al carrito</a></li>
                            </ul>
                            <!--     <div class="product-extra-link">
                                <a href="#" class="wishlist-link"></a>
                                <a href="#" class="compare-link"></a>
                            </div>
                            <div class="detail-tags">
                                <label class="title14">Tags:</label>
                                <a href="#">sport</a>
                                <a href="#">shoes</a>
                                <a href="#">clothing</a>
                                <a href="#">adidas</a>
                                <a href="#">nike</a>
                                <a href="#">puma</a>
                                <a href="#">hockey</a>
                                <a href="#">tennis</a>
                            </div>
                            <div class="detail-social">
                                <img src="images/shop/social.png" alt="" />
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product Detail -->
            <div class="detail-tabs">
                <div class="title-tab-detail">
                    <ul class="list-inline-block">
                        <li class="active"><a href="#tab1" class="title14" data-toggle="tab">Descripción</a></li>
                        <!--   <li><a href="#tab2" class="title14" data-toggle="tab">Additional</a></li>
                        <li><a href="#tab3" class="title14" data-toggle="tab">Reviews</a></li> -->
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="detail-descript">
                            <h2 class="title18"><span>Detalle del producto</span></h2>
                            <?= $producto_object->description ?>
                        </div>
                    </div>
                    <!--    <div id="tab2" class="tab-pane">
                        <div class="detail-addition">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="desc">Frame Material: Wood</p>
                                        </td>
                                        <td>
                                            <p class="desc">Seat Material: Wood</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Adjustable Height: No</p>
                                        </td>
                                        <td>
                                            <p class="desc">Seat Style: Saddle</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Distressed: No</p>
                                        </td>
                                        <td>
                                            <p class="desc">Custom Made: No</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Number of Items Included: 1</p>
                                        </td>
                                        <td>
                                            <p class="desc">Folding: No</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Stackable: No</p>
                                        </td>
                                        <td>
                                            <p class="desc">Cushions Included: No</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Arms Included: No</p>
                                        </td>
                                        <td>
                                            <div class="product-more-info">
                                                <p class="desc">Legs Included: Yes</p>
                                                <ul class="list-none">
                                                    <li><a href="#">Leg Material: Wood</a></li>
                                                    <li><a href="#">Number of Legs: 4</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Footrest Included: Yes</p>
                                        </td>
                                        <td>
                                            <p class="desc">Casters Included: No</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Nailhead Trim: No</p>
                                        </td>
                                        <td>
                                            <p class="desc">Weight Capacity: 225 Kilogramm</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="desc">Commercial Use: No</p>
                                        </td>
                                        <td>
                                            <p class="desc">Country of Manufacture: Vietnam</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <!--    <div id="tab3" class="tab-pane">
                        <div class="content-tags-detail">
                            <h3 class="title14">2 Review for bakery macaron</h3>
                            <ul class="list-none list-tags-review">
                                <li>
                                    <div class="review-author">
                                        <a href="#"><img src="images/shop/author1.jpg" alt=""></a>
                                    </div>
                                    <div class="review-info">
                                        <p class="review-header"><a href="#"><strong>7up-theme</strong></a> &ndash; March 30, 2017:</p>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <p class="desc">Really a nice stool. It was better than I expected in quality. The color is a rich, honey brown and looks a little lighter than pictured but still a great stool for the money.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="review-author">
                                        <a href="#"><img src="images/shop/author2.jpg" alt=""></a>
                                    </div>
                                    <div class="review-info">
                                        <p class="review-header"><a href="#"><strong>7up-theme</strong></a> &ndash; March 30, 2017:</p>
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:100%"></div>
                                        </div>
                                        <p class="desc">Really a nice stool. It was better than I expected in quality. The color is a rich, honey brown and looks a little lighter than pictured but still a great stool for the money.</p>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div> -->
                </div>
            </div>
            <?php if ($relacionados) { ?>
                <div class="upsell-product">
                    <h2 class="title30">Productos relacionados</h2>
                    <div class="product-slider">
                        <div class="wrap-item group-navi" data-navigation="true" data-pagination="false" data-itemscustom="[[0,1],[480,2],[768,3],[990,4]]">
                            <?php foreach ($relacionados as $item) { ?>
                                <div class="item-product text-center">
                                    <div class="product-thumb">
                                        <a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>" class="product-thumb-link zoom-thumb">
                                            <img src="<?= base_url($item->main_photo) ?>" alt="">
                                        </a>
                                        <div class="product-extra-link">
                                            <!-- <a href="#" class="wishlist-link"></a> -->
                                            <?php $detalle = false; ?>
                                            <a onclick="addCarrito('<?= base64_encode(json_encode($item)) ?>','<?= $detalle ?>')" href="#" class="addcart-link">Agregar al carrito</a>
                                            <!--            <a href="#" class="compare-link"></a> -->
                                        </div>
                                        <a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>" class="quickview-link title14 fancybox">Ver detalle</a>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title title14"><a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>"><?= $item->name ?></a></h3>
                                        <div class="product-price">
                                            <del><span class="title14 silver"><?= number_format($item->price_old, 2) ?></span></del>
                                            <ins><span class="title14 color"><?= number_format($item->price, 2) ?></span></ins>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- End Upsell Product -->
        </div>
    </div>
</section>
<!-- End Content -->