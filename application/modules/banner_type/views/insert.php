<style>
    input{
        max-width: 500px;
    }
</style>
    <h1>Insert Category</h1>
    <?php echo form_open('category/category_validation', array('id' => 'form_category', 'role' => 'form','novalidate' => '')); 
    // If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
     <div class="form-group">
        <label for="text">Name: <?php echo form_error('name'); ?></label>
        <input type="text" required="required" class="form-control" name="cat_name" id="cat_name" value="<?php echo $cat_name; ?>">
    </div> 
       <button type="submit" class="btn btn-success">Submit</button>
    <?php echo form_close(); 
    