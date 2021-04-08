<!-- Banner Area -->
<div class="cleaning-mini-banner">
            <div class="d-table">
                <div class="d-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Noticia</h2>
                            </div>
                            <div class="col-sm-6">
                                <div class="cleaning-breadcumb">
                                   <a href="<?= site_url();?>">Inicio</a> / Noticia
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Banner Area -->
        
        <!-- Start Main Content Area -->
        <section class="cleaning-content-block gray-bg">
            <div class="container">
                <div class="row">
                    <!-- Blog Right Sidebar -->
                    <div class="col-lg-4">
                                                
                        <!-- Recent Post -->
                        <div class="widget recent_posts">
                            <h3 class="widget-title">Noticias recientes</h3>
                            <ul class="list-unstyled">
                                <?php foreach($noticias as $item_noticia){ 
                                    $meses1 = [
                                        '01'=>'ENE',
                                        '02'=>'FEB',
                                        '03'=>'MAR',
                                        '04'=>'ABR',
                                        '05'=>'MAY',
                                        '06'=>'JUN',
                                        '07'=>'JUL',
                                        '08'=>'AGO',
                                        '09'=>'SEP',
                                        '10'=>'OCT',
                                        '11'=>'NOV',
                                        '12'=>'DIC'
                                ];
		
                                $separated_fecha1 = explode('-',$item_noticia->fecha_creacion);
                                    ?>
                                    <?php if($item_noticia->noticia_id != $new->noticia_id){ ?>
                                <li>
                                    <a href="<?= site_url(strtolower('noticia/'.strtolower(seo_url($item_noticia->nombre))));?>"><?= $item_noticia->nombre;?> <span><?= $separated_fecha1[2];?> <?= $meses1[$separated_fecha1[1]];?>, <?= $separated_fecha1[0];?></span></a>
                                </li>
                                    <?php } ?>
                                <?php } ?>
                                
                            </ul>
                        </div> <!-- End Recent Post -->
                        
                    </div> 
                    <!-- Blog Right Sidebar -->
                    
                    <!-- Blog Main-content area -->
                    <div class="col-lg-8">
                        <div class="post-details-area">
                            <div class="">
                                <div class="">
                                    <a class="lightbox-gallery" href="<?= base_url($new->imagen);?>"><img style="width:100%;" src="<?= base_url($new->imagen);?>" alt="Image"></a>
                                </div>

                              
                            </div>
                            
                            <div class="post-description">
                                <ul class="list-inline">
                                    <?php 
                                $meses = [
                                        '01'=>'ENE',
                                        '02'=>'FEB',
                                        '03'=>'MAR',
                                        '04'=>'ABR',
                                        '05'=>'MAY',
                                        '06'=>'JUN',
                                        '07'=>'JUL',
                                        '08'=>'AGO',
                                        '09'=>'SEP',
                                        '10'=>'OCT',
                                        '11'=>'NOV',
                                        '12'=>'DIC'
                                ];
		
                                $separated_fecha = explode('-',$new->fecha_creacion);
															?>
                                    <li><a href="#"><i class="fa fa-calendar"></i> <?= $separated_fecha[2];?> <?= $meses[$separated_fecha[1]];?></a></li>
                                    
                                </ul>
                                <h2><?= $new->nombre;?></h2>
                                    <?= $new->presentacion;?>
                                    <hr />
                                    <?= $new->cuerpo;?>
                                </div>
                            
                            <div class="post-share-area">
                                <div class="row">
                                   <div class="col-md-5">
                                        <a href="<?= site_url('noticias');?>" class="read-more-btn"><i class="fa fa-arrow-circle-left"></i> Regresar a la lista</a>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <ul class="list-inline">
                                            
                                       </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
     
                      
                    </div>
                    <!-- End Blog Main-content area -->
                </div>
            </div>
        </section>
        <!-- End Main Content Area -->
        
        
        
        <!-- Start scroll to top feature -->
        <a href="#" id="back-to-top" title="Back to Top">
            <i class="fa fa-long-arrow-up"></i>
        </a>
        <!-- End scroll to top feature -->