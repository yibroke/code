<br>
<h1>Add/Edit banner</h1>
<?php 
 //noted the .$update_id. Can be empty if insert and can be a number if edit. 
 echo form_open('banner/insert_validation/'.$update_id, array('id' => 'form_insert_page', 'role' => 'form')); 
// If $update_id not empty mean this is the edit form. Create a input text read only or hidden for id
   if(isset($update_id)){?>
<input type="text" readonly="readonly" value="<?php echo $update_id; ?>" name="id" id="id">
   <?php
   }
   ?>
  <div class="form-group" style="max-width: 200px">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"/>
  </div>

  <div class="form-group" style="max-width: 200px">
    <label>Img</label>
    <input type="text" name="img" class="form-control" value="<?php echo $img; ?>"/>
  </div>
  <div class="form-group" style="max-width: 200px">
    <label>Link</label>
    <input type="text" name="link" class="form-control" value="<?php echo $link; ?>"/>
  </div>

 <div class="form-group" style="max-width: 200px">
       <select class="form-control" name="type_id" required="required">
         <option value="">Choose a category</option>
            <?php 
             foreach ($types as $cat) {
                     ?>
                       <option <?php if($cat->id==$type_id){ echo 'selected="selected"';} ?> value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                     <?php
                 }
            ?>
            </select>
   </div>

  <button type="submit" class="btn btn-success">Submit</button>
 <?php echo form_close(); ?>
