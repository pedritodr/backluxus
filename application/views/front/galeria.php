<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


<style>
.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>

<div id="content">



<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

 <div class="breadcrumbs-wrap" data-bg="<?= base_url();?>assets_front/images/1920x280_bg2.jpg">

	<div class="container">
	
	<h1 class="page-title">Galería de imágenes del colegio</h1>

	<ul class="breadcrumbs">

		<li><a href="<?= site_url();?>">Inicio</a></li>
		<li>Galería</li>

	</ul>

	</div>

</div>
<!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

<div class="page-content-wrap">

	<div class="container">
		
	

		<h5 class="event-title">Galería de imágenes</h5>

		
		<div class="container">
	<div class="row">
		<div class='list-group gallery'>
			<?php foreach($gallery as $item){ ?>
			<div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="<?= base_url($item->image);?>">
                    <img class="img-responsive" alt="" src="<?= base_url($item->image);?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?= $item->texto;?></small>
                    </div> <!-- text-right / end -->
                </a>
			</div> <!-- col-6 / end -->
			<?php } ?>            
            
        </div> <!-- list-group / end -->
	</div> <!-- row / end -->
</div> <!-- container / end -->
		

	</div>

</div>

</div>

  <script>
    $(document).ready(function(){
		$(".fancybox").fancybox({
			openEffect: "none",
			closeEffect: "none"
    	});
    });
	</script>






