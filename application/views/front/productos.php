<div class="pg-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 title">
                <h1>Shop</h1>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="b-crumbs pull-right"><a href="<?= site_url(); ?>">Home</a> <i class="arrow_carrot-right"></i> Shop</div>
            </div>
        </div>
    </div>
</div>

<!-- page body content begin -->
<div class="pg-body">
    <div class="container">

        <div class="row">
            <div class="col-md-12  cat-content">
                <a href="#"><img src="images/category/banner.jpg" alt=""></a>

                <div class="cat-view-options">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row no-gutter form-group">
                                <div class="col-md-4">
                                    <label class="cvo-label">Sort By</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control cvo-control s-styled hasCustomSelect" name="sortby">
                                        <option value="default">Default Sorting</option>
                                        <option value="price">Price</option>
                                        <option value="rating">Rating</option>
                                        <option value="popularity">Popularity</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <div class="row no-gutter form-group">
                                <div class="col-md-6">
                                    <label class="cvo-label">Show</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control cvo-control s-styled hasCustomSelect" name="items-per-page">
                                        <option value="12">12</option>
                                        <option value="18">18</option>
                                        <option value="24">24</option>
                                        <option value="33">33</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 cvo-availability-col">
                            <div class="form-group">
                                <select class="form-control cvo-control s-styled hasCustomSelect" name="avilability">
                                    <option value="">Avilability</option>
                                    <option value="available">Avilable</option>
                                    <option value="coming">Coming</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4 text-right">
                            <label class="cvo-label">View</label>
                            <div class="cvo-view-type" role="tablist">
                                <ul class="list-inline">
                                    <li class="active">
                                        <a href="#pl-grid" role="tab" data-toggle="tab" class="cvo-grid">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 50 50" xml:space="preserve">
                                                <rect x="0" y="0" width="20" height="20" />
                                                <rect x="30" y="0" width="20" height="20" />
                                                <rect x="0" y="30" width="20" height="20" />
                                                <rect x="30" y="30" width="20" height="20" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pl-list" role="tab" data-toggle="tab" class="cvo-list">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 30.263 25.6" xml:space="preserve">
                                                <rect width="7.732" height="6.398" />
                                                <rect y="9.6" width="7.732" height="6.4" />
                                                <rect y="19.199" width="7.732" height="6.398" />
                                                <rect x="10.933" y="9.602" width="19.33" height="6.4" />
                                                <rect x="10.933" y="19.199" width="19.33" height="6.4" />
                                                <rect x="10.933" width="19.33" height="6.4" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- cat-view-options -->

                <div class="cat-pagination">
                    <div class="row">
                        <div class="col-sm-6">
                            Items 1 to 15 of 150 total
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class="arrow_carrot-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="tab-content tab-no-style">
                    <div class="tab-pane fade in active" id="pl-grid">
                        <div class="products-list">
                            <div class="row">
                                <?php foreach ($all_products as $item) { ?>
                                    <?php foreach ($item->products as $product) { ?>
                                        <div class="col-md-4 col-sm-6 pl-item">
                                            <figure>
                                                <a href="<?= site_url('front/single_producto/' . $product->product_id); ?>">
                                                    <img src="<?= base_url($product->main_photo); ?>" alt="">
                                                </a>

                                                <figcaption>
                                                    <a href="#" class="pl-button pl-addcart" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="icon-bag"></i></a>
                                                    <a href="<?= site_url('front/single_producto/' . $product->product_id); ?>" class="pl-button pl-qview" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a>
                                                </figcaption>
                                            </figure>
                                            <div class="pl-caption">

                                                <p class="pl-name"><?= $product->name ?></p>

                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>




                            </div>
                        </div>
                    </div> <!-- grid list -->
                    <div class="tab-pane fade" id="pl-list">
                        <div class="products-listview">
                            <?php foreach ($all_products as $item) { ?>
                                <?php foreach ($item->products as $product) { ?>
                                    <div class="plv-item">
                                        <div class="row no-gutter">

                                            <div class="col-sm-4 plv-image">
                                                <figure>
                                                    <a href="<?= site_url('front/single_producto/' . $product->product_id); ?>" class="plv-w-backside">
                                                        <img src="<?= base_url($product->main_photo); ?>" alt="">
                                                        <span class="plv-backside">
                                                            <img src="<?= base_url($product->main_photo); ?>" alt="">
                                                        </span>
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="plv-body">
                                                    <div class="plv-header">
                                                        <div class="row">
                                                            <div class="col-xs-6 plv-title"><a href="<?= site_url('front/single_producto/' . $product->product_id); ?>"><?= $product->name ?></a></div>
                                                        </div>
                                                    </div>

                                                    <div class="plv-exerpt">
                                                        <?= $product->description ?>
                                                    </div>
                                                    <div class="plv-buttons">
                                                        <a href="#" class="btn btn-sec-col"><i class="icon-bag"></i> Add to Cart</a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- plv-item -->
                                <?php } ?>
                            <?php } ?>

                        </div> <!-- products-listview -->
                    </div> <!-- tab pl-list -->
                </div>

                <div class="cat-view-options">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row no-gutter form-group">
                                <div class="col-md-4">
                                    <label class="cvo-label">Sort By</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control cvo-control s-styled hasCustomSelect" name="sortby">
                                        <option value="default">Default Sorting</option>
                                        <option value="price">Price</option>
                                        <option value="rating">Rating</option>
                                        <option value="popularity">Popularity</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <div class="row no-gutter form-group">
                                <div class="col-md-6">
                                    <label class="cvo-label">Show</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control cvo-control s-styled hasCustomSelect" name="items-per-page">
                                        <option value="12">12</option>
                                        <option value="18">18</option>
                                        <option value="24">24</option>
                                        <option value="33">33</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 cvo-availability-col">
                            <div class="form-group">
                                <select class="form-control cvo-control s-styled hasCustomSelect" name="avilability">
                                    <option value="">Avilability</option>
                                    <option value="available">Avilable</option>
                                    <option value="coming">Coming</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4 text-right">
                            <label class="cvo-label">View</label>
                            <div class="cvo-view-type" role="tablist">
                                <ul class="list-inline">
                                    <li class="active">
                                        <a href="#pl-grid" role="tab" data-toggle="tab" class="cvo-grid">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 50 50" xml:space="preserve">
                                                <rect x="0" y="0" width="20" height="20" />
                                                <rect x="30" y="0" width="20" height="20" />
                                                <rect x="0" y="30" width="20" height="20" />
                                                <rect x="30" y="30" width="20" height="20" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#pl-list" role="tab" data-toggle="tab" class="cvo-list">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="14px" viewBox="0 0 30.263 25.6" xml:space="preserve">
                                                <rect width="7.732" height="6.398" />
                                                <rect y="9.6" width="7.732" height="6.4" />
                                                <rect y="19.199" width="7.732" height="6.398" />
                                                <rect x="10.933" y="9.602" width="19.33" height="6.4" />
                                                <rect x="10.933" y="19.199" width="19.33" height="6.4" />
                                                <rect x="10.933" width="19.33" height="6.4" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- cat-view-options -->

                <div class="cat-pagination">
                    <div class="row">
                        <div class="col-sm-6">
                            Items 1 to 15 of 150 total
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#"><i class="arrow_carrot-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div> <!-- cat-content -->

        </div>
        <div class="gap-70"></div>
    </div> <!-- container -->
</div> <!-- pg-body -->