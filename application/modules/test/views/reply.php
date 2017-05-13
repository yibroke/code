<?php
     echo form_open('reply/insert_validation/', array('id' => 'form_insert_commentfdsfas', 'role' => 'form')); 
  ?>
    <!-- change the topic id according to the app-->
    <input type="text" name="fk_comment_id" id="comment_for_id" value="34" >
    <input type="text" name="reply" id="comment_user_id" value="content">
 
      <button type="submit" class="btn btn-success">Submit</button>
    
 <?php echo form_close(); ?>