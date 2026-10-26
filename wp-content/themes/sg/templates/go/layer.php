<?php
/**
 * Detailansicht eines Gutscheins; wird auf der Shop-Seite im Dialog angezeigt (site.js).
 *
 * @var object|null $offer
 */

defined('ABSPATH') || exit;

$code = $offer ? trim((string) $offer->Code) : '';
$ends = $offer ? sg_timestamp($offer->Ends) : null;
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?php echo $offer ? esc_html(wp_strip_all_tags(sg_format_offer_title($offer->Title))) : 'Angebot nicht gefunden'; ?></title>
  <link rel="stylesheet" href="<?php echo esc_url(SG_THEME_URI . '/styles/css/go.css?ver=' . sg_asset_version('/styles/css/go.css')); ?>">
</head>
<body class="go go--layer">
<main class="go-card">
  <?php if (!$offer) : ?>
    <h1>Dieses Angebot gibt es nicht mehr.</h1>
  <?php else : ?>
    <?php echo sg_shop_logo($offer->Shopname, $offer->Advertiser, ['class' => 'go-shop', 'loading' => null]); ?>
    <h1><?php echo sg_format_offer_title($offer->Title); ?></h1>

    <?php if ($code !== '') : ?>
      <p class="go-label">Dein Gutscheincode</p>
      <p class="go-code"><output id="go-code"><?php echo esc_html($code); ?></output>
        <button type="button" class="go-copy" data-copy="#go-code">Kopieren</button></p>
    <?php else : ?>
      <p class="go-code go-code--none">Kein Code notwendig!</p>
    <?php endif; ?>

    <dl class="go-details">
      <dt>Gültig bis</dt>
      <dd><?php echo $ends ? esc_html(sg_date($ends, 'd.m.Y')) : 'unbegrenzt'; ?></dd>
      <?php if ($offer->Description) : ?>
        <dt>Info</dt>
        <dd><?php echo sg_offer_text($offer->Description); ?></dd>
      <?php endif; ?>
      <?php if ($offer->Terms) : ?>
        <dt>Bedingungen</dt>
        <dd><?php echo sg_offer_text($offer->Terms); ?></dd>
      <?php endif; ?>
      <?php if ($code !== '') : ?>
        <dt>So geht's</dt>
        <dd><ol><li>Gutscheincode kopieren</li><li>Im Warenkorb in das Gutscheinfeld eintragen</li><li>Bestätigen</li></ol></dd>
      <?php endif; ?>
    </dl>

    <p><a class="go-button" href="<?php echo esc_url(sg_go_url((int) $offer->PromotionID)); ?>" target="_blank" rel="sponsored noopener">Gleich einlösen ▸</a></p>
  <?php endif; ?>
</main>
<script>
  document.querySelector('.go-copy')?.addEventListener('click', async (event) => {
    const text = document.querySelector(event.currentTarget.dataset.copy).textContent;
    try {
      await navigator.clipboard.writeText(text);
      event.currentTarget.textContent = 'Kopiert ✓';
    } catch {
      event.currentTarget.textContent = 'Bitte markieren und kopieren';
    }
  });
</script>
</body>
</html>
