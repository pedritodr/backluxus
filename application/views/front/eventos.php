<div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	     <div class="breadcrumbs-wrap" data-bg="<?= base_url();?>assets_front/images/1920x280_bg2.jpg">

			<div class="container">
			
			<h1 class="page-title">Eventos del Colegio</h1>

			<ul class="breadcrumbs">

				<li><a href="<?= site_url();?>">Inicio</a></li>
				<li>Eventos</li>

			</ul>

			</div>

		</div>
	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

    	<div class="page-content-wrap">

    		<div class="container">
    			
    		

    			<h5 class="event-title">Lista de eventos</h5>

    			<div class="blog-type style-2 list-view event">

					
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
					foreach($eventos as $item){ 
						$separated = explode('-',$item->fecha); 
						?>
					<div class="welcome-item">

						<div class="welcome-inner">

							<div class="welcome-img">
								<img src="<?= base_url($item->photo);?>" alt="">
								<time class="entry-date" datetime="2016-08-20">
	    							<span><?= $separated[2];?></span><?= $meses[$separated[1]];?>
	    						</time>
							</div>

							<div class="welcome-content">

								<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
									<path d="M0 100 C40 0 60 0 100 100 Z"></path>
								</svg>

								<div class="entry">

									<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->    	

									<div class="entry-body">

										<h5 class="entry-title">
											<a><?= $item->name;?></a>
											<span class="label">$ <?= $item->costo;?></span>
										</h5>

										<div class="contact-info-menu">

				            				<div class="contact-info-item">
				            					<i class="icon-clock"></i>
				            					<span><?= $item->horario;?></span>
				            				</div>
				            				<div class="contact-info-item">
				            					<i class="icon-location"></i>
				            					<span><?= $item->lugar;?></span>
				            				</div>

				            			</div>

										<p>
											<?= $item->descripcion;?>
										</p>

										

									</div>

									<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->    	 

								</div>

							</div>

						</div>

					</div>

					<?php } ?>

				

				</div>

				

    		</div>

    	</div>

    </div>