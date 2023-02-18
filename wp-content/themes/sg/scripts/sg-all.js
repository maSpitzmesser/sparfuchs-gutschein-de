jQuery("img[data-src]").unveil(200);

jQuery('.side-nav').singlePageNav();
jQuery('#navi-right').singlePageNav();


var current_href = jQuery(location).attr('href');
var pathname     = jQuery(location).attr('pathname');

jQuery('.c li').each(function(l){
  jQuery(this).on("click",{x:l},function(event){

    var OfferId   = jQuery(this).data('offer-id');
    var Publisher = jQuery(this).data('publisher');

    setTimeout(function(){
      window.location.replace("https://sparfuchs-gutschein.de/go/" + Publisher + "?id=" + OfferId);
    }, 200);

    /*window.open("https://sparfuchs-gutschein.de/go/" + Publisher + "?id=" + OfferId, "_parent");*/
    window.open('https://sparfuchs-gutschein.de' + pathname + '#' + Publisher + '!' + OfferId, "_blank");
  });
});


var fullhash = location.hash.split('#')[1];
if(typeof fullhash != "undefined"){
  var URLOfferId   = fullhash.split('!')[1];
  var URLPublisher = fullhash.split('!')[0];
}

if(typeof fullhash != "undefined"){
  jQuery(document).ready(function () {
    jQuery.fancybox({
      type: 'iframe',
      width : 650,
      href: '/go/layer-' + URLPublisher + '?id=' + URLOfferId
    });
  });
}







// clickable li as link
/*
	jQuery('.c li').each(function(l){
		jQuery(this).on("click",{x:l},function(event){


			var OfferId   = jQuery(this).data('offer-id');
			var Publisher = jQuery(this).data('publisher');

			window.open('/go/' + Publisher + '?id=' + OfferId);

			jQuery('.c li, .c li .b').fancybox({
				type: 'iframe',
				width : 650,
				href: '/go/layer-' + Publisher + '?id=' + OfferId
			});

		});
	});	*/
	
	jQuery("ul.cs li, ul.g li").click(function(event){
		window.location = jQuery(this).find('a:first').attr('href');
		return false;
	});



// lazy load youtube
;(function ($) { 
    function setUp($el) {
        var youtube_id = $el.data('youtube-id');
        $el.on('click', function (e) {
            e.preventDefault();
            if ($el.hasClass('preview')) {
                $el.html('<iframe src="https://www.youtube.com/embed/' + youtube_id + '?autoplay=1&rel=0"></iframe>');
                $el.removeClass('preview');
            }
        });
    };
    $.fn.lazyYT = function () {
        return this.each(function () {
            var $el = $(this);
            setUp($el);
        });
    };
}(jQuery));
jQuery('.lazy-video').lazyYT();




jQuery(window).scroll(function(){
  if (jQuery(this).scrollTop() > 700){
    if (jQuery('.scroll-to-top').length < 1 ){
      jQuery('body').append('<a class="scroll-to-top hidden" href="#"> nach oben &uarr;</a>');
      appended = true;
    }

  }
  if (jQuery(this).scrollTop() > 700){		
    jQuery('a.scroll-to-top').removeClass('hidden').fadeIn();		
	} 
	else if (jQuery(this).scrollTop() < 700) {
		jQuery('a.scroll-to-top').fadeOut();
	}
});


jQuery('.top').click(function(){
  jQuery('html, body').animate({scrollTop : 0},800);
  return false;
});	



jQuery(".lightbox-open-450").fancybox({
  type: 'iframe',
  width : 450
});	
jQuery(".lightbox-open").fancybox({
  type: 'iframe',
  width : 980
});

jQuery(function () {
  jQuery('#slideshow').slick({
    dots: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 4000
  });



  jQuery('.sl-logos.carousel').slick({
    dots: true,
    infinite: false,
    speed: 300,
    autoplaySpeed: 4000,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }      
    ]
  });

});