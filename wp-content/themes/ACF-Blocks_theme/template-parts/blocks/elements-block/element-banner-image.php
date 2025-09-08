<?php
$element = $args['element'];
$image = $element['img'];
if($image):
?>
<div class="element_banner_image"><img alt="banner image" src="<?php echo $image; ?>"></div>
<?php 
    endif;
?>