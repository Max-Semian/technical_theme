<!-- template-parts/blocks/elements-block/welcome_bonus.php -->
<?php
$visibility = get_sub_field('visibility');
$clone = get_sub_field('clone');
$text = get_sub_field('block_game_now_text');
$link = get_sub_field('block_game_now_link');
$color = get_sub_field('block_game_now_color');
$block_id = get_sub_field('block_id');
if ($visibility) { ?>
<style>
 .play-now{
    --play-now-color: <?php echo $color;?>;
    background-color:   var(--play-now-color);
 }
</style>
 <section id="<?php if($block_id){ echo $block_id;}?>" class="play-now" style="background-color: <?php if($color_theme){ echo $color_theme;}else{ echo '#fff';}?>"> 
  <div class="container">
     <a href="<?php if($link){echo $link;}?>" class="btn btn__violet btn-main game-now-btn content-center"><?php echo wpautop($text);?></a>
  </div>
</section>
<?php  
}