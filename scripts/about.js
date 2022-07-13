
   /*
    |--------------------------------------------------------
    | Slideshow - About
    |--------------------------------------------------------
    */

    $(document).ready(function(slickSlide){
        $('.slideshow-container').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          draggable: false,
          swipe: false,
          swipeToSlide: false,
          cssEase: 'linear',
          arrows: false,
        });
    });
