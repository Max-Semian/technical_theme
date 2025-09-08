<!-- template-parts/blocks/elements-block/advice_block_white.php -->
<?php
$visibility = get_sub_field('visibility');
$clone = get_sub_field('clone');
$color_theme = get_sub_field('theme_col');
$color_container = get_sub_field('color-container');
$block_id = get_sub_field('block_id');

if ($visibility) { ?>
 <section id="<?php if($block_id){ echo $block_id;}?>" class="advice-block advice-white" style="background-color: <?php if($color_theme){ echo $color_theme;}else{ echo '#fff';}?>"> 
  <div class="container" <?php if($color_container){ echo ' style="background: '.$color_container.'"';}?>>
    <?php
     if (is_array($clone) && isset($clone['elements_block']) && is_array($clone['elements_block'])) {
        foreach ($clone['elements_block'] as $element) {
            $block_type = $element['acf_fc_layout'];
            $template_path = 'template-parts/blocks/elements-block/' . $block_type;
            $context = array(
                'element' => $element,
            );
            get_template_part($template_path, null, $context);
        }
    } ?>
   </div>
  </section>
    <?php  
}