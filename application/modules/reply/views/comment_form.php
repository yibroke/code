<script>
function doConfirm(id)
{
    var ok= confirm("Are you sure? You want to delete id:"+id);
    if(ok)
    {
        $.ajax({
        type:'post',
        url:base_url+'comment/delete',
        data:'id='+id,
        success: function (data) {
            if(data==='true')
            {
                 location.reload();  
            }
            else
            {
                alert(data);
            }
         
        }
    });
    }
}
</script>
<?php
     echo form_open('comment/insert_validation/', array('id' => 'form_insert_comment', 'role' => 'form')); 
  ?>
    <!-- change the topic id according to the app-->
    <input type="hidden" name="comment_for_id" id="comment_for_id" value="<?php echo $id; ?>" >
    <input type="hidden" name="comment_user_id" id="comment_user_id" value="<?php echo $user_id; ?>">
  <div class="form-group">
      <label></label>
    <textarea class="form-control my-comment" required="required" placeholder="<?php echo lang('comments'); ?>" rows="4" cols="50" name="comment_content" id="comment_content" ></textarea>
  </div>
    <div id="myerror"></div>
     <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
     <?php
     if($user_id==1)
     {
         ?>
     <a href="" class="call-modal-login" data-toggle="modal"><button class="btn btn-success"> <span class="glyphicon glyphicon-user"></span> Login to comment</button></a>
     <?php
     }else{
         ?>
      <button type="submit" class="btn btn-success">Submit</button>
     <?php
     }
  ?>
 <?php echo form_close(); ?>
  <br>
             <!-- New Comment go here-->
             <ol id="update" class="timeline"></ol>
            <?php
            $i=1;
            foreach ($query as $row) {
                ?>
                   
                        <div class="comment_content">
                            <p><strong><?php echo $row->user_name; ?></strong> <span class="text-muted small"> <?php  echo $this->time_ago->convert_time_ago($row->comment_date);  ?></span>
                        <?php
                        if(($user_id==$row->fk_user_id)or($user_id==$owner)and($owner!=1))//same commentor, same owner but owner not guess(guess cant be owner)
                        {
                            ?>
                         <a href="#" onclick="doConfirm('<?php echo $row->comment_id; ?>')"><button class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></button></a>
                        <?php
                        }
                        ?>
                    </p>
                    <?php echo $row->comment_content; ?>
                    <br>
                   
                    <?php
                     $this->load->module('comment');//module
                     $this->comment->reply($row->comment_id);//funciton                 
                    ?>
                    
                     <div class="clearfix"></div>
                    <ul>
                        <li style="margin-left: 60px">
                            
                            
                             <?php
                                if($user_id==1)
                                {
                                    ?>
                                <a href="" class="call-modal-login" data-toggle="modal"><button class="btn btn-success"> <span class="glyphicon glyphicon-user"></span> Login to comment</button></a>
                                <?php
                                }else{
                                    ?>
                               
                                 <a href="#" class="reply-link" data-remove="<?php echo $i; ?>">Reply</a>
                              <?php
                                }
                            ?>
                            
                             
                             <div class="wra-comment active">
                                 <textarea id="reply_content<?php echo $row->comment_id; ?>" placeholder="Nội dung bình luận" class="cm_sub_content" rows="3" cols="70"></textarea>  
                                
                                 <a data-button="<?php echo $row->comment_id; ?>" class="btn btn-success btn-xs send-reply">Submit</a> 
			     </div>
                        </li>
                    </ul>
   
                    </div>
                    <hr>
                    <?php
                    $i++;
                    }
                    ?>
            <!-- complain form-->
             <ol id="moredata"></ol>
             <?php if($total>0){?>
             <div class="text-center">  <button class="btn btn-success" id="loadmore" value="<?php echo $id; ?>">Load More <span class="badge"><?php echo $total; ?></span></button></div>
             <?php
             } ?>
         <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
            <input type="hidden" name="offset" id="offset" value="10"/>
            <input type="hidden" name="total" id="total" value="<?php echo $total; ?>"/>
            
            

          
        



   
  
  
  
