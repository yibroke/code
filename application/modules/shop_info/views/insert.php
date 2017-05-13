<style>
    input{
        max-width: 500px;
    }
</style>
    <h1>Insert Category</h1>
    <?php echo form_open('shop_info/shop_info_validation', array('id' => 'form_category', 'role' => 'form','novalidate' => '')); 
    // If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
      <div class="form-group">
        <label for="text">Name:</label>
        <input type="text" required="required" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
    </div> 
      <div class="form-group">
        <label for="text">Phone:</label>
        <input type="text" required="required" class="form-control" name="phone" id="name" value="<?php echo $phone; ?>">
    </div> 
      <div class="form-group">
        <label for="text">Email:</label>
        <input type="text" required="required" class="form-control" name="email" id="name" value="<?php echo $email; ?>">
    </div> 
      <div class="form-group">
        <label for="text">Address:</label>
        <input type="text" required="required" class="form-control" name="address" id="name" value="<?php echo $address; ?>">
    </div> 
       <button type="submit" class="btn btn-success">Submit</button>
    <?php echo form_close(); 