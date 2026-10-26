<?php
/**
 * Zwischenseite vor der Weiterleitung zum Shop: zeigt den Gutscheincode und leitet nach 5 Sekunden weiter.
 *
 * @var object|null $offer
 */

defined('ABSPATH') || exit;

$target = $offer ? sg_offer_target($offer) : '';
$code   = $offer ? trim((string) $offer->Code) : '';
$shop   = $offer ? (string) $offer->Advertiser : '';
$delay  = 5;
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?php echo $offer ? esc_html(wp_strip_all_tags(sg_format_offer_title($offer->Title)) . ' bei ' . $shop) : 'Angebot nicht gefunden'; ?></title>
  <?php if ($target) : ?>
    <meta http-equiv="refresh" content="<?php echo (int) $delay; ?>; url=<?php echo esc_url($target); ?>">
  <?php endif; ?>
  <link rel="icon" href="<?php echo esc_url(home_url('/favicon.ico')); ?>">
  <link rel="stylesheet" href="<?php echo esc_url(SG_THEME_URI . '/styles/css/go.css?ver=' . sg_asset_version('/styles/css/go.css')); ?>">
</head>
<body class="go">
<main class="go-card">
  <img class="go-logo" src="<?php echo esc_url(SG_THEME_URI . '/images/logo/sparfuchs-gutschein-logo.min.png'); ?>" alt="Sparfuchs-Gutschein" width="371" height="100">

  <?php if (!$offer) : ?>
    <h1>Dieses Angebot gibt es nicht mehr.</h1>
    <p><a href="<?php echo esc_url(home_url('/')); ?>">Zur Startseite mit allen Gutscheinen</a></p>
  <?php else : ?>
    <h1><?php echo sg_format_offer_title($offer->Title); ?></h1>

    <?php if ($code !== '') : ?>
      <p class="go-label">Dein Gutscheincode</p>
      <p class="go-code"><output id="go-code"><?php echo esc_html($code); ?></output>
        <button type="button" class="go-copy" data-copy="#go-code">Kopieren</button></p>
    <?php else : ?>
      <p class="go-code go-code--none">Kein Code notwendig!</p>
    <?php endif; ?>

    <?php if ($target) : ?>
      <progress class="go-progress" max="<?php echo (int) $delay; ?>" value="0"></progress>
      <p>Du wirst jetzt zu <a href="<?php echo esc_url($target); ?>" rel="sponsored nofollow"><?php echo esc_html($shop); ?></a> weitergeleitet.</p>
    <?php else : ?>
      <p>Für dieses Angebot ist kein Link zum Shop hinterlegt.</p>
    <?php endif; ?>
  <?php endif; ?>
</main>
<script>
  // Fortschritt bis zur Weiterleitung und Kopieren des Codes
  (() => {
    const bar = document.querySelector('.go-progress');
    if (bar) {
      const start = performance.now();
      const tick = (now) => {
        bar.value = Math.min(bar.max, (now - start) / 1000);
        if (bar.value < bar.max) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    }
    document.querySelector('.go-copy')?.addEventListener('click', async (event) => {
      const text = document.querySelector(event.currentTarget.dataset.copy).textContent;
      try {
        await navigator.clipboard.writeText(text);
        event.currentTarget.textContent = 'Kopiert ✓';
      } catch {
        event.currentTarget.textContent = 'Bitte markieren und kopieren';
      }
    });
  })();
</script>
</body>
</html>
