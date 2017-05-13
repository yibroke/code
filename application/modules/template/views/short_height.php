<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/include/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url(); ?>public/include/myjs.js" type="text/javascript"></script>
        <!-- COLOR PICKER -->
<link href="<?php echo base_url(); ?>public/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>public/dist/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- END COLOR PICKER -->

        <link rel="icon" type="images/png" sizes="32x32" href="<?php echo base_url(); ?>favicon-32x32.png">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keyword; ?>">
         <meta property="og:url" content="<?php echo $link; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $title; ?>" />
	<meta property="og:description" content="<?php echo $description; ?>" />
	<meta property="og:image" content="<?php echo $meta_img; ?>" />
        <script type="text/javascript">
            //set base_url use with ajax
            var base_url = "<?php echo base_url(); ?>";
        </script>
        <style>
            body {
	background: url(http://i.imgur.com/GHr12sH.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

            
           
            .form-control{

                max-width: 400px;
            }
            .center_div{
                margin: 0 auto;
                width:80% /* value of your choice which suits your alignment */
            }

        </style>

    </head>
    <body>

        <nav class="navbar navbar-default navbar-custom">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand myband" href="<?php echo base_url(); ?>"> <img height="70" src="<?php echo base_url(); ?>img/template/poll.png"/></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if($current=='index'){ echo 'class="active"';} ?> ><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-pencil"></span> New Poll</a></li>
                        <li <?php if($current=='help'){ echo 'class="active"';} ?> ><a href="<?php echo base_url(); ?>home/help"><span class="glyphicon glyphicon-question-sign"></span> Help and Guide</a></li>
                      
                        
                        
                
                                  <?php
                    if ($this->session->userdata('logged_in') == TRUE) {
                    
                        ?>
                    <li <?php if($current=='login'){ echo 'class="active"';} ?> ><a href="<?php echo base_url(); ?>dashboard/"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name'); ?></a></li>
                    <li ><a href="<?php echo base_url(); ?>user/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    <?php
   
} else {
    ?>
                    <li> <a href="<?php echo base_url(); ?>user/login"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                    <li><a href="<?php echo base_url(); ?>user/register"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>

    <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>



        <?php
        $this->load->view($module . '/' . $view_file);
        ?>

      


    </body>
</html>
