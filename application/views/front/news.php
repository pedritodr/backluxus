 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
     <div class="d-table">
         <div class="d-tablecell">
             <div class="container">
                 <div class="row">
                     <div class="col-md-6">
                         <h2>Noticias</h2>
                     </div>
                     <div class="col-md-6">
                         <div class="cleaning-breadcumb">
                             <a href="<?= site_url(); ?>">Inicio</a> / Noticias
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div> <!-- End Banner Area -->

 <!-- Start Blog Main Area -->
 <section class="cleaning-content-block gray-bg">
     <div class="container">
         <div class="row">


             <!-- Blog Main-content Sidebar -->
             <div class="col-lg-12 col-md-12">
                 <div class="row">
                     <?php foreach ($last_news as $item_noticia) {
                            $meses = [
                                '01' => 'ENE',
                                '02' => 'FEB',
                                '03' => 'MAR',
                                '04' => 'ABR',
                                '05' => 'MAY',
                                '06' => 'JUN',
                                '07' => 'JUL',
                                '08' => 'AGO',
                                '09' => 'SEP',
                                '10' => 'OCT',
                                '11' => 'NOV',
                                '12' => 'DIC'
                            ];

                            $separated_fecha = explode('-', $item_noticia->fecha_creacion);
                            ?>

                         <!-- Single Blog Item-->
                         <div class="col-lg-4">
                             <!-- Blog Item -->
                             <div class="blog-item wow fadeInUp">
                                 <a href="<?= site_url(strtolower('noticia/' . strtolower(seo_url($item_noticia->nombre)))); ?>" class="single-boxed-item">
                                     <div style="background-image: url(<?= $item_noticia->imagen; ?>);" class="boxed-preview blog-img-5"></div>
                                     <div class="date"><span><?= $separated_fecha[2]; ?></span><span><?= $meses[$separated_fecha[1]]; ?></span></div>
                                 </a>

                                 <div class="blog-text">
                                     <ul class="list-inline">

                                     </ul>
                                     <h3><?= $item_noticia->nombre; ?></h3>
                                     <?= $item_noticia->presentacion; ?>
                                 </div>

                                 <div class="post-share-area">
                                     <div class="row">
                                         <div class="col-lg-7">
                                             <ul class="list-inline">

                                             </ul>
                                         </div>
                                         <div class="col-lg-5 text-right">
                                             <a href="<?= site_url(strtolower('noticia/' . strtolower(seo_url($item_noticia->nombre)))); ?>" class="read-more-btn">Leer <i class="fa fa-arrow-circle-right"></i></a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <!-- End Blog Item -->
                         </div> <!-- End Single Blog Item-->
                     <?php } ?>

                 </div>


             </div>
             <!-- End Blog Main-content Sidebar -->
         </div>
     </div>
 </section>
 <!-- End Blog Main Area -->


 <!-- Start scroll to top feature -->
 <a href="#" id="back-to-top" title="Back to Top">
     <i class="fa fa-long-arrow-up"></i>
 </a>
 <!-- End scroll to top feature -->