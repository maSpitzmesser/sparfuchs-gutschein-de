/* cookie vars */
var cookie_name        = "selected_theme";
var cookie_options     = { path: '/', expires: 1 };
var cookie_bezeichnung = 'social';

var get_social = jQuery.cookie(cookie_bezeichnung);

/* Get Cookie */
var get_cookie = jQuery.cookie(cookie_name);

var ThemePath = "http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/";
var ThemeCSS  = "theme.css.gz";

/* theme drawer hider */
function hideDrawer() {
  if (!jQuery("#theme-wrapper").hasClass('open')){
    jQuery("#theme-wrapper").addClass('closed');
  }
};


jQuery('.theme-wrapper').on('click', function(e) {
    jQuery(this).toggleClass("open closed");
    e.preventDefault();
});

hideDrawer();

if(get_cookie != null) {
 jQuery("#active-theme").attr({ href: ThemePath + get_cookie + '/' + ThemeCSS});
}

/* theme switcher */
jQuery('[data-design]').click(function() {
 var DesignName = jQuery(this).attr("data-design");
 jQuery("#active-theme").attr({ href: ThemePath + DesignName + '/' + ThemeCSS});
 hideDrawer();
 jQuery.cookie(cookie_name, DesignName, cookie_options);
 return false;
});