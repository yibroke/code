<style>
    input{
        max-width: 500px;
    }
</style>
<h1>Add Memu</h1>
    <?php echo form_open('menu_sub/menu_sub_validation', array('id' => 'form_menu', 'role' => 'form')); 
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
        <label for="text">Link:</label>
        <input type="text" required class="form-control" name="link" value="<?php echo $link; ?>">
    </div> 

 <div class="form-group">
        <label for="sel1">Choose Menu:</label>
        <select required="required" class="form-control" name="fk_menu" id="fk_menu">
            <option value="">Choose menu</option>
            <?php
              
            foreach ($menus as $menu) {
                ?>
                <option <?php if($menu->id==$fk_menu){ echo 'selected="selected"';} ?> value="<?php echo $menu->id; ?>"><?php echo $menu->name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
       
        <label class="radio-inline"><input required="required" value="y" <?php if($public=="y"){echo 'checked="checked"';} ?> type="radio" name="public"><?php echo lang('public'); ?></label>
        <label class="radio-inline"><input required="required" value="n" <?php if($public=="n"){echo 'checked="checked"';} ?>  type="radio" name="public"><?php echo lang('no_public'); ?></label>
        </div> 
       <button type="submit" class="btn btn-success">Submit</button>
    <?php echo form_close(); 