 <!-- Banner Area -->
 <div class="cleaning-mini-banner">
            <div class="d-table">
                <div class="d-tablecell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>FAQs</h2>
                            </div>
                            <div class="col-md-6">
                                <div class="cleaning-breadcumb">
                                   <a href="<?= site_url();?>">Inicio</a> / FAQs
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Banner Area -->
 
        <!-- Start Main Content Area -->
        <section class="faq-section">
            <div class="container">
               <div class="row"> 
                    <div class="col-lg-12"> 
                        <div class="faq-header">Preguntas y respuestas frecuentes</div>
												
												<?php foreach($faqs as $item){ ?>
												<div class="faq-c wow fadeInUp">
                            <div class="faq-q"><span class="faq-t">+</span><?= $item->pregunta;?></div>
                            <div class="faq-a">
                                <p><?= $item->respuesta;?></p> 
                                
                            </div>
												</div>
												<?php } ?>

                       
                    </div>
                </div>
            </div>
        </section>
        <!-- End Main Content Area -->
        
                
        <!-- Start scroll to top feature -->
        <a href="#" id="back-to-top" title="Back to Top">
            <i class="fa fa-long-arrow-up"></i>
        </a>
        <!-- End scroll to top feature -->