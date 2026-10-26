<?php
/**
 * Admin-Bereich des Themes:
 *   Gutscheine – importierte Awin-Angebote, Export-Link, Import von Hand
 *   Slider     – eigene Slides der Startseite (Tabelle wp_slider)
 */

defined('ABSPATH') || exit;

const SG_ADMIN_CAP = 'manage_options';

add_action('admin_menu', static function (): void {
    add_menu_page('Gutscheine', 'Gutscheine', SG_ADMIN_CAP, 'sg-vouchers', 'sg_admin_vouchers_page', 'dashicons-tag', 10);
    add_submenu_page('sg-vouchers', 'Gutscheine', 'Übersicht', SG_ADMIN_CAP, 'sg-vouchers', 'sg_admin_vouchers_page');
    add_submenu_page('sg-vouchers', 'Awin-Import', 'Awin-Import', SG_ADMIN_CAP, 'sg-awin-import', 'sg_admin_import_page');
    add_menu_page('Slider', 'Slider', SG_ADMIN_CAP, 'sg-slider', 'sg_admin_slider_page', 'dashicons-slides', 11);
});

add_action('admin_init', static function (): void {
    register_setting('sg_awin', SG_AWIN_URL_OPTION, [
        'type'              => 'string',
        'sanitize_callback' => static fn($url): string => wp_http_validate_url((string) $url) ? esc_url_raw((string) $url) : '',
        'default'           => '',
        'show_in_rest'      => false,
    ]);
});

/** Hinweis im Admin oben (nach Weiterleitung über ?sg_notice=...). */
function sg_admin_notice(): void
{
    $message = sanitize_text_field(wp_unslash($_GET['sg_notice'] ?? ''));
    if ($message !== '') {
        $type = ($_GET['sg_type'] ?? '') === 'error' ? 'error' : 'success';
        printf('<div class="notice notice-%s is-dismissible"><p>%s</p></div>', esc_attr($type), esc_html($message));
    }
}

function sg_admin_redirect(string $page, string $message, bool $ok = true): void
{
    wp_safe_redirect(add_query_arg(['page' => $page, 'sg_notice' => rawurlencode($message), 'sg_type' => $ok ? 'success' : 'error'], admin_url('admin.php')));
    exit;
}

/* ---------- Gutscheine ---------- */

function sg_admin_vouchers_page(): void
{
    global $wpdb;
    $offers = $wpdb->get_results(
        'SELECT v.PromotionID, v.Advertiser, v.Type, v.Title, v.Code, v.Ends, COALESCE(u.Clicks, 0) AS Clicks
         FROM ' . SG_OFFER_TABLE . ' v LEFT JOIN ' . SG_CLICKS_TABLE . ' u ON u.PromotionID = v.PromotionID
         ORDER BY v.Ends DESC'
    );
    $now = time();
    ?>
    <div class="wrap">
      <h1 class="wp-heading-inline">Gutscheine</h1>
      <a class="page-title-action" href="<?php echo esc_url(admin_url('admin.php?page=sg-awin-import')); ?>">Awin-Import</a>
      <hr class="wp-header-end">
      <?php sg_admin_notice(); ?>
      <p><?php echo esc_html(count($offers)); ?> Angebote aus dem Awin-Import, davon
        <?php echo esc_html(count(array_filter($offers, static fn($o) => sg_timestamp($o->Ends) === null || sg_timestamp($o->Ends) >= $now))); ?> gültig.</p>
      <table class="wp-list-table widefat striped">
        <thead><tr><th>Shop</th><th>Angebot</th><th>Art</th><th>Code</th><th>Gültig bis</th><th class="num">Klicks</th></tr></thead>
        <tbody>
        <?php foreach ($offers as $offer) : $ends = sg_timestamp($offer->Ends); ?>
          <tr<?php echo $ends && $ends < $now ? ' style="opacity:.55"' : ''; ?>>
            <td><?php echo esc_html($offer->Advertiser); ?></td>
            <td><a href="<?php echo esc_url(sg_go_url((int) $offer->PromotionID, 'layer-aw')); ?>" target="_blank"><?php echo wp_kses(sg_format_offer_title($offer->Title), ['span' => ['class' => true]]); ?></a></td>
            <td><?php echo esc_html($offer->Type === 'voucher' ? 'Gutscheincode' : 'Aktion'); ?></td>
            <td><code><?php echo esc_html($offer->Code); ?></code></td>
            <td><?php echo $ends ? esc_html(sg_date($ends, 'd.m.Y')) : '–'; ?></td>
            <td class="num"><?php echo (int) $offer->Clicks; ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$offers) : ?>
          <tr><td colspan="6">Noch keine Angebote importiert.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php
}

function sg_admin_import_page(): void
{
    $status = get_option(SG_AWIN_STATUS_OPTION);
    $next   = wp_next_scheduled(SG_AWIN_CRON_HOOK);
    ?>
    <div class="wrap">
      <h1>Awin-Import</h1>
      <?php sg_admin_notice(); ?>
      <?php settings_errors(); ?>

      <h2>Letzter Import</h2>
      <?php if ($status) : ?>
        <p><span class="dashicons <?php echo $status['ok'] ? 'dashicons-yes-alt' : 'dashicons-warning'; ?>"></span>
          <?php echo esc_html(wp_date('d.m.Y H:i', (int) $status['time'])); ?> – <?php echo esc_html($status['message']); ?></p>
      <?php else : ?>
        <p>Bisher kein Import mit dem neuen Importer.</p>
      <?php endif; ?>
      <p>Nächster automatischer Import: <?php echo $next ? esc_html(wp_date('d.m.Y H:i', $next)) : 'keiner geplant (Export-Link fehlt)'; ?></p>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="sg_awin_import">
        <?php wp_nonce_field('sg_awin_import'); ?>
        <?php submit_button('Jetzt importieren', 'secondary', 'submit', false, get_option(SG_AWIN_URL_OPTION) ? [] : ['disabled' => 'disabled']); ?>
      </form>

      <h2>Export-Link</h2>
      <p>Den Link findest du bei Awin unter <em>Tools › Promotions › Export</em> (CSV). Er enthält deinen persönlichen Schlüssel – deshalb wird er nur hier in der Datenbank gespeichert, nicht im Code.</p>
      <form method="post" action="options.php">
        <?php settings_fields('sg_awin'); ?>
        <input type="url" class="large-text code" name="<?php echo esc_attr(SG_AWIN_URL_OPTION); ?>" value="<?php echo esc_attr((string) get_option(SG_AWIN_URL_OPTION)); ?>" placeholder="https://ui.awin.com/export-promotions/…" autocomplete="off">
        <?php submit_button('Link speichern'); ?>
      </form>
    </div>
    <?php
}

add_action('admin_post_sg_awin_import', static function (): void {
    if (!current_user_can(SG_ADMIN_CAP)) {
        wp_die('Keine Berechtigung.', 403);
    }
    check_admin_referer('sg_awin_import');
    $result = sg_awin_import();
    sg_admin_redirect('sg-awin-import', $result['message'], $result['ok']);
});

/* ---------- Slider ---------- */

function sg_admin_slider_page(): void
{
    global $wpdb;
    $slides = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}slider ORDER BY slid DESC");
    $shops  = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
    ?>
    <div class="wrap">
      <h1>Slider</h1>
      <?php sg_admin_notice(); ?>
      <p>Aktive Slides ersetzen auf der Startseite die automatische Gutschein-Slideshow. Bildformat: 600 × 250 px.</p>

      <table class="wp-list-table widefat striped">
        <thead><tr><th>Bild</th><th>Shop</th><th>Gültig bis</th><th>Status</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($slides as $slide) : ?>
          <tr>
            <td><img src="<?php echo esc_url($slide->img_link); ?>" alt="<?php echo esc_attr($slide->img_alt); ?>" style="max-width:240px;height:auto"></td>
            <td><a href="<?php echo esc_url($slide->url); ?>" target="_blank"><?php echo esc_html($slide->shop); ?></a></td>
            <td><?php echo $slide->valid_to ? esc_html(wp_date('d.m.Y', strtotime($slide->valid_to))) : '–'; ?></td>
            <td><?php echo $slide->active ? 'online' : 'offline'; ?></td>
            <td>
              <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:inline">
                <input type="hidden" name="action" value="sg_slider_toggle">
                <input type="hidden" name="slide" value="<?php echo (int) $slide->slid; ?>">
                <?php wp_nonce_field('sg_slider_' . (int) $slide->slid); ?>
                <button class="button"><?php echo $slide->active ? 'Offline nehmen' : 'Online stellen'; ?></button>
              </form>
              <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:inline" onsubmit="return confirm('Slide wirklich löschen?');">
                <input type="hidden" name="action" value="sg_slider_delete">
                <input type="hidden" name="slide" value="<?php echo (int) $slide->slid; ?>">
                <?php wp_nonce_field('sg_slider_' . (int) $slide->slid); ?>
                <button class="button button-link-delete">Löschen</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$slides) : ?>
          <tr><td colspan="5">Keine eigenen Slides.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>

      <h2>Neuer Slide</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="sg_slider_add">
        <?php wp_nonce_field('sg_slider_add'); ?>
        <table class="form-table" role="presentation">
          <tr><th scope="row"><label for="sg-slide-shop">Shop</label></th><td>
            <select id="sg-slide-shop" name="shop" required>
              <option value="">– Shop wählen –</option>
              <?php foreach ($shops as $shop) : ?>
                <option value="<?php echo (int) $shop->ID; ?>"><?php echo esc_html(get_the_title($shop)); ?></option>
              <?php endforeach; ?>
            </select></td></tr>
          <tr><th scope="row"><label for="sg-slide-valid">Gültig bis</label></th><td><input id="sg-slide-valid" type="date" name="valid_to"></td></tr>
          <tr><th scope="row"><label for="sg-slide-file">Bild</label></th><td><input id="sg-slide-file" type="file" name="file" accept="image/png,image/jpeg,image/webp" required>
            <p class="description">PNG, JPG oder WebP, höchstens 300 KB. Das Bild landet in der Mediathek.</p></td></tr>
        </table>
        <?php submit_button('Hochladen und online stellen'); ?>
      </form>
    </div>
    <?php
}

/** Gemeinsame Prüfung für Slider-Aktionen; liefert die Slide-ID. */
function sg_admin_slider_guard(string $nonce_prefix): int
{
    if (!current_user_can(SG_ADMIN_CAP)) {
        wp_die('Keine Berechtigung.', 403);
    }
    $id = absint($_POST['slide'] ?? 0);
    check_admin_referer($nonce_prefix . $id);
    return $id;
}

add_action('admin_post_sg_slider_toggle', static function (): void {
    global $wpdb;
    $id = sg_admin_slider_guard('sg_slider_');
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}slider SET active = 1 - active WHERE slid = %d", $id));
    sg_admin_redirect('sg-slider', 'Status geändert.');
});

add_action('admin_post_sg_slider_delete', static function (): void {
    global $wpdb;
    $id = sg_admin_slider_guard('sg_slider_');
    $wpdb->delete($wpdb->prefix . 'slider', ['slid' => $id], ['%d']);
    sg_admin_redirect('sg-slider', 'Slide gelöscht.');
});

add_action('admin_post_sg_slider_add', static function (): void {
    global $wpdb;
    if (!current_user_can(SG_ADMIN_CAP)) {
        wp_die('Keine Berechtigung.', 403);
    }
    check_admin_referer('sg_slider_add');

    $shop_id = absint($_POST['shop'] ?? 0);
    if (!$shop_id || get_post_type($shop_id) !== 'post') {
        sg_admin_redirect('sg-slider', 'Bitte einen Shop wählen.', false);
    }
    if (empty($_FILES['file']['size']) || $_FILES['file']['size'] > 300 * KB_IN_BYTES) {
        sg_admin_redirect('sg-slider', 'Bitte ein Bild mit höchstens 300 KB hochladen.', false);
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $attachment_id = media_handle_upload('file', 0, [], ['test_form' => false, 'mimes' => ['png' => 'image/png', 'jpg|jpeg' => 'image/jpeg', 'webp' => 'image/webp']]);
    if (is_wp_error($attachment_id)) {
        sg_admin_redirect('sg-slider', 'Upload fehlgeschlagen: ' . $attachment_id->get_error_message(), false);
    }

    $valid_to = sanitize_text_field(wp_unslash($_POST['valid_to'] ?? ''));
    $wpdb->insert($wpdb->prefix . 'slider', [
        'active'   => 1,
        'img_link' => wp_get_attachment_url($attachment_id),
        'img_alt'  => get_the_title($shop_id) . ' Gutschein',
        'url'      => get_permalink($shop_id),
        'shop'     => get_the_title($shop_id),
        'valid_to' => preg_match('/^\d{4}-\d{2}-\d{2}$/', $valid_to) ? $valid_to : null,
    ]);
    sg_admin_redirect('sg-slider', 'Slide ist online.');
});
