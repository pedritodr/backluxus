<div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap" data-bg="<?= base_url();?>assets_front/images/1920x280_bg2.jpg">

	      <div class="container">
	        
	        <h1 class="page-title">Documentos</h1>

	        <ul class="breadcrumbs">

	          <li><a href="<?= site_url();?>">Inicio</a></li>
	          <li>Documentos</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <div class="page-content-wrap">
    		<div class="container">       
					
				<?php foreach($docs as $item){ ?>
				<div class="row" style="margin-top:15px;">
					
					<div class="col-lg-12">
							<h3><?= $item->name;?></h3>
							<hr/>
							<p><?= $item->texto;?></p>
							<a href="<?= site_url('front/descargar/'.$item->documento_id);?>" class="btn btn-default">Descargar archivo</a>
							<hr />
					</div>
					
					
				</div>
				
				<?php } ?>	
		    </div>

    	</div>

    </div>