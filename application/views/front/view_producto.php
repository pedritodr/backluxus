<section id="breadcrumb" class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 breadcrumb-block">
                <h2>Producto: <?= $producto->nombre?></h2>
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
<!--Blog-->
<section id="blog" class="space-100 single">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 blog-base">
                <div class="col-sm-12 no-padding">
                    <article class="col-sm-12 no-padding blog-block">
                        <section id="list-feature">
                            <div class="container">
                                <div class="row">
                                    <div class="row">
                                    <div class="col-sm-4 fec-block">
                                        <a href="<?= base_url('/'.strtolower(seo_url($producto->nombre)))?>"><img src="<?= base_url($producto->imagen);?>" alt="Feature"></a>
                                    </div>
                                    <div class="col-sm-4 fec-block space-top">
                                        <?php
                                        $top = 3;
                                        for ($i=0;$i<count($producto_caract);$i++){ ?>
                                            <div class="fec-item col-sm-12 no-padding">
                                                <div class="icon"><i class="fa <?= $producto_caract[$i]->icon ?>"></i> </div>
                                                <div class="fec-item-body">
                                                    <h5><?= $producto_caract[$i]->nombre ?></h5>
                                                    <p><?= $producto_caract[$i]->descripcion ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            if($i == $top)
                                                break;
                                        }?>

                                    </div>
                                    <div class="col-sm-4 fec-block space-top">
                                        <?php
                                        $top *= 2;
                                        for ($j=$i+1;$j<count($producto_caract);$j++){ ?>
                                            <div class="fec-item col-sm-12 no-padding">
                                                <div class="icon"><i class="fa <?= $producto_caract[$j]->icon ?>"></i> </div>
                                                <div class="fec-item-body">
                                                    <h5><?= $producto_caract[$j]->nombre ?></h5>
                                                    <p><?= $producto_caract[$j]->descripcion ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            if($j == $top)
                                                break;
                                        }?>
                                    </div>

                                </div>
                                </div>

                            </div>
                        </section>
                        <div class="blog-content">
                            <div class="icon pull-left">
                                <i class="fa fa-link"></i>
                            </div>
                            <div class="blog-info">
                                <h2><a href="#"><?= $producto->nombre?></a> </h2>

                            </div>
                            <p><?= $producto->descripcion?></p>
                            <!-- <div class="col-sm-12 no-padding visiter-area">
                               - <div class="rating col-sm-6 no-padding">
                                     <div class="post_rating" id="post_vote_4">
                                         Rating:
                                         <div class="voting-symbol sp-rating">
                                             <span class="star" data-number="5"></span>
                                             <span class="star active" data-number="4"></span>
                                             <span class="star active" data-number="3"></span>
                                             <span class="star active" data-number="2"></span>
                                             <span class="star active" data-number="1"></span>
                                         </div>
                                         <span class="ajax-loader fa fa-spinner fa-spin"></span>
                                         <span class="voting-result">You have already rated this entry!</span>
                                     </div>
                                </div>
                                <div class="col-sm-12 text-right">
                                    <ul class="socials">
                                        <li>
                                            <a class="facebook" data-toggle="tooltip" data-placement="top" title="" data-original-title="Share On Facebook" href="<?= base_url();?>front_t/#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a class="twitter" data-toggle="tooltip" data-placement="top" title="" data-original-title="Share On Twitter" href="<?= base_url();?>front_t/#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a class="gplus" data-toggle="tooltip" data-placement="top" href="<?= base_url();?>front_t/#" data-original-title="Share On Google Plus"><i class="fa fa-google-plus"></i></a>
                                        </li>

                                        <li>
                                            <a class="linkedin" data-toggle="tooltip" data-placement="top" href="<?= base_url();?>front_t/#" data-original-title="Share On Linkedin"><i class="fa fa-linkedin-square"></i></a>
                                        </li>
                                    </ul>
                                </div>-->
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
