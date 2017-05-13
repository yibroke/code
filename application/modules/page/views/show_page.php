  <ul class="list-inline text-left">
      <li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<?php
    foreach ($records1 as $record) {
          $edit = base_url() . 'quick_search/insert-quick_search/' . $record->id;
          $detail = base_url() . 'page/detail/'. $record->page_url;
           if ($record->page_url == 'not-allow') {
               echo '';
           }else{
               ?>
           <li>|</li>
           <li> <a href="<?php echo $detail; ?>"> <?php echo $record->page_headline; ?></a></li>
        <?php
           }
        ?>
        
        <?php
}
?>
 </ul>
 



          
          
            
   