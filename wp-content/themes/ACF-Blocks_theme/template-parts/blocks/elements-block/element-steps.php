<?php
$element = $args['element'];
$step_items = $element['steps'];
$counter = 0;
if($step_items):
?>
<div class="element_step">
    <?php foreach($step_items as $step_item):?>
        <div class="element_step_item">
          <div class="element_step_item--title row">
             <span>
             <div class="step-counter"><?php $counter++; echo $counter;?></div>
                <?php echo wpautop($step_item['text']);?>
            </span>
          </div>
         <?php if($step_item['image']):?> <div class="element_step_item--image"><img src="<?php echo $step_item['image'];?>" alt="image"></div><?php endif;?>

         <?php if($step_item['ctr-btn-text']):?> 
            <div class="element_step_item--btn">
                <a href="<?php echo $step_item['ctr-btn-link'];?>" class="btn btn__violet btn-main content-center">
                    <?php echo wpautop($step_item['ctr-btn-text']);?>
                </a>
            </div>
            <?php endif;?>
        </div>
    <?php endforeach; ?>
</div>
<?php 
    endif;
?>