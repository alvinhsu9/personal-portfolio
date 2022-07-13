jQuery(function($) {

  var windowWidth = $('body').width();

  /*
  |----------------------------------------------------------------
  | Hide/Show Header
  |----------------------------------------------------------------
  */
  var didScroll;
  var lastScrollTop = 0;
  var delta = 5;
  var navbarHeight = $('header').outerHeight();
  var projectAnchors = document.getElementById("projectAnchors");
  var projectAnchor = document.getElementsByClassName("anchor");
  const mediaQuery = window.matchMedia('(min-width: 768px)')

  $(window).scroll(function(event){
      didScroll = true;
  });

  function hasScrolled() {
      var st = $(this).scrollTop();

      // Make sure they scroll more than delta
      if(Math.abs(lastScrollTop - st) <= delta) {
        return;
      }

      if (st > lastScrollTop && st > navbarHeight){
          // Scroll Down
          $('header').removeClass('header-down').addClass('header-up');
          projectAnchors.style.transition = "all 0.3s";
          projectAnchors.style.top = "0px";
      }
      else {
          // Scroll Up
          if(st + $(window).height() < $(document).height()) {
              $('header').removeClass('header-up').addClass('header-down');
              projectAnchors.style.transition = "all 0.3s";
              if (mediaQuery.matches) {
                projectAnchors.style.top = "125px";
              } else {
                projectAnchors.style.top = "110px";
              }
          }
      }

      lastScrollTop = st;
  }

  

  setInterval(function() {
      if(didScroll) {
          hasScrolled();
          didScroll = false;
      }
  }, 250);
});


var mybutton = document.getElementById("myBtn");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

mybutton.onclick = function topFunction() {
window.scrollTo({top: 0, behavior: 'smooth'});
}


// // change is-checked class on buttons
//   $('.button').on( 'click', function() {
//     $( this ).find('.is-checked').removeClass('is-checked');
//     $( this ).addClass('is-checked');
//   });