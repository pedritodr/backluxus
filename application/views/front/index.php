	<!-- End Header -->
	<section id="content">
		<div class="container">
			<div class="banner-slider banner-slick banner-slider1">
				<div class="slick center">
					<?php foreach ($all_banners as $item) { ?>
						<div class="item-slider">
							<div class="banner-thumb">
								<a target="_blank" href="<?= $item->url ?>"><img src="<?= base_url($item->photo) ?>" alt="" /></a>
							</div>
							<?php if ($item->texto_1 != "") { ?>
								<div class="banner-info">
									<div class="banner-info1 white text-center white">
										<h2 class="title30"><?= $item->texto_1 ?></h2>
										<h3 class="title14"><?= $item->texto_2 ?></h3>
									</div>
								</div>
							<?php } ?>
							<!-- <p class="desc-control hidden">Suspendisse eleme ntum elemenm</p> -->
						</div>
					<?php } ?>


				</div>
			</div>
			<!-- End Banner Slider -->
			<div class="list-col3">
				<div class="row">
					<?php if ($categorias_destacadas) { ?>
						<?php foreach ($categorias_destacadas as $item) { ?>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="banner-coleccion item-coleccion3 zoom-image">
									<a style="cursor:pointer" onclick="filterCategoria('<?= base64_encode(json_encode($item)) ?>')" class="coleccion-thumb-link"><img src="<?= base_url($item->photo) ?>" alt="" style=" display: block !important;"></a>
									<div class="banner-info text-center">
										<h2 class="title30 white"><?= $item->name ?></h2>
										<a style="cursor:pointer" onclick="filterCategoria('<?= base64_encode(json_encode($item)) ?>')" class="title14 btn-caret white">Ir a la tienda<i class="fa fa-caret-right" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<!-- End List sub -->
			<div class="product-box1">
				<div class="intro-box1 text-center">
					<h2 class="title30 font-bold title-underline"><span>Implemetos deportivos</span></h2>
					<!-- <p class="desc">Etiam sodales ante id nunc. Proin ornare dignissim lacus. Nunc porttitor nunc a sem</p> -->
				</div>
				<div class="title-tab1">
					<ul class="list-inline-block text-center">
						<li class="active"><a href="#<?= $categorias[0]['_id'] ?>" class="title14 black link-btn" data-toggle="tab"><?= $categorias[0]['name'] ?> </a></li>
						<?php for ($i = 1; $i < count($categorias); $i++) { ?>
							<li><a href="#<?= $categorias[$i]['_id'] ?>" class="title14 black link-btn" data-toggle="tab"><?= $categorias[$i]['name'] ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="tab-content">
					<div id="<?= $categorias[0]['_id'] ?>" class="tab-pane active">
						<div class="product-slider">
							<?php if ($categorias[0]['productos']) { ?>
								<div class="wrap-item navi-bottom" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[480,2],[990,3],[1200,4]]">
									<?php for ($i = 0; $i < count($categorias[0]['productos']); $i++) { ?>
										<div class="item-product text-center">
											<span class="product-label new-label">Nuevo</span>
											<div class="product-thumb">
												<a href="<?= site_url(strtolower(seo_url($categorias[0]['productos'][$i]['name'])) . '-' . strtolower(seo_url($categorias[0]['productos'][$i]['codigo']))); ?>" class="product-thumb-link zoom-thumb">
													<img src="<?= base_url($categorias[0]['productos'][$i]['main_photo']) ?>" alt="" />
												</a>
												<div class="product-extra-link">
													<!-- 	<a href="#" class="wishlist-link"></a> -->
													<?php $detalle = false; ?>
													<a onclick="addCarrito('<?= base64_encode(json_encode($categorias[0]['productos'][$i])) ?>','<?= $detalle ?>')" href="#" class="addcart-link">Agregar al carrito</a>

													<!-- 	<a href="#" class="compare-link"></a> -->
												</div>
												<a href="<?= site_url(strtolower(seo_url($categorias[0]['productos'][$i]['name'])) . '-' . strtolower(seo_url($categorias[0]['productos'][$i]['codigo']))); ?>" class="quickview-link title14 fancybox">Ver detalles</a>
											</div>
											<div class="product-info">
												<h3 class="product-title title14"><a href="<?= site_url(strtolower(seo_url($categorias[0]['productos'][$i]['name'])) . '-' . strtolower(seo_url($categorias[0]['productos'][$i]['codigo']))); ?>"><?= ($categorias[0]['productos'][$i]['name']) ?></a></h3>
												<div class="product-price">
													<del><span class="title14 silver">$<?= number_format($categorias[0]['productos'][$i]['price_old'], 2) ?></span></del>
													<ins><span class="title14 color">$<?= number_format($categorias[0]['productos'][$i]['price'], 2) ?></span></ins>
												</div>
												<div class="product-rate">
													<div class="product-rating" style="width:100%"></div>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<?php for ($i = 1; $i < count($categorias); $i++) { ?>

						<?php if ($categorias[$i]['productos']) { ?>
							<div id="<?= $categorias[$i]['_id'] ?>" class="tab-pane">
								<div class="product-slider">
									<div class="wrap-item navi-bottom" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[480,2],[990,3],[1200,4]]">
										<?php for ($j = 0; $j < count($categorias[$i]['productos']); $j++) { ?>
											<div class="item-product text-center">
												<div class="product-thumb">
													<a href="<?= site_url(strtolower(seo_url($categorias[$i]['productos'][$j]['name'])) . '-' . strtolower(seo_url($categorias[$i]['productos'][$j]['codigo']))); ?>" class="product-thumb-link zoom-thumb">
														<img src="<?= base_url($categorias[$i]['productos'][$j]['main_photo']) ?>" alt="" />
													</a>
													<div class="product-extra-link">
														<!-- <a href="#" class="wishlist-link"></a> -->
														<a onclick="addCarrito('<?= base64_encode(json_encode($categorias[$i]['productos'][$j])) ?>','<?= FALSE ?>')" href="#" class="addcart-link">Agregar al carrito</a>
														<!-- 	<a href="#" class="compare-link"></a> -->
													</div>
													<a href="<?= site_url(strtolower(seo_url($categorias[$i]['productos'][$j]['name'])) . '-' . strtolower(seo_url($categorias[$i]['productos'][$j]['codigo']))); ?>" class="quickview-link title14 fancybox">Ver detalles</a>
												</div>
												<div class="product-info">
													<h3 class="product-title title14"><a href="<?= site_url(strtolower(seo_url($categorias[$i]['productos'][$j]['name'])) . '-' . strtolower(seo_url($categorias[$i]['productos'][$j]['codigo']))); ?>"><?= ($categorias[$i]['productos'][$j]['name']) ?></a></h3>
													<div class="product-price">
														<del><span class="title14 silver">$<?= number_format($categorias[$i]['productos'][$j]['price_old'], 2) ?></span></del>
														<ins><span class="title14 color">$<?= number_format($categorias[$i]['productos'][$j]['price'], 2) ?></span></ins>
													</div>
													<div class="product-rate">
														<div class="product-rating" style="width:100%"></div>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					<!-- 	<div id="tab1" class="tab-pane active">
						<div class="product-slider">
							<div class="wrap-item navi-bottom" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[480,2],[990,3],[1200,4]]">
								<div class="item-product text-center">
									<span class="product-label new-label">new</span>
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_1.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_13.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_6.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_11.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_3.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_2.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<!-- <div id="tab2" class="tab-pane">
						<div class="product-slider">
							<div class="wrap-item navi-bottom" data-pagination="false" data-navigation="true" data-itemscustom="[[0,1],[480,2],[990,3],[1200,4]]">
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_14.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_15.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_16.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_17.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_18.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
								<div class="item-product text-center">
									<div class="product-thumb">
										<a href="detail.html" class="product-thumb-link zoom-thumb">
											<img src="<?= base_url('template/images/photos/sport_12.jpg') ?>" alt="" />
										</a>
										<div class="product-extra-link">
											<a href="#" class="wishlist-link"></a>
											<a href="#" class="addcart-link">Add to cart</a>
											<a href="#" class="compare-link"></a>
										</div>
										<a href="quick-view.html" class="quickview-link title14 fancybox fancybox.iframe">Quick view</a>
									</div>
									<div class="product-info">
										<h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
										<div class="product-price">
											<del><span class="title14 silver">$798.00</span></del>
											<ins><span class="title14 color">$399.00</span></ins>
										</div>
										<div class="product-rate">
											<div class="product-rating" style="width:100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>

		</div>
	</section>
	<!-- End Content -->
	<script>
		function filterCategoria(params) {
			let obj = atob(params);
			obj = JSON.parse(obj);
			select_categoria = obj.name;
			$('#search').val('buscar por productos');

			if (select_categoria != "Todas") {
				$('#form_busqueda').append(' <input id="cat" type="hidden" name="cat" value="' + select_categoria + '">');
			}
			$('#form_busqueda').submit();
		}
	</script>