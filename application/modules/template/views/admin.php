<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      
        <link href="<?php echo base_url(); ?>css/style_admin.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/simple-sidebar.css" rel="stylesheet" type="text/css"/>
            <script src="<?php echo base_url(); ?>public/include/angular.min.js" type="text/javascript"></script>
            <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0-beta.2/angular-sanitize.js"></script>
        <script src="<?php echo base_url(); ?>public/include/myangular.js" type="text/javascript"></script>
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
    <body ng-app="myApp" ng-controller="myCtrl">
        <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a style="padding: 10px;" class="navbar-brand" id="menu-toggle" href="#"><span class="glyphicon glyphicon-resize-horizontal"></span></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                    <li <?php
                        if ($current == 0) {
                            echo "class='active'";
                        }
                        ?>><a href="<?php echo base_url(); ?>dashboard/"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name'); ?></a></li>
                    <li <?php
                    if ($current == 0) {
                        echo "class='active'";
                    }
                    ?>><a href="<?php echo base_url(); ?>user/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<div class="container-fluid">
  <div class="row">
     <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
      <li <?php if($current=='comments'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>"><span class="glyphicon glyphicon-home"></span> <?php echo lang('home'); ?></a></li>
      <li><a href='<?php echo base_url(); ?>notification/list-notification'> <span class="glyphicon glyphicon-bell"></span><?php echo Modules::run('bell/count_bell');?> </a></li>                 
      <li <?php if($current=='user'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>user/list_user"><span class="glyphicon glyphicon-user"></span> <?php echo lang('customer'); ?> </a></li>
      <li <?php if($current=='items'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>items/list_items/id"><span class="glyphicon glyphicon-oil"></span> <?php echo lang('items'); ?></a></li>
      <li <?php if($current=='color'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>color/"> <span class="glyphicon glyphicon-text-color"></span> <?php echo lang('color'); ?></a></li>
      <li <?php if($current=='size'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>size/"> <span class="glyphicon glyphicon-text-size"></span> <?php echo lang('size'); ?></a></li>
      <li <?php if($current=='wholesale'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>wholesale/"> <span class="glyphicon glyphicon-tower"></span> <?php echo lang('whole_sale'); ?></a></li>
      <li <?php if($current=='order'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>order/list_order"><span class="glyphicon glyphicon-shopping-cart"></span> <?php echo lang('order'); ?></a></li>
      <li <?php if($current=='comment'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>comment/list_comment"><span class="glyphicon glyphicon-comment"></span> <?php echo lang('comments'); ?></a></li>
      <li <?php if($current=='shop_info'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>shop_info/index"><span class="glyphicon glyphicon-bell"></span> <?php echo lang('shop_info'); ?></a></li>
      <li <?php if($current=='banner'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>banner/list-banner"><span class="glyphicon glyphicon-picture"></span> <?php echo lang('banner'); ?></a></li>
      <li <?php if($current=='category'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>category/index"><span class="glyphicon glyphicon-tags"></span> <?php echo lang('category'); ?></a></li>
      <li <?php if($current=='quick_search'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>quick_search/list-quick_search"><span class="glyphicon glyphicon-search"></span> Quick search</a></li>
      <li <?php if($current=='project'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>project/list-project"><span class="glyphicon glyphicon-asterisk"></span> Tutorials</a></li>
      <li <?php if($current=='project'){echo 'class="active"';} ?>><a href="<?php echo base_url() ?>page/list-page"><span class="glyphicon glyphicon-pencil"></span> Page</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-chevron-down"></span>Most orders Items</a>
        <ul class="dropdown-menu" style="background-color: black; width: 100%;">
          <li><a href="<?php echo base_url() ?>order/times">Most order Items by times</a></li>
          <li><a href="<?php echo base_url() ?>order/quantity">Most order Items by quantity</a></li>
        </ul>
      </li>
      </li>
   </ul>
       </div>
        <!-- /#sidebar-wrapper -->
    <div class="col-md-12">
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
         <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    </div>
    </body>
</html>
