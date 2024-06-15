/*------------------------------------------------------------------------------*/
/* Fixed-header
/*------------------------------------------------------------------------------*/


$(window).on("scroll", function() {
    if (matchMedia('only screen and (min-width: 1200px)').matches) {
        if ($(window).scrollTop() >= 50) {
            $('.header').addClass('fixed-header');
            $('.navbar').addClass('scrolled-navbar');
        } else {
            $('.header').removeClass('fixed-header');
            $('.navbar').removeClass('scrolled-navbar');
        }
    }
  });