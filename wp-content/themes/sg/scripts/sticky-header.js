var nav_main_menu        = jQuery('header nav');
var nav_main_menu_offset = nav_main_menu.offset();
  
jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > nav_main_menu_offset.top) {
    nav_main_menu.addClass("sticky");
  }
  else if (jQuery(this).scrollTop() < nav_main_menu_offset.top) {
    nav_main_menu.removeClass("sticky");
  }
});