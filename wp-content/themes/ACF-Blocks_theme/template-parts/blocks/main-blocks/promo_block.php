<!-- template-parts/blocks/elements-block/promo_block.php -->
<?php
$visibility = get_sub_field('visibility');
$clone = get_sub_field('clone');
$bg_image_ds = get_sub_field('bg_ds');
$color_theme = get_sub_field('theme_col');
$bg_image_mobile = get_sub_field('bg_mob');
$block_id = get_sub_field('block_id');
if ($visibility) { ?>
<style>
.promo-block .container {
 background-size: cover;
 background-position: center;
 background-repeat: no-repeat;
 background-image: var(--bg-image);
}
<?php
if($bg_image_ds ){ ?>
.promo-block .container {
 --bg-image: url('<?php echo $bg_image_ds; ?>');
} 
<?php
}
?>
@media (max-width: 992px) {
<?php
    if($bg_image_mobile){ ?>
  .promo-block .container {
    --bg-image: url('<?php echo $bg_image_mobile; ?>');
  }   
    <?php
    }
?>
}
</style>
 <section id="<?php if($block_id){ echo $block_id;}?>" class="promo-block" style="background-color: <?php if($color_theme){ echo $color_theme;}else{ echo '#fff';}?>"> 
  <div class="container">
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