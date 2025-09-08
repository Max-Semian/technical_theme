<?php 
$element = $args['element'];
$title = $element['title'];
$subtitle = $element['text'];
$bg_image_ds =  $element['bg_pc'];
$bg_image_mobile = $element['bg_mb'];
?>
<style>
.element_get_bonus {
 background-size: cover;
 background-position: center;
 background-repeat: no-repeat;
 background-image: var(--bg-image);
}
<?php
if($bg_image_ds ){ ?>
.element_get_bonus {
 --bg-image: url('<?php echo $bg_image_ds; ?>');
} 
<?php
}
?>
@media (max-width: 992px) {
<?php
    if($bg_image_mobile ){ ?>
    .element_get_bonus {
    --bg-image: url('<?php echo $bg_image_mobile; ?>');
    }   
    <?php
    }
?>
}
</style>
<div class="element_get_bonus row between"> 
    <div class="element_get_bonus__text">
        <div class="element_get_bonus__text--title"><?php echo wpautop($title);?></div>
        <?php if ( $subtitle ) { ?>
            <div class="element_get_bonus__text--subtile"><?php echo wpautop($subtitle);?></div>
        <?php } ?>
    </div>
    <div class="element_get_bonus__btn column jc-center"><a href="<?php if($element['link']){ echo $element['link'];}
    ?>" class="btn btn__blue"><?php if($element['link_text']){ echo $element['link_text'];}
    ?><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_157_1222)">
    <path d="M1.33333 9.66675H7.5V16.0001H2.5C1.86 16.0001 1.33333 15.4734 1.33333 14.8334V9.66675ZM14.6667 9.66675V14.8334C14.6667 15.4734 14.14 16.0001 13.5 16.0001H8.5V9.66675H14.6667ZM0 5.83341V7.50008C0 8.14008 0.526667 8.66675 1.16667 8.66675H7.5V4.66675H1.16667C0.526667 4.66675 0 5.19341 0 5.83341ZM14.8333 4.66675H8.5V8.66675H14.8333C15.4733 8.66675 16 8.14008 16 7.50008V5.83341C16 5.19341 15.4733 4.66675 14.8333 4.66675Z" fill="white"/>
    <path d="M7.99986 5.36264C7.92807 5.36243 7.85715 5.3468 7.79192 5.31681C7.72669 5.28682 7.66866 5.24316 7.62175 5.1888C7.57485 5.13444 7.54017 5.07064 7.52006 5.00172C7.49996 4.9328 7.49489 4.86036 7.5052 4.7893C7.75186 3.12264 9.05386 -0.0300293 12.2192 -0.0300293C14.0259 -0.0293626 14.6665 0.946638 14.6665 1.78264C14.6665 3.26864 12.5979 5.36264 7.99986 5.36264ZM12.2192 0.970637C9.8312 0.970637 8.92453 3.24064 8.62386 4.34797C10.5079 4.25997 11.6959 3.7833 12.3799 3.3773C13.3285 2.81397 13.6665 2.18397 13.6665 1.78197C13.6665 1.1833 12.9192 0.970637 12.2192 0.970637Z" fill="white"/>
    <path d="M8.00065 5.3627C3.40265 5.3627 1.33398 3.2687 1.33398 1.7827C1.33398 0.946703 1.97532 -0.0292969 3.78198 -0.0292969C6.94665 -0.0292969 8.24865 3.12337 8.49532 4.79004C8.50553 4.86104 8.50038 4.9334 8.48022 5.00225C8.46006 5.07109 8.42537 5.1348 8.37848 5.18909C8.33159 5.24337 8.27359 5.28696 8.20841 5.31691C8.14323 5.34686 8.07238 5.36248 8.00065 5.3627ZM3.78198 0.970703C3.08198 0.970703 2.33398 1.18404 2.33398 1.7827C2.33398 2.63404 3.82265 4.18537 7.37598 4.3487C7.07598 3.2407 6.16932 0.970703 3.78198 0.970703Z" fill="white"/>
    </g>
    <defs>
    <clipPath id="clip0_157_1222">
    <rect width="16" height="16" fill="white"/>
    </clipPath>
    </defs>
    </svg>
    </a></div>
  
</div>