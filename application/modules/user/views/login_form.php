<!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
        <p>This only available for Admin Account.</p>
      </div>
      <div class="modal-body">
      <div id="error_login"></div>
  <?php echo form_open('user/login_validation', array('id' => 'form_login', 'role' => 'form')); ?>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email_login" id="email_login">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password_login" id="password_login">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>

 <div id="load_login"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
     
    </div>
  </div>
</div><!-- end modal -->