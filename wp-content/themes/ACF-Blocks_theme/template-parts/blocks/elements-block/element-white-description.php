<?php
 $element = $args['element'];
 $text = $element['text'];
 $text = wpautop($text, false);
?>
<div class="element_block_white-text">
    <?php echo  $text;?>
</div>
