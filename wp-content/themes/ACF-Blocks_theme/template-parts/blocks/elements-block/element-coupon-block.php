<?php
 $element = $args['element'];
$link = $element['link-site-text'];
$image = $element['promo-image'];
 $title = $element['title'];
 $logo  = $element['logo'];
 $code  = $element['code'];
 $date  = $element['date'];
 $text  = $element['text'];
 $bg_col = $element['bg-col'];
 $title_check = $element['title_check'];
 $header_reg_link = get_field('header-reg-link', 'option');
?>
<div class="element_coupon_block row between" <?php if($bg_col){ echo 'style="background-color:'. $bg_col.'"';}?> >
    <div class="coupon-col__1 row between">
        <?php if( $logo ){ echo '<div class="element_coupon_logo w-full"><img alt="logo" src="'.$logo.'"></div>';}?>
        <p><?php echo  $title;?></p>
        <button class="transparent-blue">
            <span><?php echo  $title_check;?></span>
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.9375 8.55634C16.9375 9.27634 16.053 9.86977 15.8758 10.5335C15.693 11.2198 16.1556 12.176 15.8083 12.7765C15.4553 13.3868 14.3936 13.4599 13.8986 13.9549C13.4036 14.4499 13.3305 15.5116 12.7202 15.8646C12.1197 16.212 11.1634 15.7493 10.4772 15.9321C9.81344 16.1093 9.22 16.9938 8.5 16.9938C7.78 16.9938 7.18656 16.1093 6.52281 15.9321C5.83656 15.7493 4.88031 16.212 4.27984 15.8646C3.66953 15.5116 3.59641 14.4499 3.10141 13.9549C2.60641 13.4599 1.54469 13.3868 1.19172 12.7765C0.844375 12.176 1.30703 11.2198 1.12422 10.5335C0.947031 9.86977 0.0625 9.27634 0.0625 8.55634C0.0625 7.83634 0.947031 7.2429 1.12422 6.57915C1.30703 5.8929 0.844375 4.93665 1.19172 4.33618C1.54469 3.72587 2.60641 3.65274 3.10141 3.15774C3.59641 2.66274 3.66953 1.60102 4.27984 1.24805C4.88031 0.90071 5.83656 1.36337 6.52281 1.18055C7.18656 1.00337 7.78 0.118835 8.5 0.118835C9.22 0.118835 9.81344 1.00337 10.4772 1.18055C11.1634 1.36337 12.1197 0.90071 12.7202 1.24805C13.3305 1.60102 13.4036 2.66274 13.8986 3.15774C14.3936 3.65274 15.4553 3.72587 15.8083 4.33618C16.1556 4.93665 15.693 5.8929 15.8758 6.57915C16.053 7.2429 16.9375 7.83634 16.9375 8.55634Z" fill="#06C3CF"/>
                <path d="M10.9385 6.04197L7.72658 9.25385L6.06158 7.59025C5.88794 7.4167 5.65248 7.31921 5.40697 7.31921C5.16147 7.31921 4.92601 7.4167 4.75236 7.59025C4.57881 7.7639 4.48132 7.99936 4.48132 8.24486C4.48132 8.49037 4.57881 8.72583 4.75236 8.89947L7.08815 11.2353C7.25716 11.4041 7.48629 11.4989 7.72518 11.4989C7.96407 11.4989 8.19319 11.4041 8.36221 11.2353L12.2463 7.35119C12.4198 7.17754 12.5173 6.94209 12.5173 6.69658C12.5173 6.45108 12.4198 6.21562 12.2463 6.04197C12.1604 5.95605 12.0585 5.88789 11.9463 5.84138C11.8341 5.79487 11.7138 5.77094 11.5924 5.77094C11.4709 5.77094 11.3506 5.79487 11.2384 5.84138C11.1262 5.88789 11.0243 5.95605 10.9385 6.04197Z" fill="#FFFCEE"/>
            </svg>
        </button>
        <span class="coupon-col__1-text"><?php echo  $text;?></span>
    </div>
    <div class="coupon-col__2 row align-start">
        <div class="element_coupon">
            <div class="successed-copy">
                <img alt="icon" src="<?php echo  $image;?>">
            </div>
            <div class="element_coupon-code w-full column" data-coupon="<?php echo $code;?>">
                <p><?php echo  $code; ?></p>
                <span class="coupon-date"><?php echo $date; ?></span>
                <a href="<?php if($header_reg_link){ echo $header_reg_link;}?>" class="btn btn__violet content-center w-full"><?php echo  $link;?></a>
            </div>
            <button class="clickboard">
             <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.5294 14.6529C4.78102 14.6529 3.35795 13.2298 3.35795 11.4815V3.83289H2.05213C0.920114 3.83289 0 4.75282 0 5.88487V15.9587C0 17.0907 0.920114 18.0109 2.05213 18.0109H11.3797C12.5117 18.0109 13.4318 17.0907 13.4318 15.9587V14.6529H6.5294Z" fill="white" fill-opacity="0.5"/>
              <path d="M16.4166 2.15393C16.4166 1.02042 15.498 0.101807 14.3646 0.101807H6.52939C5.39587 0.101807 4.47726 1.02042 4.47726 2.15393V11.4815C4.47726 12.615 5.39587 13.5336 6.52939 13.5336H14.3646C15.498 13.5336 16.4166 12.615 16.4166 11.4815V2.15393Z" fill="white" fill-opacity="0.5"/>
             </svg>
            </button>
        </div>
    </div>
</div>