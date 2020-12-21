<!DOCTYPE HTML>
<html lang="en-US">

<!-- Mirrored from demo.7uptheme.com/html/sport/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 May 2020 01:47:30 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($data_seo) ? $data_seo[1] : "Ranic"; ?></title>
    <?php
    if (isset($data_seo))
        meta_tags($e = $data_seo[0], $title = $data_seo[1], $desc = $data_seo[2], $imgurl = $data_seo[3], $url = $data_seo[4]);
    else
        meta_tags();
    ?>
    <!--    <meta name="description" content="Sport is new Html theme that we have designed to help you transform your store into a beautiful online showroom. This is a fully responsive Html theme, with multiple versions for homepage and multiple templates for sub pages as well" />
    <meta name="keywords" content="Sport,7uptheme" />
    <meta name="robots" content="noodp,index,follow" />
    <meta name='revisit-after' content='1 days' />
    <title>Ranic</title> -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/bootstrap.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/font-awesome.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/jquery.fancybox.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/bootstrap-theme.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/jquery-ui.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/owl.carousel.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/owl.transitions.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/owl.theme.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/slick.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/flipclock.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/animate.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/libs/hover.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/color.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/theme.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/responsive.css') ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('template/css/browser.css') ?>" media="all" />
    <!-- <link rel="stylesheet" type="text/css" href="css/rtl.css" media="all"/> -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicon/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicon/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicon/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicon/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicon/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicon/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicon/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicon/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicon/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('favicon/manifest.json') ?>">

    <script src="<?= base_url('template/ajax.googleapis.com/ajax/libs/jquery/1/jquery.js') ?>"></script>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

</head>
<style>
    /* Preloader CSS */

    .preloader-wrap {
        background: #fff none repeat scroll 0 0;
        height: 100%;
        position: fixed;
        width: 100%;
        z-index: 999999;
        left: 0;
        top: 0;
        text-align: center;
    }

    .d-table {
        display: table;
        width: 100%;
        height: 100%;
    }

    .d-table .d-tablecell {
        display: table-cell;
        vertical-align: middle;
    }
</style>
<script>
    jQuery(window).on('load', function() {
        jQuery(".preloader-wrap").fadeOut(500);
    });
</script>

<body class="boxed" style="background:#f5f5f5">
    <div class="preloader-wrap">
        <div class="d-table">
            <div class="d-tablecell">
                <video autoplay loop muted playsinline id="video_loading" width="269.8px" height="151.75px">
                    <source src="<?= base_url("assets/cargando.mp4"); ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
    <div class="wrap">
        <header id="header">
            <div class="header-main3">
                <div class="row">
                    <div class="col-sm-3 col-xs-7">
                        <div class="logo logo3">
                            <h1 class="hidden">Ranic</h1>
                            <a href="<?= site_url('portada') ?>"><img style="width:50%" src="<?= base_url('assets/ranic.png') ?>" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-5">
                        <div class="account-cart3 pull-right">
                            <ul class="list-inline-block top-menu inline-block">

                                <!-- 		<li><a href="#" class="title14 black">My Wishlist</a></li> -->
                                <!-- 	<li><a href="#" class="title14 black">Checkout</a></li> -->
                                <?php if ($this->session->userdata('role_id')) { ?>
                                    <li><a class="title14 black"> Hola, <?= $this->session->userdata('name') ?> </a></li>
                                    <li><a href="<?= site_url('perfil') ?>" class="title14 black">Mi cuenta</a></li>
                                    <li><a class="title14 black" href="<?= site_url('login/logout'); ?>"><?= translate("sign_out_lang"); ?></a></li>
                                <?php } else { ?>

                                    <li><a href="<?= site_url('login-register') ?>" class="title14 black">Iniciar sessión / Registrarse </a></li>
                                <?php  } ?>

                            </ul>
                            <div class="mini-cart-box inline-block">
                                <a onclick="irDetalleCarrito()" class="mini-cart-link title14" style="cursor:pointer">
                                    <span class="mini-cart-icon inline-block"><img src="<?= base_url('template/images/icons/icon-cart.png') ?>" alt="" /><sup id="sup_count" class="bg-color white round">0</sup></span>
                                    <span class="mini-cart-number  black inline-block">Carrito de compras</span>
                                </a>
                                <div id="contenedor_cart_header" class="mini-cart-content text-left">
                                    <h2 id="total_items_header" class="title18">(2) ITEMS IN MY CART</h2>
                                    <div id="body_cart_header"></div>
                                    <div class="mini-cart-total  clearfix">
                                        <strong class="pull-left title18">TOTAL</strong>
                                        <span id="total_carrito_header" class="pull-right color title18">$800.00</span>
                                    </div>
                                    <div class="mini-cart-button">
                                        <a style="padding:5px" onclick="vaciarCarrito()" class="mini-cart-view shop-button" href="#">Vaciar carrito</a>
                                        <a style="padding:5px" class="mini-cart-checkout shop-button" href="<?= site_url('cart-shopping') ?>">Ir al detalle</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Main -->
            <div class="header-nav3">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <nav class="main-nav main-nav3">
                            <ul class="list-none">
                                <li>
                                    <a href="<?= site_url('portada') ?>">Portada</a>
                                </li>
                                <!--  <li class="menu-item-has-children has-mega-menu">
                                    <a href="#">Elements</a>
                                    <div class="mega-menu">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-4 col-xs-12">
                                                <div class="mega-product">
                                                    <h2 class="title18 title-box5">Most review</h2>
                                                    <div class="list-mega-product">
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_1.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_2.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_3.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-4 col-xs-12">
                                                <div class="mega-product">
                                                    <h2 class="title18 title-box5">Special</h2>
                                                    <div class="list-mega-product">
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_4.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_5.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item-product table">
                                                            <div class="product-thumb">
                                                                <a href="detail.html" class="product-thumb-link zoom-thumb">
                                                                    <img src="images/photos/sport_6.jpg" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="product-info">
                                                                <h3 class="product-title title14"><a href="detail.html">Sport product Name</a></h3>
                                                                <div class="product-price">
                                                                    <del><span class="title14 silver">$798.00</span></del>
                                                                    <ins><span class="title14 color">$399.00</span></ins>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 hidden-sm hidden-xs">
                                                <div class="policy-sale">
                                                    <h2 class="title18 title-box5">Save on 50%</h2>
                                                    <p class="desc">Curabitur risus justo, scelerisque tiquensec tetur adipisicing eius mod dolore suspen disse eleme ntum lemenm</p>
                                                    <a href="#" class="shop-button">Read more</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-4 col-xs-12">
                                                <div class="banner-adv fade-out-in">
                                                    <a href="#" class="adv-thumb-link"><img src="images/menu/menu-thumb.jpg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                                <li>
                                    <a href="<?= site_url('shop') ?>">Tienda</a>
                                    <!--    <ul class="sub-menu">
                                        <li><a href="grid.html">Shop Grid</a></li>
                                        <li><a href="list.html">Shop List</a></li>
                                        <li><a href="detail.html">Product Detail</a></li>
                                        <li><a href="detail-with-sidebar.html">Detail with Sidebar</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="chekout.html">Checkout</a></li>
                                        <li><a href="member-login.html">Member/Login</a></li>
                                    </ul> -->
                                </li>
                                <!--    <li class="menu-item-has-children">
                                    <a href="blog.html">blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog.html">Blog Post</a></li>
                                        <li><a href="single.html">Single Post</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="<?= site_url('about') ?>">Acerca de nosotros</a></li>
                                <li><a href="<?= site_url('contacto') ?>">Contacto</a></li>
                            </ul>
                            <a href="#" class="toggle-mobile-menu"><span></span></a>
                        </nav>
                        <!-- End Main nav -->
                        <div class="wrap-language-search pull-right">
                            <div class="smart-search inline-block">
                                <span class="title14 search-label">buscar</span>
                                <div class="select-search-category">
                                    <button class="btn-search-cat"><span id="span_buscar_categoria">todas</span></button>
                                    <ul id="list_categorias_header" class="list-cat-search list-none">
                                        <?php if (isset($all_categorias)) { ?>
                                            <?php if (count($all_categorias) > 0) { ?>
                                                <?php foreach ($all_categorias as $item) { ?>
                                                    <li><a style="cursor:pointer" onclick="cargarCategoria('<?= base64_encode(json_encode($item)) ?>')"><?= $item->name ?></a></li>
                                                <?php } ?>
                                                <li><a id="categorias_todas" style="cursor:pointer;display:none;" onclick="cargarCategoriasTodas()">Todas</a></li>
                                            <?php } ?>
                                        <?php } ?>


                                    </ul>
                                </div>
                                <form id="form_busqueda" method="GET" action="<?= site_url('shop') ?>" class="smart-search-form">
                                    <input name="search" id="search" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''" value="buscar por productos" type="text">

                                    <input id="btn_search" value="" type="button">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->
        <!-- End Header -->