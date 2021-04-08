(function ($) {
 "use strict";

 	$(".search-icon").on("click", function(){
		$(".header-search").slideToggle();
	})
	
 	$(".menu-icon").on("click", function(){
		$(".mainmenu").css('right' , '0').addClass('animated Toggle');
	})
 	$(".menu-close").on("click", function(){
		$(".mainmenu").css('right' , '-400px').removeClass('animated Toggle');
	})
/*-----------------
	liScroll
 ------------------*/
	$("ul#ticker01").liScroll({travelocity: 0.12});
 
 
/*----------------------------------
	Slider
-----------------------------------*/
 $('.slider-active').owlCarousel({
    loop:true,
	autoplay:false,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
}) /*----------------------------------
	brand-active
-----------------------------------*/
 $('.brand-active').owlCarousel({
    loop:true,
	autoplay:false,
	nav:true,
	navText:["<i class='fa fa-angle-right'></i>","<i class='fa fa-angle-left'></i>"],	
    responsive:{
        0:{
            items:1
        },
        480:{
            items:2
        },
        767:{
            items:4
        },
        1000:{
            items:5
        }
    }
})  
/*----------------------------------
	Slider
-----------------------------------*/
 $('.news-running').owlCarousel({
    loop:true,
	autoplay:true,
    nav:false,
	autoplayTimeout:5000,
	autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        },
        1200:{
            items:3
        }
    }
}) 
/*--------------------------
 scrollUp
---------------------------- */	
$.scrollUp({
	scrollText: '<i class="fa fa-angle-double-up "></i>',
	easingType: 'linear',
	scrollSpeed: 900,
	animation: 'fade'
}); 


/*----------------------------------
	instagram-slider-active
-----------------------------------*/
 $('.instagram-slider-active').owlCarousel({
    loop:true,
	autoplay:true,
	margin:30,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        300:{
            items:2
        },
        767:{
            items:4
        },
        1000:{
            items:6
        }
    }
}) 

	
/*----------------------------
 jQuery MeanMenu
------------------------------ */
	jQuery('#mobile-menu-active').meanmenu();
	
	
	
	
	
$('.grid').imagesLoaded( function() {
	

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item',
  percentPosition: true,
  masonry: {
    // use outer width of grid-sizer for columnWidth
    columnWidth: '.grid-item',
  }
});


});	
		
	
/*--
    Magnific Popup
    ------------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        zoom: {
            enabled: true,
        }
    });	
	
/*--
Magnific Popup
------------------------*/
$('.img-poppu').magnificPopup({
    type: 'image',
    gallery:{
        enabled:true
    }
});	
	
	
	
	
	
})(jQuery);  