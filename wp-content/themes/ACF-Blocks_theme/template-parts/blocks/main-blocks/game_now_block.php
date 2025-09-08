<?php
$visibility = get_sub_field('visibility');
$logo = get_sub_field('game_now_logo');
$game_now_bonus = get_sub_field('game_now_bonus');
$game_now_link = get_sub_field('game_now_link');
$bg_image_ds = get_sub_field('game_now_bg_ds');
$bg_image_mobile = get_sub_field('game_now_bg_mob');
$color_theme = get_sub_field('theme_col');
$color_section ='#F3F5FB';
$color_container = get_sub_field('color-container');
$block_id = get_sub_field('block_id');
if($color_theme){
  $color_section = '#FFFFFF';
}
if ($visibility) { ?>
<style>
.game-now-block {
 background-size: cover;
 background-position: center;
 background-repeat: no-repeat;
 background-image: var(--bg-image);
}
<?php
if($bg_image_ds ){ ?>
.game-now-block {
 --bg-image: url('<?php echo $bg_image_ds; ?>');
} 
<?php
}
?>
@media (max-width: 992px) {
<?php
    if($bg_image_mobile){ ?>
  .game-now-block  {
  --bg-image: url('<?php echo $bg_image_mobile; ?>');
  }   
    <?php
    }
?>
}
</style>
 <section id="<?php if($block_id){ echo $block_id;}?>" class="game-now-block"> 
  <div class="container row between">
    <div class="game-now-block-col-1 row between">
      <?php if($logo ){echo '<img src="'.$logo.'">';}?>
      <?php if($game_now_bonus ){echo '<span class="row align-center">'.wpautop($game_now_bonus).'</span>';}?>
    </div>
    <div class="game-now-block-col-2  row align-center">
    <?php if($game_now_link ){echo '<a href="'.$game_now_link.'" class="btn btn__violet btn-main game-now-btn content-center">Играть сейчас</a>';}?>
    </div>
   </div>
	 <div class="close-block">
		 <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g clip-path="url(#clip0_170_10)">
			<path d="M0.803675 16.9124C0.644731 16.9124 0.489349 16.8653 0.357182 16.777C0.225016 16.6887 0.122003 16.5632 0.0611735 16.4163C0.00034418 16.2695 -0.0155685 16.1079 0.0154481 15.952C0.0464647 15.7961 0.123017 15.653 0.235422 15.5406L15.0846 0.691433C15.2353 0.540723 15.4397 0.456055 15.6528 0.456055C15.866 0.456055 16.0704 0.540723 16.2211 0.691433C16.3718 0.842143 16.4565 1.04655 16.4565 1.25969C16.4565 1.47282 16.3718 1.67723 16.2211 1.82794L1.37193 16.6771C1.29737 16.7518 1.20879 16.811 1.11127 16.8514C1.01376 16.8918 0.909221 16.9125 0.803675 16.9124Z" fill="white"/>
			<path d="M15.6528 16.9124C15.5472 16.9125 15.4427 16.8918 15.3452 16.8514C15.2477 16.811 15.1591 16.7518 15.0845 16.6771L0.235378 1.82794C0.084668 1.67723 0 1.47282 0 1.25969C0 1.04655 0.084668 0.842143 0.235378 0.691433C0.386088 0.540723 0.590495 0.456055 0.803631 0.456055C1.01677 0.456055 1.22117 0.540723 1.37188 0.691433L16.221 15.5406C16.3334 15.653 16.41 15.7961 16.441 15.952C16.472 16.1079 16.4561 16.2695 16.3953 16.4163C16.3344 16.5632 16.2314 16.6887 16.0993 16.777C15.9671 16.8653 15.8117 16.9124 15.6528 16.9124Z" fill="white"/>
			</g>
			<defs>
			<clipPath id="clip0_170_10">
			<rect width="17" height="17" fill="white"/>
			</clipPath>
			</defs>
		</svg>
	 </div>
  </section>
    <?php  
}