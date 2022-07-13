$(document).ready(function(slickSlide){
    $('.mockups').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      draggable: true,
      dots: true,
      arrows: true,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
          }
        }
      ]
    });
  });