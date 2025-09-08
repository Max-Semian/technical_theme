<?php

/**
 * context: 'header' | 'footer'
 */
if (!isset($context)) {
  $context = 'footer';
}

$languages = pll_the_languages([
  'raw' => 1,
  'hide_if_no_translation' => 0,
]);

$flag_map = [
  'en' => 'us',
  'pt' => 'br',
  // Добавь ещё, если нужно
];

if (!is_array($languages) || count($languages) < 1) return;

// ⬇ Генерация CSS с флагами (ТОЛЬКО для footer context)
if ($context === 'footer'): ?>
  <style id="dynamic-polylang-flags">
    <?php foreach ($languages as $lang):
      $slug = esc_attr($lang['slug']);
      $flag_slug = isset($flag_map[$slug]) ? $flag_map[$slug] : $slug;
      $flag = get_template_directory_uri() . '/assets/img/flags/' . $flag_slug . '.png';
    ?>a.link-lang.<?php echo $slug; ?>::before {
      background: url('<?php echo $flag; ?>') no-repeat top center / contain;
    }

    <?php endforeach; ?>
  </style>
<?php endif; ?>

<?php if ($context === 'header'): ?>

  <?php
  $current_lang = '';
  $filtered_languages = [];
  foreach ($languages as $lang) {
    if ($lang['current_lang']) {
      $current_lang = strtoupper($lang['slug']);
    } else {
      $filtered_languages[] = $lang;
    }
  }
  if (count($filtered_languages) < 1) return;
  ?>

  <!-- AMP state -->
  <amp-state id="langMenuState">
    <script type="application/json">
      {
        "open": false
      }
    </script>
  </amp-state>

  <section class="lang-switcher">

    <section class="current-lang"
         role="button"
         tabindex="0"
         on="tap:AMP.setState({ langMenuState: { open: langMenuState.open ? false : true } })"
         [class]="langMenuState.open ? 'current-lang waeTfPgdJJEP' : 'current-lang'">
      <?php echo esc_html($current_lang); ?>
    </section>

    <ul [class]="langMenuState.open ? 'OESCSFci70I70GL mojgHuxi2zoL6F' : 'OESCSFci70I70GL'">
      <?php foreach ($filtered_languages as $lang): ?>
        <li>
          <a href="<?php echo esc_url($lang['url']); ?>"
             class="<?php echo esc_attr($lang['slug']); ?>">
            <?php echo esc_html($lang['name']); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>



<?php elseif ($context === 'footer'): ?>
  <?php foreach ($languages as $lang): ?>
    <li>
      <a href="<?php echo esc_url($lang['url']); ?>"
        class="link-lang <?php echo esc_attr($lang['slug']); ?>">
        <?php echo esc_html($lang['name']); ?>
      </a>
    </li>
  <?php endforeach; ?>
<?php endif; ?>
