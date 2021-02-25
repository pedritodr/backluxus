<div id="content">

<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

<div class="breadcrumbs-wrap">

  <div class="container">
    
    <h1 class="page-title">Servicios del Colegio</h1>

    <ul class="breadcrumbs">

      <li><a href="<?= site_url();?>">Inicio</a></li>
      <li>Servicios</li>

    </ul>

  </div>

</div>

<!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

<div class="page-section type2">

    <div class="container">
        
       

        <div class="services fx-col-3">
                
            <?php foreach($all_services as $item_service){ ?>
            <!-- service item -->
            <div class="service-col">
                
                <div class="service-item">
                    <img src="<?= base_url($item_service->imagen);?>" alt="">
                    <div class="service-inner">
                        <h4><?= $item_service->nombre;?></h4>
                       <?= $item_service->descripcion;?>
                        
                    </div>
                </div>

            </div>
            <?php } ?>

          

        </div>

    </div>

</div>



</div>