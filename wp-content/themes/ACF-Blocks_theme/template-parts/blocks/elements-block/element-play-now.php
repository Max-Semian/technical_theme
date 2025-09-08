<?php
$element = $args['element'];
$play_now = $element['play-now-btn-text'];
if($play_now):
?>
<div class="play_now">
  <a href="<?php echo $element['play-now-btn'];?>" class="btn btn__violet btn-main game-now-btn content-center"><?php echo wpautop($play_now);?></a>
</div>
<?php 
endif;
?>