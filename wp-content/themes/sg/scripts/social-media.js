jQuery("#social-active input").click(function (event) {
  var social_on = jQuery(this).attr("id");
  jQuery.cookie(cookie_bezeichnung, social_on, cookie_options);
  location.reload();
});
if (get_social === 'an' && false) {
  jQuery('#social-active input').attr("checked", "checked");
  jQuery('#social-active input').attr('checked', true);
  jQuery('#social-active input').click(function (event) {
    var social_on = null;
    jQuery.cookie(cookie_bezeichnung, social_on, cookie_options);
    location.reload();
  });


  var url = 'http://sparfuchs-gutschein.de';
  var title = 'Sparfuchs-Gutschein.de. Clever einkaufen. &Uuml;ber 2200 kostenlose Gutscheincodes f&uuml;r Online-Shops.';
  var btn = document.getElementById('sb');
  //btn.innerHTML = '';
  btn.style.backgroundColor = "transparent";

  var add = document.createElement('div');
  add.innerHTML = '<div class="fb-like" data-href="' + url + '" data-send="false" data-layout="button_count" data-width="55" data-show-faces="false" data-font="arial"></div><div id="fb-root"></div>';
  (function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.0";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
  btn.appendChild(add);

  var add = document.createElement('div');
  add.innerHTML = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' + url + '" data-text="' + title + '" data-lang="de">Twittern</a>';
  btn.appendChild(add);

  var add = document.createElement('div');
  add.innerHTML = '<div class="g-plusone" data-size="medium" data-href="' + url + '"></div>';
  window.___gcfg = {lang: 'de'};    (function () {      var po = document.createElement('script');      po.type = 'text/javascript';      po.async = true;      po.src = 'https://apis.google.com/js/plusone.js'; var s = document.getElementsByTagName('script')[0];      s.parentNode.insertBefore(po, s);    })();
  btn.appendChild(add);

  var lb = document.getElementById('lk');
  if (lb != null) {
    var fbSite = 'https://de-de.facebook.com/SparfuchsGutschein';
    lb.innerHTML = '';
    var add = document.createElement('div');
    add.innerHTML = '<iframe class="fb-like-box" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FSparfuchsGutschein&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=513651062023934" scrolling="no" frameborder="0" style="height:258px;" allowTransparency="true"></iframe>';
    lb.appendChild(add);
  }
}

if(get_social == 'an' && false) {
  window.onload = function(){
    var permal = window.location.href;
    var title = 'Sparfuchs-Gutschein.de. Clever einkaufen. &Uuml;ber 2200 kostenlose Gutscheincodes f&uuml;r Online-Shops.';
    var btn = document.getElementById('sbs');
    //btn.innerHTML = '';
    btn.style.backgroundColor="transparent";
    var add = document.createElement('div');
    add.innerHTML = '<div class="fb-like" data-href="'+permal+'" data-send="false" data-layout="button_count" data-width="55" data-show-faces="false" data-font="arial"></div><div id="fb-root"></div>';
    btn.appendChild(add);
    var add = document.createElement('div');
    add.innerHTML = '<a href="https://twitter.com/share" class="twitter-share-button" data-url="'+permal+'" data-text="'+title+'" data-lang="de">Twittern</a>';
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
    btn.appendChild(add);
    var add = document.createElement('div');
    add.innerHTML = '<div class="g-plusone" data-size="medium" data-href="'+permal+'"></div>';
    btn.appendChild(add);
    window.___gcfg = {lang: 'de'}; (function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/plusone.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();
  }
}
