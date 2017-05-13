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
function doConfirm_reply(id)
{
    var ok= confirm("Are you sure? You want to delete id:"+id);
    if(ok)
    {
        $.ajax({
        type:'post',
        url:base_url+'reply/delete',
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
    <textarea class="form-control my-comment" required="required" placeholder="<?php echo lang('content');?>" rows="2" cols="50" name="comment_content" id="comment_content" ></textarea>
  </div>
    <div id="myerror"></div>
     <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
     <?php
     if($user_id==1)
     {
         ?>
     <a href="" class="call-modal-login" data-toggle="modal"><button class="btn btn-success"> <span class="glyphicon glyphicon-user"></span> <?php echo lang('comments'); ?></button></a>
     <?php
     }else{
         ?>
    
      <button type="submit" class="btn btn-success"><?php echo lang('comments'); ?></button>
     <?php
     }
  ?>
 <?php echo form_close(); ?>
      
  <br>
   <ol id="update" class="timeline"></ol>
             <!-- New Comment go here-->
             
            <?php $this->load->view('load_comment'); ?>
  <div class="clearfix"></div>
            <!-- complain form-->
            <div id="moredata"></div>
             <?php if($total>0){?>
            <div class="text-center">  <button class="btn btn-success" id="loadmore" value="<?php echo $id; ?>"><?php echo lang('load_more'); ?> <span class="badge"><?php echo $total; ?></span></button></div>
             <?php
             } ?>
         <div id="load"> <button class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
            <input type="hidden" name="offset" id="offset" value="10"/>
            <input type="hidden" name="total" id="total" value="<?php echo $total; ?>"/>
          
        



   
  
  
  
