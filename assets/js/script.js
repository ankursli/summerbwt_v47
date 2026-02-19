(function ($) {
  "use strict";


  var window_width = $(window).width(),
    window_height = window.innerHeight,
    header_height = $(".default-header").height(),
    header_height_static = $(".site-header.static").outerHeight(),
    fitscreen = window_height - header_height;
/*
  $(".fullscreen").css("height", window_height)
  $(".fitscreen").css("height", fitscreen);
*/

  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
      $('.scroll-top').fadeIn(600);
    } else {
      $('.scroll-top').fadeOut(600);
    }
  });
  $('.scroll-top').on("click", function () {
    $("html,body").animate({
      scrollTop: 0
    }, 500);
    return false;
  });

// ------------------------------------------------------------------------------ //
  // Active Menu 
  // ------------------------------------------------------------------------------ //


  $('#dopeNav').dopeNav({
    stickyNav: true,
  });

  $(document).ready(function(){

    $('.block-wrap-content .matchh3').matchHeight();
    $('.block-wrap-content .matchlasttext').matchHeight();
    $('.block-wrap-content .matchfirsttext').matchHeight();
/*
    jQuery('.full-page-wrap').fullpage({
          sectionSelector: 'section',
          verticalCentered:true
    });		*/
  })



})(jQuery);

