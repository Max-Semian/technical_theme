<?php
$element = $args['element'];
$table_headings = $element['table-heading'];
$table_items = $element['table-items'];
$table_color_1 = $element['czvet_fona_stroki_1'];
$table_color_2 = $element['czvet_fona_stroki_2'];
?>
<style>
 body{
  --table-color-1: <?php if($table_color_1){ echo $table_color_1;} else{ echo '#FAFCFE';}?>;
  --table-color-2: <?php if($table_color_2){ echo $table_color_2;} else{ echo '#fff';}?>;
 }
  .element_limit_table th, .element_limit_table tbody tr{
    background-color: var( --table-color-1);
  }
  .element_limit_table tbody tr:nth-child(odd){
    background-color: var( --table-color-2);
  }
</style>  
<div class="overflow-wrapper">
<div class="element_limit_table-wrapper">
 <table class="element_limit_table">
   <thead>
     <tr>
       <?php if($table_headings): ?>
         <?php foreach($table_headings as $table_heading): ?>
           <th>
             <?php if($table_heading['img']): ?><img alt="table-icon" src="<?php echo $table_heading['img']?>"><?php endif; ?>
             <?php if($table_heading['title']): ?><?php echo wpautop($table_heading['title']); ?><?php endif; ?>
           </th>
         <?php endforeach; ?>
       <?php endif; ?>
     </tr>
   </thead>
   <tbody>
     <?php if($table_items): ?>
       <?php foreach($table_items as $table_item): ?>
         <tr>
           <?php
             $element_string_items = $table_item['string-element'];
             if($element_string_items){
               foreach($element_string_items as $element_string_item){
                 echo '<td class="element_string_item">'.wpautop($element_string_item['text']).'</td>';
               }
             }
           ?>
         </tr>
       <?php endforeach; ?>
     <?php endif; ?>
   </tbody>
 </table>
</div>
</div>
<div style="display: none" class="custom-scrollbar ds-hide">
  <div class="scrollbar-track">
    <div class="scrollbar-thumb"><img alt="arrow" src="/wp-content/uploads/2024/09/Vector-4-1.svg"></div>
  </div>
</div>