/* Globale Werte, die social-media.js erwartet (standen früher hier) */
var cookie_options = { path: '/', expires: 1 };
var cookie_bezeichnung = 'social';
var get_social = jQuery.cookie(cookie_bezeichnung);

/* Design-Wechsler: tauscht das Stylesheet #active-theme und merkt sich die Wahl ein Jahr lang im Cookie */
(function ($) {
  var cookieName = 'selected_theme';
  var designs    = ['flat', 'standard', 'pinky', 'grey'];
  var $theme     = $('#active-theme');
  if (!$theme.length) return;

  // Ordner der Designs aus dem aktuellen Stylesheet ableiten (…/styles/<design>/theme.css)
  var themePath = $theme.attr('href').replace(/[^\/]+\/theme\.css(\?.*)?$/, '');

  function markActive(design) {
    $('[data-design]').each(function () {
      var active = $(this).attr('data-design') === design;
      $(this).toggleClass('is-active', active).text(active ? 'Aktives Design' : 'Design ändern');
    });
  }

  function applyDesign(design) {
    if ($.inArray(design, designs) === -1) return;
    $theme.attr('href', themePath + design + '/theme.css');
    markActive(design);
  }

  var saved = $.cookie(cookieName);
  if (saved) applyDesign(saved);
  else markActive($theme.attr('data-active-design'));

  $(document).on('click', '[data-design]', function (e) {
    e.preventDefault();
    var design = $(this).attr('data-design');
    applyDesign(design);
    $.cookie(cookieName, design, { path: '/', expires: 365 });
  });
})(jQuery);
