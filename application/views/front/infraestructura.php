<div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Conozca la infraestructura del colegio</h1>

	        <ul class="breadcrumbs">

	          <li><a href="<?= site_url();?>">Inicio</a></li>
	          <li>Infraestructura</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

		<?php 
		$cont = 0;
		foreach($areas as $item){ ?>
		
			<?php if($cont % 2 == 0){ ?>
		<!-- page section -->
		<div class="section-with-img-right page-section-bg fx-col-2">

			<div class="text-section">

    			
    			<div class="text-wrap">
    				<p><?= $item->texto;?> </p>
    				
    			</div>

    		</div>

    		<div class="img-section">
    			<img src="<?= base_url($item->photo);?>" alt="">
    		</div>
	        
		</div>
			<?php }else{?>

	    <!-- page section -->
		<div class="section-with-img-left fx-col-2">

			<div class="img-section">
    			<img src="<?= base_url($item->photo);?>" alt="" align="right">
    		</div>

			<div class="text-section">

    			
    			<div class="text-wrap">
    				<p><?= $item->texto;?></p>
    				
    			</div>

    		</div>
	        
		</div>
			<?php } ?>			
		
		<?php 
		$cont++;
		} ?>

	    

	  

    </div>