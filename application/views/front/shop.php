<section id="content">
    <div class="container">
        <div class="bread-crumb">
            <!--  <a href="#" class="silver">Home</a><a href="#" class="silver">Men’s </a><span class="color">Tennis</span> -->
        </div>
        <div class="content-pages">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="sidebar-left sidebar-shop">
                        <div class="widget widget-category-icon">
                            <h2 class="title-widget title18">Categorias</h2>
                            <div class="list-cat-icon2">
                                <ul class="list-none">
                                    <?php if (isset($categorias)) { ?>
                                        <?php foreach ($categorias as $item) { ?>
                                            <li><a id="<?= $item->_id ?>" style="cursor:pointer" onclick="filterCategoria('<?= base64_encode(json_encode($item)) ?>')"><img src="<?= base_url($item->photo) ?>" alt=""><?= $item->name ?> <span class="silver">(<?= $item->cantidad_productos ?>)</span></a></li>
                                        <?php } ?>
                                    <?php } ?>


                                </ul>
                            </div>
                        </div>
                        <!-- End Widget -->
                        <div class="widget widget-filter">
                            <div class="filter-price">
                                <h3 class="title14">Precio</h3>
                                <div class="range-filter">
                                    <span class="currency-index">$</span>
                                    <span class="amount"></span>
                                    <button id="btn_filter_shop" class="btn-filter-price shop-button title14">Filtro</button>
                                    <div class="slider-range"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="content-shop shop-grid">
                        <div class="shop-title-box">
                            <h2 id="categoria_list" class="title18 title-box5"></h2>
                            <div class="view-type">

                            </div>
                        </div>
                        <!--   <div class="shop-banner banner-adv line-scale">
                            <a href="#" class="adv-thumb-link"><img src="images/shop/banner.jpg" alt="" /></a>
                        </div> -->
                        <div class="grid-shop-product">
                            <div class="row">
                                <?php if (isset($productos)) { ?>
                                    <?php if (count($productos) > 0) { ?>
                                        <?php foreach ($productos as $item) { ?>
                                            <div class="col-md-4 col-sm-6 col-xs-6">
                                                <div class="item-product text-center">
                                                    <div class="product-thumb">
                                                        <a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>" class="product-thumb-link zoom-thumb">
                                                            <img src="<?= base_url($item->main_photo) ?>" alt="">
                                                        </a>
                                                        <div class="product-extra-link">
                                                            <!--     <a href="#" class="wishlist-link"></a> -->
                                                            <?php $detalle = false; ?>
                                                            <a onclick="addCarrito('<?= base64_encode(json_encode($item)) ?>','<?= $detalle ?>')" style="cursor:pointer" class="addcart-link">Agregar al carrito</a>
                                                            <!--     <a href="#" class="compare-link"></a> -->
                                                        </div>
                                                        <a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>" class="quickview-link title14 fancybox">Ver detalles</a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h3 class="product-title title14"><a href="<?= site_url(strtolower(seo_url($item->name)) . '-' . strtolower(seo_url($item->codigo))); ?>"><?= $item->name ?></a></h3>
                                                        <div class="product-price">
                                                            <?php if ($item->price_old > 0) { ?>
                                                                <del><span class="title14 silver">$<?= number_format($item->price_old, 2) ?></span></del>
                                                            <?php } ?>
                                                            <ins><span class="title14 color">$<?= number_format($item->price, 2) ?></span></ins>
                                                        </div>
                                                        <div class="product-rate">
                                                            <div class="product-rating" style="width:100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <h2 class="text-center">No se han encotrado resultados</h2>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h2 class="text-center">No se han encotrado resultados</h2>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="sort-paginav pull-right">
                            <div class="pagi-bar">
                                <!--   <a href="#" class="current-page">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#" class="next-page">next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> -->
                                <?= $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    let text_search = null;
    let min = null;
    let max = null;
    let id_categoria = null;
    $(function() {

        text_search = '<?= $text_search ?>';
        select_categoria = '<?= $category ?>';
        id_categoria = '<?= $category_id ?>';
        min = '<?= $min ?>';
        max = '<?= $max ?>';
        if (select_categoria) {
            $('#span_buscar_categoria').text(select_categoria);
            if (id_categoria) {
                $('#' + id_categoria).css('color', '#1d336');
            }
            $('#categoria_list').text(select_categoria);
        }
        if (text_search) {
            $('#search').val(text_search);
        }
        if (min >= 0 && max > 0) {
            if ($(".range-filter").length > 0) {
                $(".range-filter").each(function() {
                    $(this)
                        .find(".slider-range")
                        .slider({
                            range: true,
                            min: 0,
                            max: 1000,
                            values: [min, max],
                            slide: function(event, ui) {
                                $(this)
                                    .parents(".range-filter")
                                    .find(".amount")
                                    .html(
                                        "<span>" +
                                        ui.values[0] +
                                        "</span>" +
                                        "<span>" +
                                        ui.values[1] +
                                        "</span>"
                                    );
                                min = ui.values[0];
                                max = ui.values[1];
                            },
                        });
                    $(this)
                        .find(".amount")
                        .html(
                            "<span>" +
                            $(this).find(".slider-range").slider("values", 0) +
                            "</span>" +
                            "<span>" +
                            $(this).find(".slider-range").slider("values", 1) +
                            "</span>"
                        );
                });
            }
        } else {
            if ($(".range-filter").length > 0) {
                $(".range-filter").each(function() {
                    $(this)
                        .find(".slider-range")
                        .slider({
                            range: true,
                            min: 0,
                            max: 1000,
                            values: [0, 1000],
                            slide: function(event, ui) {
                                $(this)
                                    .parents(".range-filter")
                                    .find(".amount")
                                    .html(
                                        "<span>" +
                                        ui.values[0] +
                                        "</span>" +
                                        "<span>" +
                                        ui.values[1] +
                                        "</span>"
                                    );
                                min = ui.values[0];
                                max = ui.values[1];
                            },
                        });
                    $(this)
                        .find(".amount")
                        .html(
                            "<span>" +
                            $(this).find(".slider-range").slider("values", 0) +
                            "</span>" +
                            "<span>" +
                            $(this).find(".slider-range").slider("values", 1) +
                            "</span>"
                        );
                });
            }
        }
        $('#btn_filter_shop').click(function() {
            if (select_categoria != "Todas") {
                $('#form_busqueda').append(' <input id="cat" type="hidden" name="cat" value="' + select_categoria + '">');
            }
            if (min >= 0 && max > 0) {
                $('#form_busqueda').append('<input id="min" type="hidden" name="min" value="' + min + '"> <input id="max" type="hidden" name="max" value="' + max + '">');

            }
            $('#form_busqueda').submit();
        });
    })

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