<div class="container">
 <div class="col-md-4 col-md-offset-4 myform">
<h1>Password recovery</h1>

<div id="myerror"></div>
<?php echo validation_errors("<p style='color:red;'>","</p>"); ?>
  <?php echo form_open('user/email_validation', array('id' => 'email_form', 'role' => 'form')); ?>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" id="email" required="required">
  </div>
<button type="submit" class="btn btn-success">Submit</button>
<?php echo form_close(); ?>
   <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
</div>
    </div>