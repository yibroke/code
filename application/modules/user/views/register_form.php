

<div class="container">
    <div class="col-md-4 col-md-offset-4 myform">
<h1>Sign up</h1>
<div id="myerror"></div>
            <?php echo form_open('user/register_validation', array('id' => 'form_register', 'role' => 'form')); ?>
           <div id="register_result"></div>
            <div class="form-group">
                <label for="Text">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required="required">
            </div>
            <div class="form-group">
                <label for="Text">Name:</label>
                <input type="name" class="form-control" id="name" name="name" required="required">
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required="required">
            </div>
            <div class="form-group">
                <label for="Password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required="required">
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
            <?php echo form_close(); ?>
            
             <div id="load"> <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button></div>
             
             
             <!-- LOGIN WITH FACEBOOK OR GOOGLE -->
             <hr>
             <p>Or</p>
			
			 <div id="status"> </div>
          
   <button onclick="Login();" class="btn btn-info">Login Facebook</button>
             
             <div id="message"><br/></div>
			 <div class="g-signin2" data-onsuccess="onSignIn"></div>
             </div>
</div>