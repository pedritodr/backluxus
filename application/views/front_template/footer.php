	<!-- End Content -->
	<footer id="footer">
		<div class="footer">
			<!--  <div class="main-footer">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-3 col-sm-6 col-xs-12">
	                        <div class="footer-box">
	                            <h2 class="title14 black">My account</h2>
	                            <ul class="list-none menu-foter">
	                                <li><a href="#">My Orders</a></li>
	                                <li><a href="#">My Credit Slips</a></li>
	                                <li><a href="#">My Addresses</a></li>
	                                <li><a href="#">My Personal Info</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-md-3 col-sm-6 col-xs-12">
	                        <div class="footer-box">
	                            <h2 class="title14 black">Orders</h2>
	                            <ul class="list-none menu-foter">
	                                <li><a href="#">Payment options</a></li>
	                                <li><a href="#">Shipping and delivery</a></li>
	                                <li><a href="#">Returns</a></li>
	                                <li><a href="#">Shipping</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-md-3 col-sm-6 col-xs-12">
	                        <div class="footer-box">
	                            <h2 class="title14 black">Information</h2>
	                            <ul class="list-none menu-foter">
	                                <li><a href="#">Specials</a></li>
	                                <li><a href="#">New Products</a></li>
	                                <li><a href="#">Best Sellers</a></li>
	                                <li><a href="#">Our Stores</a></li>
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-md-3 col-sm-6 col-xs-12">
	                        <div class="footer-box">
	                            <h2 class="title14 black">Contact us</h2>
	                            <p class="desc contact-info-footer"><span class="silver"><i class="fa fa-map-marker" aria-hidden="true"></i></span>Sesam Street 323b, 4010, Norway Country: USA</p>
	                            <p class="desc contact-info-footer"><span class="silver"><i class="fa fa-phone" aria-hidden="true"></i></span>003 118 4563 560</p>
	                            <p class="desc contact-info-footer"><span class="silver"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><a href="maillto:support247@storename.com">support247@storename.com</a></p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div> -->
			<!-- End Main Footer -->
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<div style="color:#fff" class="col-md-6 col-sm-6 col-xs-12">
							<a href="<?= site_url('portada') ?>"><img style="width:25%;margin-bottom:2%" src="<?= base_url('assets/ranic_blanco.png') ?>" alt="" /></a>
							<p><strong>&copy; <?= date("Y"); ?> <a style="color:#fff" href="<?= site_url(); ?>"> Ranic</a>.</strong> Todos los derechos reservados.</p>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p style="color:#fff" class="desc contact-info-footer"><span class="silver"><i class="fa fa-map-marker" aria-hidden="true"></i></span><?= $empresa_object->address ?></p>
							<p style="color:#fff" class="desc contact-info-footer"><span class="silver"><i class="fa fa-phone" aria-hidden="true"></i></span><?= $empresa_object->phone ?></p>
							<p style="color:#fff" class="desc contact-info-footer"><span class="silver"><i class="fa fa-envelope-o" aria-hidden="true"></i></span><a style="color:#fff" href="maillto:<?= $empresa_object->email ?>"><?= $empresa_object->email ?></a></p>


							<div class="social-network">

								<a target="_black" href="<?= $empresa_object->facebook ?>" class="float-shadow"><i style="font-size: 31px;" class="fa fa-facebook" aria-hidden="true"></i></a>
								<a target="_black" href="<?= $empresa_object->instagram ?>" class="float-shadow"><i style="font-size: 31px;" class="fa fa-instagram" aria-hidden="true"></i></a>
							</div>


						</div>
					</div>
				</div>
			</div>
			<!-- End Footer Bottom -->
		</div>
	</footer>
	<div id="fixedbutton">

		<a title="Contáctenos vía Whatsapp" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $empresa_object->whatsapp; ?>"><img style="max-height: 50px;max-width: 50px" src="<?= base_url("assets/w.png") ?>"></a>
	</div>
	<!-- End Footer -->
	<div class="wishlist-mask">
		<div class="wishlist-popup">
			<span class="popup-icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
			<p class="wishlist-alert">"Sport Product" was added to wishlist</p>
			<div class="wishlist-button">
				<a href="#">Continue Shopping (<span class="wishlist-countdown">10</span>)</a>
				<a href="#">Go To Shopping Cart</a>
			</div>
		</div>
	</div>
	<!-- End Wishlist Mask -->
	<a style="font-size:30px" href="#" class="scroll-top rect"><i class="fa fa-angle-up" aria-hidden="true"></i><span></span></a>
	</div>

	<script src="<?= base_url('template/js/libs/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery.fancybox.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery-ui.min.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/owl.carousel.min.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery.jcarousellite.min.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery.elevatezoom.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery.mCustomScrollbar.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/jquery.bxslider.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/slick.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/popup.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/flipclock.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/wow.js') ?>"></script>
	<script src="<?= base_url('template/js/libs/alert_notificacion.js') ?>"></script>
	<script src="<?= base_url('template/js/theme.js') ?>"></script>
	<script src="<?= base_url('template/js/carrito.js') ?>"></script>
	<script src="<?= base_url('template/js/main.js') ?>"></script>
	<script>
		let select_categoria = "Todas";
		let site_url = '<?= site_url() ?>';
		let base_url = '<?= base_url() ?>';

		function cargarCategoria(params) {
			let obj = atob(params);
			obj = JSON.parse(obj);
			select_categoria = obj.name;
			$('#span_buscar_categoria').text(obj.name);
			$('#categorias_todas').show();
		}

		function cargarCategoriasTodas() {
			$('#span_buscar_categoria').text('Todas');
			$('#categorias_todas').hide();
			select_categoria = "Todas";
		}
		$('#btn_search').click(function() {

			//evt.preventDefault();
			if (select_categoria != "Todas") {
				$('#form_busqueda').append(' <input id="cat" type="hidden" name="cat" value="' + select_categoria + '">');
			}
			$('#form_busqueda').submit();
		})
	</script>

	<style>
		#fixedbutton {
			position: fixed;
			z-index: 33;
			bottom: 25%;
			right: -10px;
			border-radius: 20px 0 0 20px;
			padding: 10px;
		}
	</style>