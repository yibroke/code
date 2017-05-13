<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- for google login -->
       <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="887144506805-qmu6dnnphb4tefmpecsecp10kllstjda.apps.googleusercontent.com">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/bootstrap-social-gh-pages/bootstrap-social.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/myjs.js?<?php echo time(); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/lazyload/lazysizes.min.js" async="" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>public/flag-icon-css-master/css/flag-icon.min.css" rel="stylesheet" type="text/css"/>
         <link rel="icon" type="images/png" sizes="32x32" href="<?php echo base_url(); ?>favicon-32x32.png">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta property="og:url" content="<?php echo base_url(); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $title; ?>" />
	<meta property="og:description" content="<?php echo $description; ?>" />
        <meta property="og:image:width" content="640"/> 
        <meta property="og:image:height" content="442"/>
         <meta property="og:image:type" content="image/jpeg" /> 
	<meta property="og:image" content="<?php echo $meta_img; ?>" />
        <script type="text/javascript">
         //set base_url use with ajax
         var base_url = "<?php echo base_url(); ?>";
         </script>
    </head>
    <body>
<?php //$this->load->view('analyticstracking'); ?>
<!--End of Tawk.to Script-->
        <script>
// FACEBOOK SIGN IN/ LOGIN
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1754921811386150',
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
	FB.Event.subscribe('auth.authResponseChange', function(response) 
	{
    if (response.status === 'connected') 
  	{
		//console.log('Connected to Facebook');	
  	}	 
    else if (response.status === 'not_authorized') 
    {
        console.log('Failed to Connect');
    } else 
    {
        console.log('Logged Out');//UNKNOWN ERROR
    }
	});	
    };
   	function Login()
	{
		FB.login(function(response) {
		   if (response.authResponse) 
		   {
		    	getUserInfo();
  			} else 
  			{
  	    	 console.log('User cancelled login or did not fully authorize.');
   			}
		 },{scope: 'email,user_photos,user_videos'});
	}

  function getUserInfo() {
	    FB.api('/me', function(response) {
		  //Codeigniter session set up.
                var user_name =response.name;
                var user_id =response.id;
                 if (user_name === null || user_name === "underfined"|| user_name === ""||user_id === null || user_id === "") {
                    alert("Facebook Login Error");
                    return false;
                }
				// alert(user_name+'-'+user_id);
		   $.ajax({
                     url:base_url+'user/fb_login',
                     type:'post',
		data: { 
			'user_name': user_name,
			'user_id': user_id
		 },
                     success:function(data){
			if(data==='true'){
                       window.location.reload(true);
		//console.log('Work');			  
                    }else{
			 checkLoginState();
			 alert(data);
		 }
                 }
	});// end ajax  	    
    });
    }
	function getPhoto()
	{
	  FB.api('/me/picture?type=normal', function(response) {

		  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
	  	  document.getElementById("status_login").innerHTML+=str; 	    
        });
	}
	function Logout()
	{
		FB.logout(function(){document.location.reload();});
	}
  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   //end facebook login
   </script>
   <!-- header web -->
  <div class="container-fluid header_web">
      <div class="row text-right language-bar-top">
          <br>
          <div class="col-lg-10 col-md-9 col-sm-6 col-xs-1"></div>
          <div class="col-lg-2 col-md-3 col-sm-6 col-xs-11">
               <!-- language -->
               <a href="http://kr.wellbeingbox.co.kr/"<?php if(base_url()=='http://kr.wellbeingbox.co.kr/'){ echo 'style="display: none;"'; } ?> ><span class="flag-icon flag-icon-kr"></span></a> 
               <a href="http://wellbeingbox.co.kr/"<?php if(base_url()=='http://wellbeingbox.co.kr/'){ echo 'style="display: none;"'; } ?>><span class="flag-icon flag-icon-us"></span></a>
               <a href="http://vn.wellbeingbox.co.kr/"<?php if(base_url()=='http://vn.wellbeingbox.co.kr/'){ echo 'style="display: none;"'; } ?>><span class="flag-icon flag-icon-vn"></span></a> 
            <!-- end language -->
          </div>
      </div>
     <div class="row">
         <div class="col-xs-3 hidden-xs">
             <a class="navbar-brand" href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url(); ?>img/template/logo.png?1"></a>
         </div>
         <div class="col-xs-6"><br>
              <!-- search -->
              <?php echo form_open('items/tim-kiem',array('id'=>'form_search','role'=>'form','method'=>'GET')); ?>
              <div class="form-group has-feedback">
              <input class="form-control" type="text" name="search" id="search" onkeyup="dokeyup(this.value);" autocomplete="off" placeholder="<?php echo lang('search'); ?>...">
               <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
           <?php echo form_close(); ?>
              <div id="ketqua"></div>
             <!-- end search -->
         </div>
         <div class="col-xs-3 text-right"><br>
             <?php
            // $giohang = count($this->cart->contents());
             $giohang = count($this->cart->contents());
             ?>
             <a href="<?php echo base_url(); ?>gio-hang/gio-hang-cua-tui" class="btn btn-success card-big"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo lang('card'); ?> <span class="badge"><?php echo $giohang; ?></span></a><br><br>
         </div>
     </div>
 </div><!-- END HEADER web -->
 <nav class="navbar navbar-inverse navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    </button>
                    
                    
                    <a class="navbar-brand phone_brand" href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span> Home </a>
                    <div class="text-center"> <a href="<?php echo base_url(); ?>gio-hang/gio-hang-cua-tui" class="navbar-brand phone_brand navbar-card"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo lang('card'); ?> <span class="badge"><?php echo $giohang; ?></span></a></div>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                     <li <?php if($current=='index'){ echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span> <?php echo lang('home'); ?></a></li>
                     <?php echo Modules::run('category/nav'); ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <?php
                    if ($this->session->userdata('logged_in') == TRUE) {
                       ?>
                    <li><a href="#" title="Notification" data-html="true" data-toggle="popover" data-placement="bottom" data-content=" <a href='<?php echo base_url(); ?>notification/list-notification'>See All</a>"><span class="glyphicon glyphicon-bell"></span> <?php echo Modules::run('bell/count_bell');?></a></li>                   
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name'); ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">	
                        <?php
                          if($this->session->userdata('user_role')=='admin'){
                            ?>
                        <li><a href="<?php echo base_url() ?>items/list_items/id"><span class="glyphicon glyphicon-dashboard"></span> Control</a></li>
                        <?php
                        }                
                        ?>
                            <li><a href="<?php echo base_url(); ?>order/my-order/"><span class="glyphicon glyphicon-shopping-cart"></span> My order </a></li>
                            <li><a href="<?php echo base_url(); ?>user/my-account/"><span class="glyphicon glyphicon-user"></span> My accout </a></li>
                            <li><a href="#" class="user_logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </li>
                    
                  
                    <?php
                } else {
                     echo Modules::run('user/check_cookie');// fire function cookie
                    ?>
                       <li> <a href="" class="call-modal-login" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> <?php echo lang('login'); ?></a></li>
                    <?php
                }
                ?>                                                   
</ul>
</div>
</div>
</nav>  
  <!-- header mobile -->
   <div class="container-fluid header_mobile">
     <div class="row">
         <div class="col-xs-12"><br>
              <!-- search -->
              <?php echo form_open('items/tim-kiem',array('id'=>'form_search','role'=>'form','method'=>'GET')); ?>
              <input class="form-control" type="text" name="search" id="search" onkeyup="dokeyup(this.value);" autocomplete="off" placeholder="<?php echo lang('search'); ?>...">
              <?php echo form_close(); ?>
              <div id="ketqua"></div>
             <!-- end search -->
         </div>
     </div>
       <br>
 </div>
 <!-- end header mobile -->
<?php
$this->load->view($module . '/' . $view_file);
?> 
<br>
<?php $this->load->view('user/login_form'); ?>
</body>
</html>
