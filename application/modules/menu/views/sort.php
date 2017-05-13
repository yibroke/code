<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
 <script>
$(document).ready(function(){

var sortableLinks = $("#listofpages");
$(sortableLinks).sortable();
$('.save').click(function(){
    var data = $(sortableLinks).sortable('serialize');
   console.log(data);
   $.post(base_url+'menu/do_sort',{"data":data},function(d){
       alert(d);
   });
});

});//end ready
</script>
<h1>Change Angel Order</h1>
  <ul class="list-group" id='listofpages'>
     <?php 
     $i=1;
     foreach ($query as $row)
     {
         // the id have to start with item_
         ?>
          <li class="list-group-item" id='<?php echo 'item_'.$row->id; ?>'><?php echo $i.': '.$row->name; ?> <span class="glyphicon glyphicon-move"></span></li>
    
      <?php
      $i++;
     }
     ?>
      <br>
      <button type="submit" class="btn btn-success save">Submit</button>
</ul>