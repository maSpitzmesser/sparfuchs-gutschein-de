<?php
/**
 * Formulare (Kontakt, Gutschein melden, Feedback): Felder, Prüfung und Versand per wp_mail.
 * Schutz vor Spam über Nonce, ein unsichtbares Honeypot-Feld und eine Mindest-Ausfüllzeit.
 * Nach erfolgreichem Versand wird weitergeleitet (kein erneutes Senden beim Neuladen).
 */

defined('ABSPATH') || exit;

const SG_FORM_MIN_SECONDS = 3;

/*
 * Feldnamen im HTML bekommen das Präfix "sg_": WordPress wertet Felder wie "name" oder "date"
 * sonst als eigene Abfrage-Parameter aus und liefert beim Absenden einen 404.
 */
function sg_form_input_name(string $field): string
{
    return 'sg_' . $field;
}

/** Empfänger der Formular-Mails, per Filter "sg_form_recipient" änderbar. */
function sg_form_recipient(): string
{
    return apply_filters('sg_form_recipient', 'info@sparfuchs-gutschein.de');
}

/** Formulare: Betreff der Mail und Felder (Name => Typ, Bezeichnung, Pflicht, Optionen). */
function sg_forms(): array
{
    $grades = array_combine(range(1, 6), array_map('strval', range(1, 6)));

    return [
        'kontakt' => [
            'subject' => 'Kontaktanfrage',
            'fields'  => [
                'name'      => ['type' => 'text', 'label' => 'Name', 'required' => true],
                'email'     => ['type' => 'email', 'label' => 'Email', 'required' => true],
                'betreff'   => ['type' => 'text', 'label' => 'Betreff', 'required' => true],
                'nachricht' => ['type' => 'textarea', 'label' => 'Nachricht', 'required' => true],
            ],
        ],
        'gutschein-melden' => [
            'subject' => 'Gutscheincode gemeldet',
            'fields'  => [
                'shopid' => ['type' => 'select', 'label' => 'Shop', 'required' => true, 'options' => 'sg_form_shop_options'],
                'wert'   => ['type' => 'text', 'label' => 'Wert', 'required' => false],
                'unit'   => ['type' => 'select', 'label' => 'Einheit', 'required' => false, 'options' => ['€' => '€', '%' => '%'], 'hide_label' => true],
                'code'   => ['type' => 'text', 'label' => 'Code', 'required' => true],
                'date'   => ['type' => 'date', 'label' => 'Gültig bis', 'required' => true],
                'link'   => ['type' => 'url', 'label' => 'Link', 'required' => true],
                'name'   => ['type' => 'text', 'label' => 'Name', 'required' => true],
                'email'  => ['type' => 'email', 'label' => 'Email', 'required' => true],
            ],
        ],
        'feedback' => [
            'subject' => 'Feedback',
            'fields'  => [
                'erfahren_durch' => ['type' => 'select', 'label' => 'Wie bist du auf diese Seite aufmerksam geworden?', 'required' => false, 'options' => [
                    'Allgemein'          => ['Zufall' => 'Zufall', 'Freunde/Bekannte' => 'Freunde/Bekannte'],
                    'Internet-Angebote'  => ['Newsletter anderer Seiten' => 'Newsletter anderer Seiten', 'Suchmaschine' => 'Suchmaschine', 'Linkliste' => 'Linkliste', 'Forum/Gästebuch-Eintrag' => 'Forum/Gästebuch-Eintrag'],
                    'Medien'             => ['Zeitung' => 'Zeitung', 'Zeitschrift' => 'Zeitschrift', 'Radio' => 'Radio', 'Fernsehen' => 'Fernsehen'],
                ]],
                'inhalt'    => ['type' => 'radio', 'label' => 'Welche Note würdest du allgemein dem Inhalt geben?', 'required' => false, 'options' => $grades, 'help' => '(1 = sehr gut, 6 = ungenügend)'],
                'design'    => ['type' => 'radio', 'label' => 'Welche Note würdest du allgemein dem Aussehen geben?', 'required' => false, 'options' => $grades, 'help' => '(1 = sehr gut, 6 = ungenügend)'],
                'name'      => ['type' => 'text', 'label' => 'Name', 'required' => false],
                'email'     => ['type' => 'email', 'label' => 'Email', 'required' => false],
                'vorschlag' => ['type' => 'textarea', 'label' => 'Was würdest du verbessern?', 'required' => false],
            ],
        ],
    ];
}

/** Alle veröffentlichten Shops für die Auswahl beim Melden eines Gutscheins. */
function sg_form_shop_options(): array
{
    $shops = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC']);
    $options = [];
    foreach ($shops as $shop) {
        $options[(string) $shop->ID] = html_entity_decode(get_the_title($shop), ENT_QUOTES, 'UTF-8');
    }
    return $options;
}

/** Zustand eines Formulars nach dem Absenden: Fehler und eingegebene Werte. */
function sg_form_state(string $form, ?array $state = null): array
{
    static $states = [];
    if ($state !== null) {
        $states[$form] = $state;
    }
    return $states[$form] ?? ['errors' => [], 'values' => []];
}

/* ---------- Verarbeitung ---------- */

add_action('template_redirect', static function (): void {
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST' || empty($_POST['sg_form'])) {
        return;
    }
    $form_id = sanitize_key(wp_unslash($_POST['sg_form']));
    $forms   = sg_forms();
    if (!isset($forms[$form_id])) {
        return;
    }

    $errors = [];
    $values = [];

    if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_sg_nonce'] ?? '')), "sg_form_{$form_id}")) {
        $errors['_form'] = 'Die Sitzung ist abgelaufen. Bitte sende das Formular erneut.';
    }
    // Honeypot: für Menschen unsichtbar, Bots füllen es aus
    if (!empty($_POST['website'])) {
        $errors['_form'] = 'Die Nachricht konnte nicht gesendet werden.';
    }
    $started = absint($_POST['_sg_started'] ?? 0);
    if (!hash_equals(wp_hash("sg_form_{$form_id}_{$started}"), (string) ($_POST['_sg_started_hash'] ?? ''))
        || time() - $started < SG_FORM_MIN_SECONDS) {
        $errors['_form'] = 'Das ging etwas zu schnell. Bitte sende das Formular erneut.';
    }

    foreach ($forms[$form_id]['fields'] as $name => $field) {
        $raw   = wp_unslash($_POST[sg_form_input_name($name)] ?? '');
        $value = $field['type'] === 'textarea' ? sanitize_textarea_field($raw) : sanitize_text_field($raw);
        $values[$name] = $value;

        if ($value === '') {
            if ($field['required']) {
                $errors[$name] = 'Bitte ausfüllen.';
            }
            continue;
        }
        if ($field['type'] === 'email' && !is_email($value)) {
            $errors[$name] = 'Bitte eine gültige E-Mail-Adresse eingeben.';
        } elseif ($field['type'] === 'url' && !wp_http_validate_url($value)) {
            $errors[$name] = 'Bitte einen vollständigen Link mit https:// eingeben.';
        } elseif (in_array($field['type'], ['select', 'radio'], true) && !array_key_exists($value, sg_form_flat_options($field))) {
            $errors[$name] = 'Bitte einen Eintrag auswählen.';
        }
    }

    if (!$errors && !sg_form_send($form_id, $values)) {
        $errors['_form'] = 'Die Nachricht konnte gerade nicht versendet werden. Bitte versuche es später noch einmal.';
    }

    if ($errors) {
        sg_form_state($form_id, ['errors' => $errors, 'values' => $values]);
        return;
    }

    $back = add_query_arg('gesendet', '1', remove_query_arg('gesendet', wp_get_referer() ?: get_permalink()));
    wp_safe_redirect($back . '#form');
    exit;
});

/** Optionen eines Auswahlfelds ohne Gruppen. */
function sg_form_flat_options(array $field): array
{
    $options = is_callable($field['options'] ?? null) ? call_user_func($field['options']) : ($field['options'] ?? []);
    $flat    = [];
    foreach ($options as $key => $label) {
        if (is_array($label)) {
            $flat += $label;
        } else {
            $flat[(string) $key] = $label;
        }
    }
    return $flat;
}

function sg_form_send(string $form_id, array $values): bool
{
    $form  = sg_forms()[$form_id];
    $lines = [];
    foreach ($form['fields'] as $name => $field) {
        $value = $values[$name];
        if (in_array($field['type'], ['select', 'radio'], true) && $value !== '') {
            $value = sg_form_flat_options($field)[$value] ?? $value;
        }
        $lines[] = $field['label'] . ': ' . ($value !== '' ? $value : '–');
    }
    $lines[] = '';
    $lines[] = 'Gesendet über ' . home_url('/') . ' am ' . wp_date('d.m.Y \u\m H:i \U\h\r');

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    if (!empty($values['email']) && is_email($values['email'])) {
        $headers[] = 'Reply-To: ' . $values['email'];
    }
    $subject = $form['subject'] . (!empty($values['betreff']) ? ': ' . $values['betreff'] : '');

    return wp_mail(sg_form_recipient(), '[Sparfuchs-Gutschein] ' . $subject, implode("\n", $lines), $headers);
}

/* ---------- Ausgabe ---------- */

/** Öffnendes Formular-Tag mit Schutzfeldern und Statusmeldungen. */
function sg_form_open(string $form_id): void
{
    $state   = sg_form_state($form_id);
    $started = time();
    echo '<form action="" method="post" id="form">';
    if (!empty($_GET['gesendet'])) {
        echo '<div class="ok success" role="status">Nachricht erfolgreich gesendet! Vielen Dank.</div>';
    }
    if (!empty($state['errors']['_form'])) {
        echo '<div class="error" role="alert">' . esc_html($state['errors']['_form']) . '</div>';
    } elseif (!empty($state['errors'])) {
        echo '<div class="error" role="alert">Bitte prüfe die markierten Felder.</div>';
    }
    printf('<input type="hidden" name="sg_form" value="%s">', esc_attr($form_id));
    wp_nonce_field("sg_form_{$form_id}", '_sg_nonce', false);
    printf('<input type="hidden" name="_sg_started" value="%d">', $started);
    printf('<input type="hidden" name="_sg_started_hash" value="%s">', esc_attr(wp_hash("sg_form_{$form_id}_{$started}")));
    echo '<p class="sg-hp" aria-hidden="true"><label for="website">Website</label><input type="text" name="website" id="website" tabindex="-1" autocomplete="off"></p>';
}

function sg_form_close(string $form_id, string $label = 'Absenden'): void
{
    if (array_filter(array_column(sg_forms()[$form_id]['fields'], 'required'))) {
        echo '<p class="required">* Pflichtfelder</p>';
    }
    printf('<div class="field"><input class="button" type="submit" id="submit" value="%s"></div>', esc_attr($label));
    echo '</form>';
}

/** Ein Formularfeld mit Bezeichnung, Wert nach dem Absenden und Fehlermeldung. */
function sg_form_field(string $form_id, string $name, array $extra = []): void
{
    $field = sg_forms()[$form_id]['fields'][$name];
    $state = sg_form_state($form_id);
    $value = $state['values'][$name] ?? '';
    $error = $state['errors'][$name] ?? '';
    $id    = "{$form_id}-{$name}";
    $input = sg_form_input_name($name);
    $req   = $field['required'] ? ' required' : '';
    $class = trim(($extra['class'] ?? '') . ($error ? ' invalid' : ''));
    $star  = $field['required'] ? ' <span class="required">*</span>' : '';
    $label_class = in_array($field['type'], ['radio', 'textarea'], true) || mb_strlen($field['label']) > 20 ? ' class="full-width"' : '';

    echo '<div class="field">';

    if ($field['type'] === 'radio') {
        printf('<span%s id="%s-label">%s%s</span>', $label_class, esc_attr($id), esc_html($field['label']), $star);
        echo '<span role="radiogroup" aria-labelledby="' . esc_attr($id) . '-label">';
        foreach ($field['options'] as $key => $label) {
            $option_id = $id . '-' . $key;
            printf(
                '<input id="%1$s" type="radio" name="%2$s" value="%3$s"%4$s><label for="%1$s" class="circled">%5$s</label>',
                esc_attr($option_id), esc_attr($input), esc_attr((string) $key), checked($value, (string) $key, false), esc_html($label)
            );
        }
        echo '</span>';
    } else {
        if (!empty($field['hide_label'])) {
            $label_class = ' class="hidden"';
        }
        printf('<label for="%s"%s>%s:%s</label>', esc_attr($id), $label_class, esc_html($field['label']), $star);
        $attributes = sprintf('id="%s" name="%s" class="%s"%s%s', esc_attr($id), esc_attr($input), esc_attr($class), $req, $error ? ' aria-invalid="true"' : '');

        if ($field['type'] === 'textarea') {
            printf('<textarea %s cols="50" rows="8">%s</textarea>', $attributes, esc_textarea($value));
        } elseif ($field['type'] === 'select') {
            $options = is_callable($field['options']) ? call_user_func($field['options']) : $field['options'];
            echo '<select ' . $attributes . '>';
            if ($field['required'] || count($options) > 2) {
                echo '<option value="">-- Bitte wählen --</option>';
            }
            foreach ($options as $key => $label) {
                if (is_array($label)) {
                    echo '<optgroup label="' . esc_attr((string) $key) . '">';
                    foreach ($label as $sub_key => $sub_label) {
                        printf('<option value="%s"%s>%s</option>', esc_attr((string) $sub_key), selected($value, (string) $sub_key, false), esc_html($sub_label));
                    }
                    echo '</optgroup>';
                } else {
                    printf('<option value="%s"%s>%s</option>', esc_attr((string) $key), selected($value, (string) $key, false), esc_html($label));
                }
            }
            echo '</select>';
        } else {
            $autocomplete = ['name' => 'name', 'email' => 'email'][$name] ?? 'off';
            printf('<input type="%s" %s value="%s" autocomplete="%s">', esc_attr($field['type']), $attributes, esc_attr($value), esc_attr($autocomplete));
        }
    }

    if (!empty($field['help'])) {
        echo '<p class="description">' . esc_html($field['help']) . '</p>';
    }
    if ($error) {
        echo '<p class="field-error">' . esc_html($error) . '</p>';
    }
    echo '</div>';
}
