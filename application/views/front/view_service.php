<section id="breadcrumb" class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 breadcrumb-block">
                <h2>Servicio: <?= $service->nombre?></h2>
            </div>
            <div class="col-sm-6 breadcrumb-block text-right">
                <ol class="breadcrumb">
                    <li><span>Usted está en: </span><a href="<?= base_url();?>">Inicio</a></li>
                    <li class="active">Servicios</li>
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
                        
                        <div class="blog-content">
                            <img src="<?= base_url($service->imagen);?>" alt="single blog" style="width: auto;float: left;height: 200px;margin-right: 20px;">
                            <div class="icon pull-left">
                                <i class="fa fa-link"></i>
                            </div>
                            <div class="blog-info">
                                <h2><a href="#"><?= $service->nombre?></a> </h2>

                            </div>
                            <p><?= $service->descripcion?></p>
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
                            
                            <div style="40px" class="clearfix">
                                <div class="pull-right">
                                    Quieres saber más?
                                    <a target="_blank" class="messenger" href="https://m.me/datalabcentersoft">Facebook</a>
                                    <a target="_blank" class="whatsapp" href="https://api.whatsapp.com/send?phone=593998724637">WhatsApp</a>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
