<div class="container">
 <div class="col-md-4 col-md-offset-4 myform">
<h1>Reset Password</h1>
<div id="myerror"></div>
<?php echo validation_errors("<p style='color:red;'>","</p>"); ?>

   <?php echo form_open('user/reset_password_validation', array('id' => 'form_reset_password', 'role' => 'form')); ?>
<input type="hidden" name="reset_key" id="reset_key" value="<?php echo $this->uri->segment(3); ?>">
  <div class="form-group">
    <label for="pwd">New Password:</label>
    <input type="password" class="form-control" name="password" id="password" required="required">
  </div>
  <div class="form-group">
    <label for="pwd">Confirn New Password:</label>
    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
  
 <?php echo form_close(); ?>

   <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
   </div>