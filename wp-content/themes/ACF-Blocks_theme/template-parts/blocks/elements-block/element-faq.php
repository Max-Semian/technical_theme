<?php
$element = $args['element'];
$faq_items = $element['faqs'];
$faq_bgc = $element['bgc'];
if($faq_items):
?>
<style>
body{
 --faq-bg: <?php if($faq_bgc){ echo $faq_bgc;} else{ echo '#FFFFFF';}?>;
}
.element_faq_item{
 background: var(--faq-bg);
}
</style>

<div class="element_faq" itemscope itemtype="https://schema.org/FAQPage">
    <?php foreach($faq_items as $faq_item):?>
        <div class="element_faq_item" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
          <div class="element_faq_item--title row align-top between">
             <h3 itemprop="name"><?php echo $faq_item['q'];?></h3>
             <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 7.42017C5.78493 7.42017 5.5699 7.33805 5.40593 7.17417L0.2462 2.01439C-0.082026 1.68616 -0.082026 1.154 0.2462 0.825904C0.574293 0.497811 1.10635 0.497811 1.4346 0.825904L6 5.39156L10.5654 0.826063C10.8936 0.49797 11.4256 0.49797 11.7537 0.826063C12.0821 1.15416 12.0821 1.68632 11.7537 2.01455L6.59407 7.17433C6.43002 7.33824 6.21498 7.42017 6 7.42017Z" fill="#031D30"/>
             </svg>
          </div>
         <div class="element_faq_item--text" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
            <div itemprop="text"><?php echo $faq_item['ans'];?></div>
         </div>
        </div>
        <?php endforeach; ?>
</div>
<?php 
    endif;
?>