<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>public/bootstrap-social-gh-pages/bootstrap-social.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/style.css?<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/angular.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/myangular.js" type="text/javascript"></script>
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
   <!-- header web -->
  <div class="container header_web">

     <div class="row">
         <div class="col-xs-3 hidden-xs">
             <a class="navbar-brand" href="<?php echo base_url(); ?>"><img class="img-responsive" src="<?php echo base_url(); ?>img/template/logo.png?1"></a>
         </div>
         <div class="col-xs-6"><br>
              <!-- search -->
              <?php
              echo form_open('topic/tim-kiem',array('id'=>'form_search','role'=>'form','method'=>'GET'));
             // echo form_open('topic/keyup',array('id'=>'form_search','role'=>'form','method'=>'GET'));
              ?>
              <div class="form-group has-feedback">
              <input class="form-control" type="text" name="search" id="search" onkeyup="dokeyup(this.value);" autocomplete="off" placeholder="Search...">
               <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
           <?php echo form_close(); ?>
              <div id="ketqua"></div><!-- print live search result--!>
             <!-- end search -->
         </div>
         <div class="col-xs-3 hidden-xs">
             <br>
          <?php
                    if ($this->session->userdata('logged_in') == TRUE) {
                        //update last seen file name last_seen in helper
                         $this->reuse_model_function->last_seen($this->session->userdata('user_id'));
                        ?>
                          <a href="<?php echo base_url().'topic/insert' ?>" class="btn btn-success pull-right"><span class="glyphicon glyphicon-pencil">Post</a>
                      <?php
                    }
                       ?>
             </div>
    
     </div>
 </div><!-- END HEADER web -->
 <nav class="navbar navbar-inverse navbar-custom">
            <div class="container">
			<div class="row">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand phone_brand" href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span> Home </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                     <li <?php if($current=='index'){ echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                     <?php echo Modules::run('menu/nav'); ?>
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
                        <li><a href="<?php echo base_url() ?>shop-info"><span class="glyphicon glyphicon-dashboard"></span> Control</a></li>
                        <?php
                        }                
                        ?>
                           
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
</div>
</nav>  
  <!-- header mobile -->
   <div class="container header_mobile">
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

<footer class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <p>Web build with Codeigniter by <strong>Kinny</strong></p>
            <p>Email: cotcac@gmail.com</p>
      
    </div>

    <br>
</footer>
<?php $this->load->view('user/login_form'); ?>
</body>
</html>
