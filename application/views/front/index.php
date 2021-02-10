<main>
	<div class="content-search">

		<div class="container container-100">
			<i class="far fa-times-circle" id="close-search"></i>
			<h3 class="text-center">what are your looking for ?</h3>
			<form method="get" action="/search" role="search" style="position: relative;">
				<input type="text" class="form-control control-search" value="" autocomplete="off" placeholder="Enter Search ..." aria-label="SEARCH" name="q">

				<button class="button_search" type="submit">search</button>
			</form>
		</div>

	</div>
	<div class="slider-banner">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active slide1">
					<img src="<?=base_url('front_template/img/1920x830.png')?>" alt="holiwood">
					<div class="carousel-caption">
						<h3>IT'S YOUR DAY !</h3>
						<h1>Happy<br>Birthday.</h1>
						<a href="#">Shop now</a>
					</div>
				</div>

				<div class="item slide2">
					<img src="<?=base_url('front_template/img/1920x830.png')?>" alt="holiwood">
					<div class="carousel-caption">
						<h1>New<br>Collections</h1>
						<h2>A PERPECT BOUQUET</h2>
						<a href="#">Shop now</a>
					</div>
				</div>

				<div class="item slide1">
					<img src="<?=base_url('front_template/img/1920x830.png')?>" alt="holiwood">
					<div class="carousel-caption">
						<h3>IT'S YOUR DAY !</h3>
						<h1>Happy<br>Birthday.</h1>
						<a href="#">Shop now</a>
					</div>
				</div>
				<div class="item slide2">
					<img src="<?=base_url('front_template/img/1920x830.png')?>" alt="holiwood">
					<div class="carousel-caption">
						<h1>New<br>Collections</h1>
						<h2>A PERPECT BOUQUET</h2>
						<a href="#">Shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="show-img">
		<div class="container">
			<div class="row">
				<div class="show-item">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-1">
						<figure id="figure-show-1"><a href="#"><img src="<?=base_url('front_template/img/890x490.png')?>" class="img-responsive" alt="holiwood"></a></figure>
						<div class="show-title-1">
							<h1>Lavender<br>Collections</h1>
							<h2>SALE UP TO 20% OFF</h2>
							<a href="#">Read more</a>
						</div>

					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-2">
						<figure id="figure-show-2"><a href="#"><img src="<?=base_url('front_template/img/430x490.png')?>" class="img-responsive" alt="holiwood"></a></figure>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item-3">
						<figure id="figure-show-3"><a href="#"><img src="<?=base_url('front_template/img/430x490.png')?>" class="img-responsive" alt="holiwood"></a></figure>
						<div class="show-title-2 title-1">
							<h1>Rose</h1>
							<span>( 40 items )</span>
						</div>

					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item-4">
						<figure id="figure-show-4"><a href="#"><img src="<?=base_url('front_template/img/890x490.png')?>" class="img-responsive" alt="holiwood"></a></figure>
						<div class="show-title-2 title-2">
							<h2>SALE UP TO 30% OFF</h2>
							<h1>Happy<br>Women's day</h1>
							<a href="#">Shop now</a>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="category">
		<!-- Modal quick view -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body">
						<div class="tab-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="img-pill-1" class="tab-pane fade in active">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 title-quick">
										<figure class="fi-quick">
											<h1>QUICK VIEW</h1>
										</figure>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
										<img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 detail">
									<h1>Queen Rose - Pink</h1>
									<p class="p1">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
									<div class="star">
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
										<span>10 Rating(s) | Add Your Rating</span>
									</div>
									<div class="prince"><span>$250.9</span><s class="strike">$300.02</s></div>
									<figure class="fi-option">
										<p class="option">Option</p>
									</figure>
									<div class="size">
										<span class="lb-size">Size <span class="sta-red">*</span></span><span class="lb-color">Color <span class="sta-red">*</span></span>
									</div>
									<div class="select-custom">
										<select>
											<option>S</option>
											<option>M</option>
											<option>L</option>
											<option>XL</option>
										</select>
										<a href="#"><span class="color-1"></span></a> <a href="#"><span class="color-2"></span></a> <a href="#"><span class="color-3"></span></a> <a href="#"><span class="color-4"></span></a>
										<p class="require">Required Fields <span>*</span></p>
										<div class="Quality">

											<div class="input-group input-number-group">
												<span class="text-qua">Quanty:</span>
												<div class="input-group-button">
													<span class="input-number-decrement">-</span>
												</div>
												<input class="input-number" type="number" min="0" max="1000" value="01">
												<div class="input-group-button">
													<span class="input-number-increment">+</span>
												</div>
												<span class="dola">$ </span><span class="total">250.9</span>
											</div>

										</div>
										<div class="add-cart">
											<a href="#" class="btn-add-cart">Add to cart</a>
											<a href="#" class="list-icon icon-1"><i class="far fa-eye"></i></a>
											<a href="#" class="list-icon icon-2"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div id="img-pill-2" class="tab-pane fade">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 title-quick">
										<figure class="fi-quick">
											<h1>QUICK VIEW</h1>
										</figure>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
										<img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 detail">
									<h1>Queen Rose</h1>
									<p class="p1">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
									<div class="star">
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
										<span>10 Rating(s) | Add Your Rating</span>
									</div>
									<div class="prince"><span>$300.02</span><s class="strike">$250.9</s></div>
									<figure class="fi-option">
										<p class="option">Option</p>
									</figure>
									<div class="size">
										<span class="lb-size">Size <span class="sta-red">*</span></span><span class="lb-color">Color <span class="sta-red">*</span></span>
									</div>
									<div class="select-custom">
										<select>
											<option>S</option>
											<option>M</option>
											<option>L</option>
											<option>XL</option>
										</select>
										<a href="#"><span class="color-1"></span></a> <a href="#"><span class="color-2"></span></a> <a href="#"><span class="color-3"></span></a> <a href="#"><span class="color-4"></span></a>
										<p class="require">Required Fields <span>*</span></p>
										<div class="Quality">

											<div class="input-group input-number-group">
												<span class="text-qua">Quanty:</span>
												<div class="input-group-button">
													<span class="input-number-decrement">-</span>
												</div>
												<input class="input-number" type="number" min="0" max="1000" value="01">
												<div class="input-group-button">
													<span class="input-number-increment">+</span>
												</div>
												<span class="dola">$ </span><span class="total">250.9</span>
											</div>

										</div>
										<div class="add-cart">
											<a href="#" class="btn-add-cart">Add to cart</a>
											<a href="#" class="list-icon icon-1"><i class="far fa-eye"></i></a>
											<a href="#" class="list-icon icon-2"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div id="img-pill-3" class="tab-pane fade">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 title-quick">
										<figure class="fi-quick">
											<h1>QUICK VIEW</h1>
										</figure>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
										<img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 detail">
									<h1>Lavender</h1>
									<p class="p1">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
									<div class="star">
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
										<span>10 Rating(s) | Add Your Rating</span>
									</div>
									<div class="prince"><span>$300.02</span><s class="strike">$250.9</s></div>
									<figure class="fi-option">
										<p class="option">Option</p>
									</figure>
									<div class="size">
										<span class="lb-size">Size <span class="sta-red">*</span></span><span class="lb-color">Color <span class="sta-red">*</span></span>
									</div>
									<div class="select-custom">
										<select>
											<option>S</option>
											<option>M</option>
											<option>L</option>
											<option>XL</option>
										</select>
										<a href="#"><span class="color-1"></span></a> <a href="#"><span class="color-2"></span></a> <a href="#"><span class="color-3"></span></a> <a href="#"><span class="color-4"></span></a>
										<p class="require">Required Fields <span>*</span></p>
										<div class="Quality">

											<div class="input-group input-number-group">
												<span class="text-qua">Quanty:</span>
												<div class="input-group-button">
													<span class="input-number-decrement">-</span>
												</div>
												<input class="input-number" type="number" min="0" max="1000" value="01">
												<div class="input-group-button">
													<span class="input-number-increment">+</span>
												</div>
												<span class="dola">$ </span><span class="total">250.9</span>
											</div>

										</div>
										<div class="add-cart">
											<a href="#" class="btn-add-cart">Add to cart</a>
											<a href="#" class="list-icon icon-1"><i class="far fa-eye"></i></a>
											<a href="#" class="list-icon icon-2"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>

							</div>
							<div id="img-pill-4" class="tab-pane fade">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 title-quick">
										<figure class="fi-quick">
											<h1>QUICK VIEW</h1>
										</figure>
									</div>
									<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
										<img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 detail">
									<h1>Queen Rose - Yellow</h1>
									<p class="p1">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
									<div class="star">
										<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
										<span>10 Rating(s) | Add Your Rating</span>
									</div>
									<div class="prince"><span>$300.02</span><s class="strike">$250.9</s></div>
									<figure class="fi-option">
										<p class="option">Option</p>
									</figure>
									<div class="size">
										<span class="lb-size">Size <span class="sta-red">*</span></span><span class="lb-color">Color <span class="sta-red">*</span></span>
									</div>
									<div class="select-custom">
										<select>
											<option>S</option>
											<option>M</option>
											<option>L</option>
											<option>XL</option>
										</select>
										<a href="#"><span class="color-1"></span></a> <a href="#"><span class="color-2"></span></a> <a href="#"><span class="color-3"></span></a> <a href="#"><span class="color-4"></span></a>
										<p class="require">Required Fields <span>*</span></p>
										<div class="Quality">

											<div class="input-group input-number-group">
												<span class="text-qua">Quanty:</span>
												<div class="input-group-button">
													<span class="input-number-decrement">-</span>
												</div>
												<input class="input-number" type="number" min="0" max="1000" value="01">
												<div class="input-group-button">
													<span class="input-number-increment">+</span>
												</div>
												<span class="dola">$ </span><span class="total">250.9</span>
											</div>

										</div>
										<div class="add-cart">
											<a href="#" class="btn-add-cart">Add to cart</a>
											<a href="#" class="list-icon icon-1"><i class="far fa-eye"></i></a>
											<a href="#" class="list-icon icon-2"><i class="far fa-heart"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<ul class="nav nav-pills col-lg-6 col-md-6 col-sm-6 col-xs-12 img-pill">
							<li class="active col-lg-4 col-md-4 col-sm-4 col-xs-12"><a data-toggle="pill" href="#img-pill-1"><img src="<?= base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a data-toggle="pill" href="#img-pill-2"><img src="<?= base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a data-toggle="pill" href="#img-pill-3"><img src="<?= base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></li>
							<li class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><a data-toggle="pill" href="#img-pill-4"><img src="<?= base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></li>
						</ul>
					</div>

				</div>

			</div>
		</div>
		<!-- --------------------------- -->
		<div class="container">
			<h1>Category of Jenstore</h1>
			<ul class="nav nav-tabs menu-category">
				<li class="new-menu active"><a data-toggle="tab" href="#menu-tab-new" id="new-menu">New Arrivals</a>
					<figure id="new-2" class="hidden-xs"></figure>
				</li>
				<li class="shop-menu"><a data-toggle="tab" href="#menu-tab-shop">Shop</a>
					<figure id="shop-2" class="hidden-xs"></figure>
				</li>
				<li class="wedding-menu"><a data-toggle="tab" href="#menu-tab-wedding">Wedding</a>
					<figure id="wedding-2" class="hidden-xs"></figure>
				</li>
				<li class="holiday-menu"><a data-toggle="tab" href="#menu-tab-holiday">Holiday</a>
					<figure id="holiday-2" class="hidden-xs"></figure>
				</li>
				<li class="other-menu"><a data-toggle="tab" href="#menu-tab-other">Other</a>
					<figure id="other-2" class="hidden-xs"></figure>
				</li>
			</ul>
			<div class="row">
				<div class="tab-content">

					<!-- ------tab new---------------- -->
					<div id="menu-tab-new" class="tab-pane fade in active">


						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="sale"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>

									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Queen Rose - Pink</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Lavender</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Rose</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
						<!-- ------------------------------------------------ -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Elegant by BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Tulipa Floriade - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Winter White Bouquet</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Rose - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
					</div>
					<!-- ------------end new arrial---- -->
					<!-- ------------tab shop----------------- -->
					<div id="menu-tab-shop" class="tab-pane fade">


						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="sale"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Queen Rose - Pink</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Lavender</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Rose</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
						<!-- ------------------------------------------------ -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Elegant by BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Tulipa Floriade - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Winter White Bouquet</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Rose - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
					</div>
					<!-- -------------------------end tab shop--------------------- -->
					<!-- ------tab wedding---------------- -->
					<div id="menu-tab-wedding" class="tab-pane fade">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="sale"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-eye"></i></a>

									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Queen Rose - Pink</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Lavender</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="img/340x420.png" class="<?=base_url('front_template/img-responsive"')?> alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Rose</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
						<!-- ------------------------------------------------ -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="img/340x420.png" class="<?=base_url('front_template/img-responsive"')?> alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Elegant by BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Tulipa Floriade - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Winter White Bouquet</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Rose - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
					</div>
					<!-- ------------end wedding---- -->
					<!-- ------------tab holiday----------------- -->
					<div id="menu-tab-holiday" class="tab-pane fade">


						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="sale"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Queen Rose - Pink</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Lavender</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Rose</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
						<!-- ------------------------------------------------ -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Elegant by BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Tulipa Floriade - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Winter White Bouquet</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Rose - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
					</div>
					<!-- -------------------------end tab holiday--------------------- -->
					<!-- ------------tab other----------------- -->
					<div id="menu-tab-other" class="tab-pane fade">


						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="sale"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Queen Rose - Pink</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Lavender</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Bouquet Rose</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
						<!-- ------------------------------------------------ -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Elegant by BloomNation</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
								<div class="prince">$300.2<s class="strike">$250.9</s></div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Tulipa Floriade - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$160.8</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Winter White Bouquet</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$200.7</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 product-category">
							<div class="product-image-category">
								<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
								<div class="product-icon-category">
									<a href="#"><i class="far fa-eye"></i></a>
									<a href="#"><i class="fas fa-shopping-basket"></i></a>
									<a href="#"><i class="far fa-heart"></i></a>
								</div>
							</div>
							<div class="product-title-category">
								<h5><a href="#">Rose - Red</a></h5>
								<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
								<div class="prince">$350.4</div>
							</div>
						</div>
					</div>
					<!-- -------------------------end tab other--------------------- -->
				</div><!-- end tab content -->

			</div><!-- end row -->

		</div>
	</div>
	<!-- ------------------------- -->
	<div class="deal-day count">
		<h1>Deal of the day</h1>
		<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum<br class="hidden-xs"> passages and more recently with desktop publishing software</p>
		<div id="countdown">
			<div id='tiles'></div>
			<ul class="labels">
				<li>Days</li>
				<li>Hours</li>
				<li>Mins</li>
				<li>Secs</li>
			</ul>
		</div>
	</div>


<!-- 	<div class="container">
		<div class="row">
			<div class="product-slick slider">
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Lavender</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$160.8</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$200.7</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Rose</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$350.4</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<figure class="hot"><a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a></figure>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Fun & Flirty By BloomNation</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$200.7</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Lavender</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$160.8</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Lavender</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$160.8</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Lavender</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$160.8</div>
					</div>
				</div>
				<div class="product-slic">
					<div class="product-image-slic">
						<a href="#"><img src="<?=base_url('front_template/img/340x420.png')?>" class="img-responsive" alt="holiwood"></a>
						<div class="product-icon-slic">
							<a href="#"><i class="far fa-eye"></i></a>
							<a href="#"><i class="fas fa-shopping-basket"></i></a>
							<a href="#"><i class="far fa-heart"></i></a>
						</div>
					</div>
					<div class="product-title-slic">
						<h5><a href="#">Bouquet Lavender</a></h5>
						<div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></div>
						<div class="prince">$160.8</div>
					</div>
				</div>
			</div>
		</div>

	</div> -->



</main>