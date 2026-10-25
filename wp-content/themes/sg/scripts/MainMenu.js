/* HEADER NAV */
jQuery(document).ready(function () {

  jQuery('.mobile-menu-button').on('click', function () {
    if (jQuery('.main-menu').hasClass('open')) {
      jQuery('.main-menu').removeClass('open');
      
      setTimeout(function(){
        jQuery('.main-menu ul').removeClass('hamburger-menu');
      }, 300);
    }
    else {
      jQuery('.main-menu ul').addClass('hamburger-menu');
      jQuery('.main-menu').addClass('open');
    }

  });
});    