<?php if (!is_front_page() && function_exists('bcn_display_list')): ?>
  <section class="block block-breadcrumbs">
    <ul class="lRnUxCSfSxMZ">
      <?php
      $breadcrumb_html = bcn_display_list(true);

      $breadcrumb_html = preg_replace(
        '#</li>\s*<li(?! class="roeatsi5KE")#',
        '</li><li class="roeatsi5KE"><span>/</span></li><li',
        $breadcrumb_html
      );

      echo $breadcrumb_html;
      ?>
    </ul>
  </section>
<?php endif; ?>
