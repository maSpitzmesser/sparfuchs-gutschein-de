var cookie_name        = "cookie_banner";
var cookie_options     = { path: '/', expires: 1 };
var cookie_bezeichnung = 'cookie';

var get_cookie_bezeichnung = jQuery.cookie(cookie_bezeichnung);
var get_cookie_name        = jQuery.cookie(cookie_name);

if(get_cookie_name == null) {
    jQuery(".cookie-banner").removeClass('hidden');
} else {
    jQuery(".cookie-banner").remove();
}

if (jQuery(".cookie-banner").length > 0) {
  jQuery('.cookie-banner-close').click(function() {
      jQuery('.cookie-banner').remove();
      jQuery.cookie(cookie_name, '1', cookie_options);
  });
}
