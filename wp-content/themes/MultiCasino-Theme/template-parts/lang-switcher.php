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

if (count($languages) === 1) return;

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
	<section class="lang-switcher">
		<?php
		$current_lang = '';
		foreach ($languages as $lang) {
			if ($lang['current_lang']) {
				$current_lang = strtoupper($lang['slug']);
				break;
			}
		}
		?>
		<section class="current-lang" id="currentLang"><?php echo esc_html($current_lang); ?></section>
		<ul>
			<?php foreach ($languages as $lang): ?>
				<?php if ($lang['current_lang']) continue; ?>
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
