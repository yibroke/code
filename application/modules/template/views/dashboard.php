<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/admin.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/navbar-fixed-side.css" rel="stylesheet" type="text/css"/>
       <link rel="icon" type="images/png" sizes="32x32" href="<?php echo base_url(); ?>favicon-32x32.png">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keyword; ?>">
        <script type="text/javascript">
         //set base_url use with ajax
         var base_url = "<?php echo base_url(); ?>";
         </script>
         <style>
             .navbar-nav>li>a{
                 padding-left: 30px;
             }
             body { padding-top: 50px; }
         </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    
                    <a style="padding: 10px;" class="navbar-brand" href="#">User Dashboard</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                     <li><a href="<?php echo base_url(); ?>dashboard/"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>user/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
      <nav class="navbar navbar-inverse navbar-fixed-side">
        <!-- normal collapsible navbar markup -->
        <ul class="nav navbar-nav my_nav_left">
       
      <li <?php if($current=='my_account'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>user/my_account"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
      <li <?php if($current=='my_poll'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>question/my_poll/q_id"><span class="glyphicon glyphicon-blackboard"></span> My Polls</a></li>
      <li <?php if($current=='my_poll_vote'){echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>vote/my_poll_vote"><span class="glyphicon glyphicon-ok-circle"></span> My Poll Votes</a></li>
      <li <?php if($current=='my_vote'){echo 'class="active"';} ?>><a href="<?php echo base_url(); ?>vote/my_vote"><span class="glyphicon glyphicon-ok-circle"></span> My Votes</a></li>
      <li <?php if($current=='my_poll_comment'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>comment/my_poll_comment/"><span class="glyphicon glyphicon-comment"></span> My Poll Comments</a></li>
      <li <?php if($current=='my_comment'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>comment/my_comment/"><span class="glyphicon glyphicon-comment"></span> My Comments</a></li>
      
      <?php
         if($this->session->userdata('user_role')=='admin'){
                            ?>
                        <li><a href="<?php echo base_url() ?>/question/list_question/q_id"><span class="glyphicon glyphicon-asterisk"></span> Control</a></li>
                        <?php
                        } 
                        ?>
      <li <?php if($current=='comments'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>"><span class="glyphicon glyphicon-home"></span> Home Page</a></li>
    </ul>
      </nav>
    </div>
    <div class="col-sm-9 col-lg-10">
      <!-- your page content -->
        <?php
            $this->load->view($module . '/' . $view_file);
            
            ?>
      
      
      
      
    </div>
  </div>
</div>
        <footer class="container-fluid text-center">
            <p></p>
        </footer>


    </body>
</html>
