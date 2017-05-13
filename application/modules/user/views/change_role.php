<h1>Change role for user: <strong><?php echo $query->user_name; ?></strong></h1>
<p>Curently user role: <?php echo $query->user_role; ?></p>
<?php
     echo form_open('user/change_role_validation/', array('id' => 'form_change_role', 'role' => 'form')); 
  ?>
 <input type="hidden" name="change_user_id" id="change_user_id" value="<?php echo $user_id; ?>">
  <div class="form-group" style="max-width: 200px">
           <select class="form-control" name="new_role" required="required">
                <option <?php if($query->user_role=='user'){ echo 'selected="selected"';} ?> value="user">User</option>
                <option <?php if($query->user_role=='sponsor'){ echo 'selected="selected"';} ?> value="sponsor">Sponsor</option>
                <option <?php if($query->user_role=='admin'){ echo 'selected="selected"';} ?> value="admin">Admin</option>
            </select>
          </div>
  <button type="submit" class="btn btn-success">Submit</button>
 <?php echo form_close(); ?>