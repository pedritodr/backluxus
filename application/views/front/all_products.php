<!--Breadcrumb-->
<section id="breadcrumb" class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 breadcrumb-block">
                <h2>Productos</h2>
            </div>
            <div class="col-sm-6 breadcrumb-block text-right">
                <ol class="breadcrumb">
                    <li><span>Usted está en: </span><a href="<?= base_url();?>">Inicio</a></li>
                    <li class="active">Productos</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!--Portfolio-->
<section id="portfolio" class="space bg-color">
    <div class="container">
        <div class="row">
            <div id="mod-sp-simpleportfolio" class="sp-simpleportfolio sp-simpleportfolio-view-items layout-default ">
                <div class="sp-simpleportfolio-filter">
                    <ul>
                        <li class="active" data-group="all"><a href="#">Todos</a></li>
                        <?php if(isset($all_cats))
                            foreach ($all_cats as $cat) { ?>
                                <li data-group="<?= $cat->nombre?>"><a href="#"><?= $cat->nombre?></a></li>
                            <?php } ?>
                    </ul>
                </div>
                <div class="sp-simpleportfolio-items sp-simpleportfolio-columns-3">
                  <?php if(isset($all_productos))
                      foreach ($all_productos as $item)
                      {
                      ?>  
                    <div class="sp-simpleportfolio-item" data-groups='<?= $item->cats?>'>
                        <div class="sp-simpleportfolio-overlay-wrapper clearfix">
                            <img class="sp-simpleportfolio-img" src="<?= base_url($item->imagen)?>" alt="A long beer">
                            <div class="sp-simpleportfolio-overlay">
                                <div class="sp-vertical-middle">
                                    <div>
                                        <div class="sp-simpleportfolio-btns">
                                            <a class="btn-zoom" href="<?= base_url($item->imagen)?>" data-featherlight="image">Aumentar</a>
                                            <a class="btn-view" href="<?= base_url('/'.strtolower(seo_url($item->nombre)))?>">Ver</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sp-simpleportfolio-info">
                            <h3 class="sp-simpleportfolio-title">
                                <a href="<?= base_url('/'.strtolower(seo_url($item->nombre)))?>"><?= $item->nombre?></a>
                            </h3>
                            <div class="sp-simpleportfolio-tags"><?= $item->descripcion?></div>
                        </div>
                    </div>
                  <?php } ?>  
                </div>
            </div>
        </div>
    </div>
</section>
