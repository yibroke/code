<style>
    input{
        max-width: 500px;
    }
</style>
<h1><?php echo lang('add').' '.  lang('menu'); ?></h1>
    <?php echo form_open('menu/menu_validation', array('id' => 'form_menu', 'role' => 'form')); 
    // If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="hidden" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
     <div class="form-group">
        <label for="text">Name:</label>
        <input type="text" required="required" class="form-control" name="name" value="<?php echo $name; ?>">
    </div> 
     <div class="form-group">
        <label for="text">Link:Sử dụng link ko copy tên miền. ví dụ cokhicuonglam.com/linka thì copy linka thôi nhé.</label>
        <input type="text" class="form-control" name="link" value="<?php echo $link; ?>">
    </div> 
 <div class="form-group">
       
        <label class="radio-inline"><input required="required" value="y" <?php if($public=="y"){echo 'checked="checked"';} ?> type="radio" name="public">Public</label>
        <label class="radio-inline"><input required="required" value="n" <?php if($public=="n"){echo 'checked="checked"';} ?>  type="radio" name="public">No puplic</label>
 </div> 
       <button type="submit" class="btn btn-success">Submit</button>
    <?php echo form_close(); 